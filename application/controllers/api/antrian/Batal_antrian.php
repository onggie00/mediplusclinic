<?php
date_default_timezone_set('Asia/Jakarta');

defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
/** @noinspection PhpIncludeInspection */
//To Solve File REST_Controller not found
require APPPATH . 'libraries/REST_Controller.php';

class Batal_antrian extends REST_Controller {
    function __construct($config = 'rest') {
        parent::__construct($config);
    }
    public function index_post()
    {
      $token = "";
      $headers=array();
      $data = array();
      foreach (getallheaders() as $name => $value) {
          $headers[$name] = $value;
      }
      if(isset($headers['token']))
        $token =  $headers['token'];

      if ($token != '') {
          $pasien = $this->mymodel->getbywhere('pasien','token',$token,"row");
          $dokter_id = $this->post('dokter_id');
          $antrian = $this->mymodel->getbywhere('antrian',"pasien_id='".$pasien->pasien_id."' and dokter_id='".$dokter_id."' and status_antrian=","0","row");
          if (isset($antrian)) {
            $data = array(
              "status_antrian" => "2"
              );

            if (!empty($data)) {
              $this->mymodel->update('antrian',$data,"status_antrian='0' and dokter_id='".$dokter_id."' and pasien_id=",$pasien->pasien_id);
              $msg = array('status' => 1, 'message'=>'Berhasil Membatalkan Antrian' ,'data'=>$data);
            }else {
              $msg = array('status' => 0, 'message'=>'Data tidak ditemukan' ,'data'=>array());
            }
          }else {
              $msg = array('status' => 0, 'message'=>'Antrian Tidak Ditemukan ');
          }

          $this->response($msg);
      }else {
        $data = array();
        $msg = array('status' => 0, 'message'=>'Token anda kosong');
        $this->response($msg);
      }
    }
}