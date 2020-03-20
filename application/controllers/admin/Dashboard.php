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
		for($i =0;$i<12;$i++){
      $kali = 30*$i;
      $kali2 = $kali+30;
      $d1 = date('Y-m-d', strtotime( $date . ' -'.$kali.' day' ));
      //echo "<script>console.log(".$d1.");</script>";
      $d2 = date('y-m-d', strtotime( $date . ' -'.$i.' month' ));
      /*$htrans[$i] = $this->mymodel->withquery("select count(DISTINCT htrans_id) as jumlah from htrans
      where year(created_at) = '".$y."' and month(created_at) = '".$m."'
      and day(created_at) = '".$d."' and is_deleted='0'",'row')->jumlah;
      */

    //echo $this->db->last_query();
    }
    
    /*$data['antrian'] = $this->mymodel->withquery("select count(*) as jumlah from antrian
      where status_antrian='0'","row")->jumlah;
    */
    $get_dokter = $this->mymodel->getbywhere('dokter','username',$this->session->userdata('dokter'),'row');
		$data['title_page'] = "Dashboard Admin Dokter";
    $data['nama_lengkap'] = $get_dokter->nama_dokter;
    $data['foto_profil'] = $get_dokter->img_file;
    $data['biaya_awal'] = "Rp. ".number_format($get_dokter->biaya,0,"",".");
    if (!empty($this->mymodel->getbywhere('antrian',"status_antrian='0' and dokter_id=",$get_dokter->dokter_id,'row'))) {
      $data['antrian_terkini'] = $this->mymodel->getbywhere('antrian',"status_antrian='0' and dokter_id=",$get_dokter->dokter_id,'row')->nomor_antri;
    }else{
      $data['antrian_terkini'] = $this->mymodel->getlastwhere('antrian','dokter_id',$get_dokter->dokter_id,'nomor_antri')->nomor_antri;
    }
    $cek_antrian_selanjutnya = $this->mymodel->getbywhere('antrian',"status_antrian='0' and dokter_id=",$get_dokter->dokter_id,'row');
    if (!empty($cek_antrian_selanjutnya)) {
         $data['antrian_selanjutnya'] = $cek_antrian_selanjutnya->nomor_antri+1; 
    }else{
      $data['antrian_selanjutnya'] = " - ";
    }
    $data['batas_antrian'] = $get_dokter->batas_antrian;
    $data['total_pasien'] = $this->mymodel->withquery("select count(*) as total from hantrian_dokter where is_deleted='0' and dokter_id='".$get_dokter->dokter_id."' and created_at >= DATE_ADD(LAST_DAY(DATE_SUB(NOW(), INTERVAL 2 MONTH)), INTERVAL 1 DAY) ",'row')->total;

    $data['err_msg'] =  $this->session->flashdata('msg');
    $data['success_msg'] =  $this->session->flashdata('success_msg');
    
    $this->load->view('admin/header_dokter',$data);
		$this->load->view('admin/dashboard_dokter',$data);
		$this->load->view('admin/footer');
  }

  public function next_antrian(){
    $data = array(
      "status_antrian" => "1"
      );
    if (isset($_REQUEST['btn_next_antrian'])) {
      $get_dokter = $this->mymodel->getbywhere('dokter','username',$this->session->userdata('dokter'),'row');
      $cek_antrian = $this->mymodel->getbywhere('antrian',"status_antrian='0' and dokter_id=",$get_dokter->dokter_id,'row');
      if (!empty($cek_antrian)) {
        $get_antrian_terakhir = $this->mymodel->getbywhere('antrian',"nomor_antri='".$_REQUEST['nomor_antri']."' and dokter_id=",$get_dokter->dokter_id,'row');
        $get_dokter = $this->mymodel->getbywhere('dokter','dokter_id',$get_antrian_terakhir->dokter_id,'row');
        //sudah bayar / belum
        $cek_biaya = $this->mymodel->getbywhere('expired_payment',"pasien_id='".$get_antrian_terakhir->pasien_id."' and dokter_id=",$get_antrian_terakhir->dokter_id,'row');
        $next = $this->mymodel->update('antrian',$data,'antrian_id',$get_antrian_terakhir->antrian_id);
        //Cek Kadaluarsa
        $tgl_expired = date_create(date("Y-m-d",strtotime($cek_biaya->date_expired)));
        $today = date_create(date("Y-m-d"));
        $selisih = date_diff($today,$tgl_expired);
        $selisih = $selisih->format('%r%a');
        if (!empty($cek_biaya)) {
          $biaya = 0;
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
            "is_deleted" => 0
            );
          $in2 = $this->mymodel->insert('histori_data_scan',$data_histori);
        }
          $get_fcm = $this->mymodel->getbywhere('pasien','pasien_id',$cek_antrian->pasien_id,'row')->fcm_id;
          $this->send_notif("Notifikasi Antrian Mediplus","Nomor Antrian ".$cek_antrian->nomor_antri." Silahkan Menemui Dokter",$get_fcm);
          
          //cek sisa antrian
          $get_semua_antrian = $this->mymodel->getbywhere('antrian',"dokter_id='".$get_antrian_terakhir->dokter_id."' and status_antrian=",'0','result');
          foreach ($get_semua_antrian as $key => $value) {
            $sisa = $value->nomor_antri-$get_antrian_terakhir->nomor_antri;
            if ($value->pengingat_sisa_antrian ==  $sisa) {
              $get_fcm2 = $this->mymodel->getbywhere('pasien','pasien_id',$cek_antrian->pasien_id,'row')->fcm_id;
              $this->send_notif("Notifikasi Pengingat Antrian Mediplus","Sisa Antrian tinggal ".$sisa." nomor lagi. Silahkan bersiap Menemui Dokter",$get_fcm2);
            }
          }

          $this->session->set_flashdata('success_msg','Antrian Selanjutnya '.$cek_antrian->nomor_antri);
      }else{
        $this->session->set_flashdata('msg','Tidak Ada Antrian');
      }
    }
    redirect('admin/dokter/dashboard');
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

  public function is_login()
  {
    $islogin = $this->session->userdata('dokter');
    if ($islogin=="") {
      redirect('admin/login_dokter/');
    }
  }
}
?>
