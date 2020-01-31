<?php

date_default_timezone_set('Asia/Jakarta');
defined('BASEPATH') OR exit('No direct script access allowed');
define( 'API_ACCESS_KEY', 'AAAAFOwiYw0:APA91bFIXvpDlPOBQJilN-999raTtzUE3AMiJog50Q41JU2VZKPhvM2K2PX639ABtBowd5tQF1fzD-O1e7cI9S5IOxQq4W32GHfOFCPnOFtQF-UmNHIHHj_MNKA_ThpLpDFGhSVnMV3v' );

class Dashboard extends CI_Controller {
	public function index()
  {
    $this->is_login();
    $msg = $this->session->flashdata('msg');
    $this->session->set_flashdata('msg',$msg);
    $msg = $this->session->flashdata('success_msg');
    $this->session->set_flashdata('success_msg',$msg);
		$user = array();
    $htrans = array();
    $kalender = array();
    $status = array();
		$date = date('Y-m-d');
		$data = array();
		
    
    /*$data['antrian'] = $this->mymodel->withquery("select count(*) as jumlah from antrian
      where status_antrian='0'","row")->jumlah;
    */
    $get_asisten_data = $this->mymodel->getbywhere('asisten_dokter','username',$this->session->userdata('asisten'),'row');
    $get_dokter = $this->mymodel->getbywhere('dokter','dokter_id',$get_asisten_data->dokter_id,'row');
		$data['title_page'] = "Dashboard Admin Asisten";
    $data['nama_lengkap'] = $get_asisten_data->nama_lengkap;
    $data['foto_profil'] = $get_asisten_data->img_file;
    $data['dokter'] = $get_dokter;
    $data['asisten'] = $get_asisten_data;
    $data['poli'] = $this->mymodel->getbywhere('category_poli','category_poli_id',$get_dokter->category_poli_id,'row');
    $data['rumah_sakit'] = $this->mymodel->getbywhere('klinik','klinik_id',$get_dokter->klinik_id,'row');
    $data['biaya_awal'] = "Rp. ".number_format($get_dokter->biaya,0,"",".");
    if (!empty($this->mymodel->getbywhere('antrian',"status_antrian='0' and dokter_id=",$get_dokter->dokter_id,'row'))) {
      $data['antrian_terkini'] = $this->mymodel->getbywhere('antrian',"status_antrian='0' and dokter_id=",$get_dokter->dokter_id,'row')->nomor_antri;
    }
    else if(!empty($this->mymodel->getbywhere('antrian',"dokter_id=",$get_dokter->dokter_id,'row'))){
      $data['antrian_terkini'] = $this->mymodel->getlastwhere('antrian','dokter_id',$get_dokter->dokter_id,'nomor_antri')->nomor_antri;
    }
    else{
      $data['antrian_terkini'] = 0;
    }
    $cek_antrian_selanjutnya = $this->mymodel->getbywhere('antrian',"status_antrian='0' and dokter_id=",$get_dokter->dokter_id,'row');
    if (!empty($cek_antrian_selanjutnya)) {
         $data['antrian_selanjutnya'] = $cek_antrian_selanjutnya->nomor_antri+1; 
    }else{
      $data['antrian_selanjutnya'] = " - ";
    }
    $data['batas_antrian'] = $get_dokter->batas_antrian;
    $data['total_pasien'] = $this->mymodel->withquery("select count(*) as total from hantrian_dokter where is_deleted='0' and dokter_id='".$get_dokter->dokter_id."' and created_at >= DATE_ADD(LAST_DAY(DATE_SUB(NOW(), INTERVAL 2 MONTH)), INTERVAL 1 DAY) ",'row')->total;
    $data['dokter'] = $get_dokter;

    $data['err_msg'] =  $this->session->flashdata('msg');
    $data['success_msg'] =  $this->session->flashdata('success_msg');
    
    $this->load->view('admin/header_asisten_dokter',$data);
		$this->load->view('admin/dashboard_asisten_dokter',$data);
		$this->load->view('admin/footer');
  }

  public function get_bulan($bulan){
    $bln = "";
    if ($bulan == 1) {
      $bln = "Januari";
    }else if ($bulan == 2) {
      $bln = "Februari";
    }else if ($bulan == 3) {
      $bln = "Maret";
    }else if ($bulan == 4) {
      $bln = "April";
    }else if ($bulan == 5) {
      $bln = "Mei";
    }else if ($bulan == 6) {
      $bln = "Juni";
    }else if ($bulan == 7) {
      $bln = "Juli";
    }else if ($bulan == 8) {
      $bln = "Agustus";
    }else if ($bulan == 9) {
      $bln = "September";
    }else if ($bulan == 10) {
      $bln = "Oktober";
    }else if ($bulan == 11) {
      $bln = "November";
    }else if ($bulan == 12) {
      $bln = "Desember";
    }
    return $bln;
  }
  public function get_hari($h){
    $hari = "";
    if ($h == 1) {
      $hari = "Senin";
    }else if ($h == 2) {
      $hari = "Selasa";
    }else if ($h == 3) {
      $hari = "Rabu";
    }else if ($h == 4) {
      $hari = "Kamis";
    }else if ($h == 5) {
      $hari = "Jumat";
    }else if ($h == 6) {
      $hari = "Sabtu";
    }else if ($h == 7) {
      $hari = "Minggu";
    }
    return $hari;
  }

  public function alldata()
  {
    $this->load->model(array('Antrian_by_dokter_datatable'));
    $fetch_data = $this->Antrian_by_dokter_datatable->make_datatables();
           $data = array();
           foreach($fetch_data as $value)
           {
            $get_pasien = $this->mymodel->getbywhere('pasien','pasien_id',$value->pasien_id,'row');
            $get_asisten = $this->mymodel->getbywhere('asisten_dokter','username',$this->session->userdata('asisten'),'row');
            $get_dokter = $this->mymodel->getbywhere('dokter','dokter_id',$get_asisten->dokter_id,'row');
            if ($value->dokter_id == $get_dokter->dokter_id && $value->status_antrian == "0") {
                $sub_array = array();
                $sub_array[] = $value->nomor_antri;
                $sub_array[] = $get_pasien->nama_lengkap;
                $cek_member = $this->mymodel->getbywheresort('expired_payment',"dokter_id = '".$value->dokter_id."' and pasien_id=",$get_pasien->pasien_id,'expired_payment_id','DESC');
                if (!empty($cek_member)) {
                  $expired_pasien = "";
                  foreach ($cek_member as $key => $value) {
                    $expired_pasien = $value->date_expired;
                  }
                  $tgl_expired = date_create(date("Y-m-d",strtotime($expired_pasien)));
                  $today = date_create(date("Y-m-d"));
                  $selisih = date_diff($today,$tgl_expired);
                  $selisih = $selisih->format('%r%a');
                  $convert = date("d m Y",strtotime($expired_pasien));
                  $convert = explode(" ", $convert);
                  $tgl = $convert[0];
                  $bln = $this->get_bulan($convert[1]);
                  $thn = $convert[2];
                  $tanggal = $tgl." ".$bln." ".$thn;
                  $sub_array[] = $tanggal;
                  if ($selisih >= 0) {
                    $sub_array[] = "Masih Aktif";
                  }else{
                    $sub_array[] = "Sudah Kadaluarsa";
                  }
                  $sub_array[] = "&nbsp;";
                }else{
                  $sub_array[] = "Tidak ditemukan";
                  $sub_array[] = "Belum Berlangganan";
                  $sub_array[] = '
                  <form action="'.site_url('admin/asisten/biaya_pasien_asisten/insertdata').'" method="post">
                  <input type="hidden" name="pasien_id" value="'.$get_pasien->pasien_id.'" />
                  <input type="hidden" name="dokter_id" value="'.$get_dokter->dokter_id.'" />
                  <input type="hidden" name="biaya" value="'.$get_dokter->biaya.'" />

                  <button type="submit" name="bayar" id="'.$get_pasien->pasien_id.'" class="btn btn-sm btn-primary bayar">
                  <i class="mdi mdi-pencil-circle ml-1"></i> Bayar Sekarang </button>
                  </form>
                  ';
                }

                $data[] = $sub_array;

            }
           }
           $output = array(
                "draw"                    =>    intval($_POST["draw"]) ,
                "recordsTotal"          =>      $this->Antrian_by_dokter_datatable->get_all_data(),
                "recordsFiltered"     =>     $this->Antrian_by_dokter_datatable->get_filtered_data(),
                "data"                    =>     $data
           );
           echo json_encode($output);
  }

  public function next_antrian(){
    $data = array(
      "status_antrian" => "1"
      );
    if (isset($_REQUEST['btn_next_antrian'])) {
      $get_asisten_data = $this->mymodel->getbywhere('asisten_dokter','username',$this->session->userdata('asisten'),'row');
      $get_dokter = $this->mymodel->getbywhere('dokter','dokter_id',$get_asisten_data->dokter_id,'row');
      $cek_antrian = $this->mymodel->getbywhere('antrian',"status_antrian='0' and dokter_id=",$get_dokter->dokter_id,'row');
      if (!empty($cek_antrian)) {
        $n = $_REQUEST['nomor_antri'];
        if ($_REQUEST['nomor_antri'] == "0") {
          $n = $n +1 ;
        }
        $get_antrian_terakhir = $this->mymodel->getbywhere('antrian',"status_antrian='0' and nomor_antri='".$_REQUEST['nomor_antri']."' and dokter_id=",$get_dokter->dokter_id,'row');
        //sudah bayar / belum
        $cek_biaya = $this->mymodel->getbywhere('expired_payment',"pasien_id='".$get_antrian_terakhir->pasien_id."' and dokter_id=",$get_antrian_terakhir->dokter_id,'row');
        
        if (!empty($cek_biaya)) {
          $biaya = 0;
          //Cek Kadaluarsa
          $tgl_expired = date_create(date("Y-m-d",strtotime($cek_biaya->date_expired)));
          $today = date_create(date("Y-m-d"));
          $selisih = date_diff($today,$tgl_expired);
          $selisih = $selisih->format('%r%a');
          if ($selisih >= 0) {
            $biaya = 0;
          }else{
            $biaya = $get_dokter->biaya;
          }
        }else{
          $biaya = $get_dokter->biaya;
        }
        $data_hantrian = array(
          "dokter_id" => $get_antrian_terakhir->dokter_id,
          "pasien_id" => $get_antrian_terakhir->pasien_id,
          "klinik_id" => $get_antrian_terakhir->klinik_id,
          "ruangan" => $get_dokter->ruangan,
          "created_at" => date("Y-m-d H:i:s"),
          "biaya" => $biaya,
          "is_deleted" => 0
        );
        if (!empty($data_hantrian)) {
          $in = $this->mymodel->insert('hantrian_dokter',$data_hantrian);
          //insert histori
          $data_histori = array(
            "pasien_id" => $get_antrian_terakhir->pasien_id,
            "dokter_id" => $get_antrian_terakhir->dokter_id,
            "klinik_id" => $get_antrian_terakhir->klinik_id,
            "category_poli_id" => $get_dokter->category_poli_id,
            "created_at" => date("Y-m-d H:i:s"),
            "nomor_antri" => $n,
            "biaya" => $biaya,
            "is_deleted" => 0
            );
          $in2 = $this->mymodel->insert('histori_data_scan',$data_histori);
        }
          $get_fcm = $this->mymodel->getbywhere('pasien','pasien_id',$cek_antrian->pasien_id,'row')->fcm_id;
          $t = "Notifikasi Antrian Mediplus";
          $d = "Nomor Antrian ".$cek_antrian->nomor_antri." Silahkan Menemui Dokter";

          $data_in_notif = array(
            "title" => $t,
            "deskripsi" => $d,
            "id_pasien" => $cek_antrian->pasien_id,
            "id_asisten" => $get_dokter->dokter_id,
            "tanggal" => date('Y-m-d H:i:s')
            );
          $this->mymodel->insert('notifikasi_pasien',$data_in_notif);
          $this->send_notif("Notifikasi Antrian Mediplus","Nomor Antrian ".$cek_antrian->nomor_antri." Silahkan Menemui Dokter",$get_fcm);
          
          //cek sisa antrian
          $get_semua_antrian = $this->mymodel->getbywhere('antrian',"dokter_id='".$get_antrian_terakhir->dokter_id."' and status_antrian=",'0','result');
          foreach ($get_semua_antrian as $key => $value) {
            $sisa = $value->nomor_antri-$get_antrian_terakhir->nomor_antri;
            if ($this->mymodel->getbywhere('pasien','pasien_id',$value->pasien_id,'row')->pengingat_sisa_antrian ==  $sisa) {
              $get_fcm2 = $this->mymodel->getbywhere('pasien','pasien_id',$value->pasien_id,'row')->fcm_id;
              $t2 = "Notifikasi Pengingat Antrian Mediplus";
          $d2 = "Nomor Antrian ".$cek_antrian->nomor_antri.", Sisa antrian ".$sisa." antrian lagi. Silahkan bersiap untuk menemui Dokter";

          $data_in_notif = array(
            "title" => $t2,
            "deskripsi" => $d2,
            "id_pasien" => $cek_antrian->pasien_id,
            "id_asisten" => $get_dokter->dokter_id,
            "tanggal" => date('Y-m-d H:i:s')
            );
          $this->mymodel->insert('notifikasi_pasien',$data_in_notif);
          $this->send_notif($t2,$d2,$get_fcm2);
            }
          }

          $next = $this->mymodel->update('antrian',$data,'antrian_id',$get_antrian_terakhir->antrian_id);
          $n++;
          $this->session->set_flashdata('success_msg','Antrian Saat ini '.$n);
      }else{
        $this->session->set_flashdata('msg','Tidak Ada Antrian');
      }
    }
    redirect('admin/asisten/dashboard');
  }

  public function send_notif($title,$desc,$id_fcm)
  {
    $Msg = array(
      'body' => $desc,
      'title' => $title
    );
    $fcmFields = array(
      'to' => $id_fcm,
      'notification' => $Msg
      // 'data'=>$data
    );
    $headers = array(
      'Authorization: key=' . API_ACCESS_KEY,
      'Content-Type: application/json'
    );
    $ch = curl_init();
    curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
    curl_setopt( $ch,CURLOPT_POST, true );
    curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
    curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
    curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
    curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fcmFields ) );
    $result = curl_exec($ch );
    curl_close( $ch );

    $cek_respon = explode(',',$result);
    $berhasil = substr($cek_respon[1],strpos($cek_respon[1],':')+1);
    echo $result."\n\n";
  }
  public function updatedata()
  {
    $data = array(
      "biaya" => $_REQUEST['biaya']
      );
    if(!empty($data)){
      $up = $this->mymodel->update('dokter',$data,'dokter_id',$_REQUEST['data_id']);
      if ($up) {
        $this->session->set_flashdata('success_msg','Data Berhasil Diubah');
      }else{
        $this->session->set_flashdata('success_msg','Gagal Update Data');
      }
    }
    //echo $this->db->last_query();
    redirect('admin/asisten/dashboard/');
  }
  public function getdataedit()
  {
    $id = $_REQUEST['id'];
    $data["data"] = $this->mymodel->getbywhere('dokter','dokter_id',$id,"row");
    $this->load->view('admin/modal_edit/biaya_awal_asisten',$data);
  }

  public function is_login()
  {
    $islogin = $this->session->userdata('asisten');
    if ($islogin=="") {
      redirect('admin/login_asisten/');
    }
  }
}
?>
