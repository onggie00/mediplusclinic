<?php
date_default_timezone_set('Asia/Jakarta');

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Pencarian_klinik_nama extends REST_Controller {
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
      $mem="";
      $msg="";
      if ($token!='') {
        $kata = $this->get('nama_klinik');
        $data = $this->mymodel->withquery("select * from klinik where nama_klinik like '%".$kata."%'",'result');
        foreach ($data as $key => $value) {
          $get_total_poli = $this->mymodel->withquery("select count(*) as jumlah from poli_klinik where klinik_id='".$value->klinik_id."' ","row");
          $value->total_poli = $get_total_poli->jumlah;
          if (empty($value->total_poli)) {
            $value->total_poli = "Kosong";
          }
          $value->img_file = base_url('assets/image/klinik/'.$value->img_file);
        }
              if (!empty($data)) {
                $msg = array('status' => 1, 'message'=>'Berhasil ambil data' ,'data'=>$data);
              }else {
                $msg = array('status' => 0, 'message'=>'Data tidak ditemukan' ,'data'=>array());
              }
      }else {
        $data = array();
        $msg = array('status' => 0, 'message'=>'Token anda kosong','data'=>array());
      }
        $this->response($msg);
    }
}
