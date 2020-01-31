<?php
date_default_timezone_set('Asia/Jakarta');

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Cek_antrian extends REST_Controller {
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
        $pasien = $this->mymodel->getbywhere('pasien','token',$token,'row');
        $data = $this->mymodel->getbywhere("antrian","status_antrian='0' and pasien_id=",$pasien->pasien_id,"row");
          if (empty($data)) {
          $msg = array('status' => 0, 'message'=>'Tidak ada info Antrian' ,'data'=>array());
        }else {
          $get_antrian_dokter = $this->mymodel->getbywheresort('antrian',"status_antrian='0' and dokter_id=",$data->dokter_id,'antrian_id','DESC');
          $antrian_terkini = 0;
          
            foreach ($get_antrian_dokter as $key => $value) {
              $antrian_terkini = $value->nomor_antri;
            }
          
          $data->sisa_antrian = $data->nomor_antri - $antrian_terkini;
          $data->dokter_anda = $this->mymodel->getbywhere('dokter','dokter_id',$data->dokter_id,'row')->nama_dokter;
          $data->klinik = $this->mymodel->getbywhere('klinik','klinik_id',$data->klinik_id,'row')->nama_klinik;
          $data->jenis_poli = $this->mymodel->getbywhere('category_poli','category_poli_id',$data->category_poli_id,'row')->nama_poli;
          
          $msg = array('status' => 1, 'message'=>'Berhasil ambil data' ,'data'=>$data);
        }
      }else {
        $data = array();
        $msg = array('status' => 0, 'message'=>'Token anda kosong','data'=>array());
      }
        $this->response($msg);
    }
}