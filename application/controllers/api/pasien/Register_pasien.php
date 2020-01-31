<?php
header('Access-Control-Allow-Origin: *');
date_default_timezone_set('Asia/Jakarta');
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
ob_start();
class Register_pasien extends REST_Controller {

  function __construct($config = 'rest') {
      parent::__construct($config);
  }

  function index_post() {

        $nama_lengkap = $this->post('nama_lengkap');
        $phone = $this->post('phone');
        $alamat = $this->post('alamat');
        $email = $this->post('email');
        $tanggal_lahir = $this->post('tanggal_lahir');
        $username = $this->post('username');
        $password = $this->post('password');
        $status_pembayaran = "MENUNGGU PEMBAYARAN";
        $tanggal_pembayaran = null;
        $biaya = "0";
        $expired = null;
        $is_deleted = "0";

        $msg="";
        //Cek Phone terdaftar
        if (empty($this->mymodel->getbywhere('pasien','phone',$phone,'row')) ) {
          if (empty($this->mymodel->getbywhere('pasien','username',$username,'row') )) {
            $token = md5(uniqid().$this->post('username').$this->post('password').date('Y-m-d H:i:s'));

                $data = array(
                "nama_lengkap" => $nama_lengkap,
                "phone" => $phone,
                "alamat" => $alamat,
                "email" => $email,
                "tanggal_lahir" => $tanggal_lahir,
                "token" => $token,
                "username" => $username,
                "password" => md5($password),
                "img_file" => "kosong.png",
                "is_deleted" => $is_deleted
              );

            $in = $this->mymodel->insert('pasien',$data);
            $msg = array('status' => 1, 'message'=>'Data berhasil ditambahkan','data' => $data);
          }else{
            $msg = array('status' => 0, 'message'=>'Username Sudah Terdaftar');
          }
        }else{
          $msg = array('status' => 0, 'message'=>'Nomor Telepon Sudah Terdaftar');
        }
        $this->response($msg);        
  }

}
?>
