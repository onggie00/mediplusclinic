<?php
date_default_timezone_set('Asia/Jakarta');
defined('BASEPATH') OR exit('No direct script access allowed');
define( 'API_ACCESS_KEY', 'AAAAFOwiYw0:APA91bFIXvpDlPOBQJilN-999raTtzUE3AMiJog50Q41JU2VZKPhvM2K2PX639ABtBowd5tQF1fzD-O1e7cI9S5IOxQq4W32GHfOFCPnOFtQF-UmNHIHHj_MNKA_ThpLpDFGhSVnMV3v' );
require APPPATH.'controllers/admin/phpmailer/PHPMailerAutoload.php';
class Notifikasi_dokter_antrian extends CI_Controller {

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
  public function index($val = "")
  {
    $this->is_login();
    $msg = $this->session->flashdata('msg');
    $this->session->set_flashdata('msg',$msg);
    $data['title_page'] = "Manajemen Pemberitahuan untuk Antrian Pasien";
    $data['nama_lengkap'] = $this->mymodel->getbywhere('dokter','username',$this->session->userdata('dokter'),"row")->nama_dokter;
    $data['foto_profil'] = $this->mymodel->getbywhere('dokter','username',$this->session->userdata('dokter'),"row")->img_file;
    $data['err_msg'] =  $this->session->flashdata('msg');
    $data['success_msg'] =  $this->session->flashdata('success_msg');
    $this->load->view('admin/header_dokter', $data);
    $this->load->view('admin/data_notifikasi_antrian');
    $this->load->view('admin/footer');
  }
  public function alldata()
  {
    $this->load->model(array('Antrian_by_dokter_datatable'));
    $fetch_data = $this->Antrian_by_dokter_datatable->make_datatables();
           $data = array();
           $nomor=1;
           foreach($fetch_data as $value)
           {
            $get_dokter_data = $this->mymodel->getbywhere('dokter','username',$this->session->userdata('dokter'),'row');
            if ($value->dokter_id == $get_dokter_data->dokter_id && $value->status_antrian == "0") {
              	$pasien = $this->mymodel->getbywhere('pasien','pasien_id',$value->pasien_id,'row');

                $sub_array = array();
                $sub_array[] = $value->nomor_antri;
                $sub_array[] = $pasien->nama_lengkap;
                $sub_array[] = $pasien->email;
                $sub_array[] = $pasien->phone;
                $sub_array[] ='
                <button type="button" name="update" id="'.$pasien->pasien_id.'" class="btn btn-sm btn-primary update">
                <i class="mdi mdi-pencil-circle ml-1"></i> Kirim Pesan</button>
                <br>';
                $data[] = $sub_array;
                $nomor++;
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
  public function broadcast()
  {
  	$get_dokter_data = $this->mymodel->getbywhere('dokter','username',$this->session->userdata('dokter'),'row');
    $get_antrian_pasien = $this->mymodel->getbywhere('antrian',"dokter_id='".$get_dokter_data->dokter_id."' and status_antrian=","0","result");
      
      foreach ($get_antrian_pasien as $key => $value) {
      	$get_pasien = $this->mymodel->getbywhere('pasien','pasien_id',$value->pasien_id,'row');
      	$data = array(
          "id_pasien" => $value->pasien_id,
          "title" => $_REQUEST['title'],
          "deskripsi" => $_REQUEST['deskripsi'],
          "id_asisten" => $get_dokter_data->dokter_id,
          "tanggal" => date("Y-m-d H:i:s")
        );
	      if(!empty($data)){
	        $in = $this->mymodel->insert('notifikasi_pasien',$data);
	        if ($in) {
	        $this->send_email($_REQUEST['title'],$_REQUEST['deskripsi'],$get_pasien->nama_lengkap,$get_pasien->email);
        	$this->send_notif($_REQUEST['title'],$_REQUEST['deskripsi'],$get_pasien->fcm_id)."<br>";
	        $this->session->set_flashdata('success_msg','Pesan berhasil Dikirim');
	        }
	      }else {
	      	echo $value->pasien_id;
	        $this->session->set_flashdata('msg',"Gagal Kirim Pesan");
	      }
      }
      redirect('admin/dokter/notifikasi_dokter_antrian/');
  }

   public function kirimpesan()
  {
  	$get_dokter_data = $this->mymodel->getbywhere('dokter','username',$this->session->userdata('dokter'),'row');
   	$get_pasien = $this->mymodel->getbywhere('pasien','pasien_id',$_REQUEST['data_id'],'row');
     $data_kirim = array(
        "id_pasien" => $_REQUEST['data_id'],
        "title" => $_REQUEST['title'],
        "deskripsi" => $_REQUEST['deskripsi'],
        "id_asisten" => $get_dokter_data->dokter_id,
        "tanggal" => date("Y-m-d H:i:s")
        );
    if(!empty($data_kirim)){
      $in = $this->mymodel->insert('notifikasi_pasien',$data_kirim);
      if ($in) {
      	$this->send_email($_REQUEST['title'],$_REQUEST['deskripsi'],$get_pasien->nama_lengkap,$get_pasien->email);
        $this->send_notif($_REQUEST['title'],$_REQUEST['deskripsi'],$get_pasien->fcm_id);
        $this->session->set_flashdata('success_msg','Sukses mengirim pesan');
      }else{
        $this->session->set_flashdata('msg','Gagal Mengirim Pesan');
      }
    }
    //echo $this->db->last_query();
    redirect('admin/dokter/notifikasi_dokter_antrian/');
  }

  public function send_email($judul,$deskripsi,$nama,$email)
    {
      $to = urldecode($email);
      $mail = new PHPMailer;
      // Konfigurasi SMTP
      $mail->isSMTP();
      $mail->SMTPDebug =0;
      // $mail->Host = 'mail.namagz.com';
      $mail->Host = 'smtp.gmail.com';
      $mail->SMTPOptions = array(
         'ssl' => array(
           'verify_peer' => false,
           'verify_peer_name' => false,
           'allow_self_signed' => true
          )
      );
      $mail->SMTPAuth = true;
      // $mail->Username = 'syauqi@namagz.com';
      // $mail->Password = 'koroko11';
      $mail->Username = 'devs.mediplus@gmail.com';
      $mail->Password = 'bayuganteng2312';
      $mail->SMTPSecure = 'ssl';
      $mail->Port = 465;

      $mail->addReplyTo('no-reply@mediplus.com', 'Mediplus');
      $mail->setFrom('no-reply@mediplus.com', 'Mediplus');

      // Menambahkan penerima
      $mail->addAddress($to);

      // Menambahkan beberapa penerima


      // Subjek email
      $mail->Subject = $judul;

      // Mengatur format email ke HTML
      $mail->isHTML(true);

      // Konten/isi
       $data_['msg'] = $deskripsi;
       $data_['title'] = $judul;
       $data_['to'] = $nama;
       $mailContent = $this->load->view('broadcast_pesan',$data_,true);
      $mail->Body = $mailContent;
      // Menambahakn lampiran

      // Kirim email
      if(!$mail->send()){
          //echo 'Pesan tidak dapat dikirim.';
          //echo 'Mailer Error: ' . $mail->ErrorInfo;
          $this->session->set_flashdata('msg','Mailer Error: ' . $mail->ErrorInfo);
      }else{
          //echo 'Pesan telah terkirim ';
        $this->session->set_flashdata('success_msg','Pesan Terkirim '.$email);
      }
     echo $this->session->flashdata('msg')."<br/>".$deskripsi;
    //redirect('admin/dokter/notifikasi_pasien/');
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
 
  public function getdataedit()
  {
    $id = $_REQUEST['id'];
    $data["data"] = $this->mymodel->getbywhere('pasien','pasien_id',$id,"row");
    $this->load->view('admin/modal_edit/notifikasi_dokter_antrian',$data);
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