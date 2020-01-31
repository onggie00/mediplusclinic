<?php
date_default_timezone_set('Asia/Jakarta');

defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
/** @noinspection PhpIncludeInspection */
//To Solve File REST_Controller not found
require APPPATH . 'libraries/REST_Controller.php';

class Save_internal_img extends REST_Controller {
    function __construct($config = 'rest') {
        parent::__construct($config);
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
              "save_img" => $this->post('save_img')
              );            
            if (!empty($data)) {
              $this->mymodel->update('detail_data_scan',$data,'detail_data_scan_id',$this->post('detail_id'));
              $msg = array('status' => 1, 'message'=>'Berhasil Update data' ,'data'=>$data);
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