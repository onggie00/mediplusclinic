<?php
date_default_timezone_set('Asia/Jakarta');

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Simpan_lokasi_pasien extends REST_Controller {
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
              "longitude" => $this->post('longitude'),
              "latitude" => $this->post('latitude')
              );
            
            if (!empty($data)) {
              $this->mymodel->update('pasien',$data,'pasien_id',$pasien->pasien_id);
              $msg = array('status' => 1, 'message'=>'Berhasil Update lokasi' ,'data'=>$data);
            }else {
              $msg = array('status' => 0, 'message'=>'Data tidak ditemukan' ,'data'=>array());
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