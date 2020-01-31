<?php
date_default_timezone_set('Asia/Jakarta');
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
/** @noinspection PhpIncludeInspection */
//To Solve File REST_Controller not found
require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Ganti_email extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
    }
    // insert new data to account
    function index_post() {
      $token = "";
      $headers=array();
      foreach (getallheaders() as $name => $value) {
          $headers[$name] = $value;
      }
      if(isset($headers['token']))
        $token =  $headers['token'];

      if ($token != '') {
          $mem = $this->mymodel->getbywhere('relawan','token',$token,"row");
          if (isset($mem)) {
            $old_email = $this->post('old_email');
            $new_email = $this->post('new_email');
            $confirm_email = $this->post('confirm_email');
            if (isset($old_email)&&isset($new_email)) {
              if ($old_email == $mem->email) {
                if ($new_email == $confirm_email) {
                  $data = array('email' =>$confirm_email);
                  $this->mymodel->update('relawan',$data,'token',$token);
                  $msg = array('status'=>1,'message'=>'Email Berhasil Dirubah');
                }else {
                  $msg = array('status'=>0,'message'=>'Email Baru dan Konfirmasi email Tidak sama');
                }
              }else {
                $msg = array('status'=>0,'message'=>'Email Lama Tidak sesuai');
              }
            }else {
                $msg = array('status'=>0,'message'=>'Field Tidak Boleh Ada yang Kosong');
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
?>
