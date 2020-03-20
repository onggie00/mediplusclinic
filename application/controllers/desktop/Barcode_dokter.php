<?php
date_default_timezone_set('Asia/Jakarta');

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Barcode_dokter extends REST_Controller {
    function __construct()
    {
        parent::__construct();
    }
    public function index_get()
    {
      $token = "";
      $headers=array();
      foreach (getallheaders() as $name => $value) {
          $headers[$name] = $value;
      }
      if(isset($headers['token']))
        $token =  $headers['token'];

      $msg="";
      if ($token!='') {
        $get_dokter = $this->mymodel->getbywhere('dokter','token',$token,'row');
        if (!empty($get_dokter)) {
          $length = 6;
          $code =  substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'),1,$length);
          $data = array(
            "barcode" => $code,
            "dokter_id" => $get_dokter->dokter_id
          );
          
          if (!empty($data)) {
            $in = $this->mymodel->insert('barcode',$data);
            $msg = array('status' => 1, 'message'=>'Berhasil Generate Barcode','data'=>$data);
          }else {
            $msg = array('status' => 0, 'message'=>'Gagal Generate Barcode' ,'data'=>array());
          }
        }else{
          $msg = array('status' => 0, 'message'=>'Data tidak ditemukan' ,'data'=>array());
        }
      }else {
        $data = array();
        $msg = array('status' => 0, 'message'=>'Token anda kosong','data'=>array());
      }
        $this->response($msg);
    }
}
