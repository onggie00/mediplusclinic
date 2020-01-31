<?php
date_default_timezone_set('Asia/Jakarta');

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';
require 'phpmailer/PHPMailerAutoload.php';
ob_start();

class Lupa_password extends REST_Controller {
    function __construct()
    {
        parent::__construct();
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
  function index_post() {
       $email = $this->post('email');
       if (isset($email)) {
         $cekemail = $this->mymodel->getbywhere('pasien','email',$email,'row');
         if (isset($cekemail)) {
           $newpass = rand( 100000, 1000000);
           $dt = array('password' => md5($newpass) );
           $this->mymodel->update('pasien',$dt,'token',$cekemail->token);
           //$this->send_email_file('',urlencode($email),$newpass);
           //$this->send_sms($cekphone->phone,"Nomor reset sandi TokoLift ".$newpass);
           $this->send_email_file("",$cekemail->email,$newpass);
           $msg = array('status' => 1, 'message'=>'Password Berhasil di reset' );
         }else {
           $msg = array('status' => 0, 'message'=>'Email Tidak Terdaftar' );
         }
       }else {
         $msg = array('status' => 0, 'message'=>'Email tidak boleh kosong' );
       }
      $this->response($msg);

    }

    public function send_email_file($file="",$to='',$data)
    {
      $to = urldecode($to);
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
      $mail->Username = 'devs.rejekisejutabintang@gmail.com';
      $mail->Password = '{[bayuganteng2312]}';
      $mail->SMTPSecure = 'ssl';
      $mail->Port = 465;

      $mail->addReplyTo('no-reply@mediplus.com', 'Mediplus');
      $mail->setFrom('no-reply@mediplus.com', 'Mediplus');

      // Menambahkan penerima
      $mail->addAddress($to);

      // Menambahkan beberapa penerima


      // Subjek email
      $mail->Subject = '[No Reply] Reset Password Mediplus';

      // Mengatur format email ke HTML
      $mail->isHTML(true);

      // Konten/isi
       $data_['msg'] = "Selamat Password anda berhasil di reset, Password baru anda berada dibawah ini.";
       $data_['code'] = "$data";
       $data_['title'] = "Lupa Password";
       $mailContent = $this->load->view('email_lupas',$data_,true);
      $mail->Body = $mailContent;
      // Menambahakn lampiran

      // Kirim email
      if(!$mail->send()){
        //  echo 'Pesan tidak dapat dikirim.';
        //  echo 'Mailer Error: ' . $mail->ErrorInfo;
      }else{
        //  echo 'Pesan telah terkirim ';
      }
    }
}