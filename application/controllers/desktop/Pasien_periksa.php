<?php
header('Access-Control-Allow-Origin: *');
date_default_timezone_set('Asia/Jakarta');
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
ob_start();
class Pasien_periksa extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
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
        $barcode = $this->get('barcode');
        $get_dokter = $this->mymodel->getbywhere('dokter','token',$token,'row');
        $get_barcode = $this->mymodel->getbywhere('barcode','barcode',$barcode,'row');
        $data = $this->mymodel->getbywhere('pasien','pasien_id',$get_barcode->pasien_id,'row');
          
        if (!empty($data)) {
          $msg = array('status' => 1, 'message'=>'Berhasil Ambil Data' ,'data'=>$data);
        }else {
          $msg = array('status' => 0, 'message'=>'Data Tidak Ditemukan' ,'data'=> new \stdClass());
        }
      }else {
        $data = array();
        $msg = array('status' => 0, 'message'=>'Token anda kosong');
      }
        $this->response($msg);
    }

}
?>
