<?php
date_default_timezone_set('Asia/Jakarta');

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Ubah_password extends REST_Controller {
    function __construct()
    {
        parent::__construct();
    }

    public function index_post()
    {
      $token = "";
      $headers=array();
      foreach (getallheaders() as $name => $value) {
          $headers[$name] = $value;
      }
      if(isset($headers['token']))
        $token =  $headers['token'];

      if ($token != '') {
          $pasien = $this->mymodel->getbywhere('pasien','token',$token,"row");
          $pw_lama = md5($this->post('password_lama'));
          $pw_baru = md5($this->post('password_baru'));
          $cpassword = md5($this->post('confirm_password'));
          if (isset($pasien)) {
            if ($pw_lama == $pasien->password) {
              if ($pw_baru == $cpassword) {
                $data = array(
                  "password" => $cpassword
                );
                if (!empty($data)) {
                  $this->mymodel->update('pasien',$data,'pasien_id',$pasien->pasien_id);
                  $msg = array('status' => 1, 'message'=>'Berhasil Ubah Password' ,'data'=>$data);
                }else {
                  $msg = array('status' => 0, 'message'=>'Data tidak ditemukan' ,'data'=>array());
                }
              }
            }else{
              echo $pw_lama." - ".$pasien->password;
              $msg = array('status' => 0, 'message'=>'Password Lama Salah' ,'data'=>array());
            }
          }else {
              $msg = array('status' => 0, 'message'=>'Token Tidak Ditemukan ');
          }
          $this->response($msg);
      }else {
        $data = array();
        $msg = array('status' => 0, 'message'=>'Token anda kosong');
        $this->response($msg);
      }
    }

}