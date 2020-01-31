<?php
date_default_timezone_set('Asia/Jakarta');

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Simpan_antrian extends REST_Controller {
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
          $total_antrian = $this->post('total_antrian');
          if (isset($pasien)) {
            $data = array(
              "pengingat_sisa_antrian" => $total_antrian
              );
              $up = $this->mymodel->update('pasien',$data,'token',$token);
              if ($up) {
                $msg = array('status' => 1, 'message'=>'Berhasil Ubah Data');
              }else{
                $msg = array('status' => 0, 'message'=>'Antrian Tidak Ditemukan');
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
