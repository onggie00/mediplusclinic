<?php
date_default_timezone_set('Asia/Jakarta');

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Hapus_file_barcode extends REST_Controller {
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

      $msg="";
      if ($token!='') {
        $get_pasien = $this->mymodel->getbywhere('pasien','token',$token,'row');
        $histori_data_scan_id = $this->post('histori_data_scan_id');
        $get_histori = $this->mymodel->getbywhere('detail_data_scan','histori_data_scan_id',$histori_data_scan_id,'result');
        $data = array(
          "histori_data_scan_id" => $histori_data_scan_id,
          "pasien_id" => $get_pasien->pasien_id
        );
        if (!empty($get_histori)) {
          foreach ($get_histori as $key => $value) {
            if ($value->type_file == "0") {
              unlink('./assets/image/data_scan/'.$value->img_file);
            }else if($value->type_file == "1"){
              unlink('./assets/image/data_scan/'.$value->video_file);
            }else if($value->type_file == "2"){
              unlink('./assets/image/data_scan/'.$value->pdf_file);
            }
          }
          //$in = $this->mymodel->delete('detail_data_scan','histori_data_scan_id',$histori_data_scan_id);
          $msg = array('status' => 1, 'message'=>'Berhasil Hapus File Data Scan' ,'data'=>$data);
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
