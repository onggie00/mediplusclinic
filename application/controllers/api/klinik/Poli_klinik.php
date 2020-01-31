<?php
date_default_timezone_set('Asia/Jakarta');

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Poli_klinik extends REST_Controller {
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
        $klinik_id = $this->get('klinik_id');
        $data = $this->mymodel->getbywhere("poli_klinik","klinik_id",$klinik_id,"result");
        foreach ($data as $key => $value) {
          $get_total_dokter = $this->mymodel->withquery("select count(*) as jumlah from dokter where klinik_id='".$klinik_id."' and category_poli_id='".$value->category_poli_id."' ","row");
          $value->total_dokter = $get_total_dokter->jumlah;
          if (empty($value->total_dokter)) {
            $value->total_dokter = "Kosong";
          }
          $get_poli = $this->mymodel->getbywhere('category_poli','category_poli_id',$value->category_poli_id,'row');
          $value->nama_poli = $get_poli->nama_poli;
          $value->img_file = base_url('assets/image/poli/'.$get_poli->img_file);
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