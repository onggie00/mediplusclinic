<?php
date_default_timezone_set('Asia/Jakarta');

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Update_profile extends REST_Controller {
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
          if (isset($pasien)) {
              $data = array(
              "nama_lengkap" => $this->post('nama_lengkap'),
              "username" => $this->post('username'),
              "phone" => $this->post('phone'),
              "alamat" => $this->post('alamat'),
              "email" => $this->post('email'),
              "tanggal_lahir" => $this->post("tanggal_lahir")
              );
            
            if (!empty($data)) {
              $this->mymodel->update('pasien',$data,'pasien_id',$pasien->pasien_id);
              $msg = array('status' => 1, 'message'=>'Berhasil Update profile' ,'data'=>$data);
            }else {
              $msg = array('status' => 0, 'message'=>'Data Kosong' ,'data'=>array());
            }
          }else {
              $msg = array('status' => 0, 'message'=>'Data tidak ditemukan' ,'data'=>array());
          }
          $this->response($msg);
      }else {
        $data = array();
        $msg = array('status' => 0, 'message'=>'Token anda kosong');
        $this->response($msg);
      }
    }
}