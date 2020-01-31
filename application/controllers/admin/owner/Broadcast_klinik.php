<?php
date_default_timezone_set('Asia/Jakarta');

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'controllers/admin/phpmailer/PHPMailerAutoload.php';

class Broadcast_klinik extends CI_Controller {
    function __construct()
    {
        parent::__construct();
    }
    public function index($val = "")
  {
    $this->is_login();
    $msg = $this->session->flashdata('msg');
    $this->session->set_flashdata('msg',$msg);
    $data['title_page'] = "Broadcast ke Rumah Sakit / Klinik";
    $data['nama_lengkap'] = $this->mymodel->getbywhere('admin','username',$this->session->userdata('admin'),"row")->nama_lengkap;
    $data['err_msg'] =  $this->session->flashdata('msg');
    $data['success_msg'] =  $this->session->flashdata('success_msg');
    $this->load->view('admin/header', $data);
    $this->load->view('admin/data_broadcast_klinik');
    $this->load->view('admin/footer');
  }
  public function alldata()
  {
    $this->load->model(array('Rumah_sakit_datatable'));
    $fetch_data = $this->Rumah_sakit_datatable->make_datatables();
           $data = array();
           $nomor=1;
           foreach($fetch_data as $value)
           {
            if ($value->is_deleted == "0") {
                $sub_array = array();
                $sub_array[] = $nomor;
                $sub_array[] = $value->nama_klinik;
                $sub_array[] = $value->phone;
                $sub_array[] = $value->email;
                $sub_array[] = $value->alamat;
                $sub_array[] ='
                <button type="button" name="update" id="'.$value->klinik_id.'" class="btn btn-sm btn-primary update">
                <i class="mdi mdi-pencil-circle ml-1"></i> Kirim Surel</button>
                <br><br>';

                $data[] = $sub_array;
                $nomor++;
            }
           }
           $output = array(
                "draw"                    =>    intval($_POST["draw"]) ,
                "recordsTotal"          =>      $this->Rumah_sakit_datatable->get_all_data(),
                "recordsFiltered"     =>     $this->Rumah_sakit_datatable->get_filtered_data(),
                "data"                    =>     $data
           );
           echo json_encode($output);
  }

    public function send_email()
    {
      $to = urldecode($_REQUEST['email']);
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
      $mail->Subject = $_REQUEST['judul'];

      // Mengatur format email ke HTML
      $mail->isHTML(true);

      // Konten/isi
       $data_['msg'] = $_REQUEST['deskripsi'];
       $data_['title'] = $_REQUEST['judul'];
       $data_['to'] = $_REQUEST['nama_klinik'];
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
        $this->session->set_flashdata('success_msg','Pesan Terkirim');
      }
      
    redirect('admin/owner/broadcast_klinik/');
    }
    public function send_email_all()
    {
      $get_klinik = $this->mymodel->getbywhere('klinik','is_deleted',"0",'result');
      foreach ($get_klinik as $key => $value) {
        $to = urldecode($value->email);
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
        $mail->Subject = $_REQUEST['judul'];

        // Mengatur format email ke HTML
        $mail->isHTML(true);

        // Konten/isi
         $data_['msg'] = $_REQUEST['deskripsi'];
         $data_['title'] = $_REQUEST['judul'];
         $data_['to'] = $value->nama_klinik;
         $mailContent = $this->load->view('broadcast_pesan',$data_,true);
        $mail->Body = $mailContent;
        // Menambahakn lampiran

        // Kirim email
        if(!$mail->send()){
            echo 'Pesan tidak dapat dikirim.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        }else{
            echo 'Pesan telah terkirim ';
        }
      }
    }
    public function getdataedit()
    {
      $id = $_REQUEST['id'];
      $data["data"] = $this->mymodel->getbywhere('klinik','klinik_id',$id,"row");
      $this->load->view('admin/modal_edit/broadcast_klinik',$data);
    }
    public function is_login()
    {
      $about_img = $this->session->userdata('admin');
      $check = $this->session->userdata('kode_verifikasi');
      if ($about_img=="" || $check=="") {
        redirect('admin/login/');
      }
    }

}