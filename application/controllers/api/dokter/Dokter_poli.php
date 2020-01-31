<?php
date_default_timezone_set('Asia/Jakarta');

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Dokter_poli extends REST_Controller {
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

        
        $klinik_id = $this->get('klinik_id');
        $category_poli_id = $this->get('poli_id');
        //$data = $this->mymodel->getbywhere("dokter","category_poli_id = '".$category_poli_id."' and klinik_id=",$klinik_id,"result");
        $poli =  $this->mymodel->getbywhere("poli_klinik","poli_klinik_id",$category_poli_id,"row");
        $data = $this->mymodel->getbywhere("dokter","category_poli_id = '".$poli->category_poli_id."' and status_aktif='1' and is_aktif='1' and klinik_id=",$klinik_id,"result");
        //echo $this->db->last_query();
        foreach ($data as $key => $value) {
            $get_antrian_terakhir = $this->mymodel->withquery("select count(*) as jumlah from antrian where klinik_id='".$klinik_id."' and category_poli_id='".$value->category_poli_id."' and dokter_id = '".$value->dokter_id."' ","row");
            $value->antrian_terakhir = $get_antrian_terakhir->jumlah;
            if (empty($value->img_file)) {
              $value->img_file = "kosong.png";
            }
            $value->expired = "";
            $value->tanggal_pembayaran = "";
            $value->img_file = base_url('assets/image/dokter/'.$value->img_file);
            //$get_poli_dokter = $this->mymodel->getbywhere('category_poli','category_poli_id',$value->category_poli_id,'row');
            //$value->poli_img_file = base_url('assets/image/dokter/'.$get_poli_dokter->img_file);
            $get_kunjungan = $this->mymodel->withquery("select count(*) as jumlah from histori_data_scan where pasien_id='".$pasien->pasien_id."' and dokter_id='".$value->dokter_id."' ","row");
            $value->total_kunjungan = $get_kunjungan->jumlah;

        }
              if (!empty($data)) {
                $msg = array('status' => 1, 'message'=>'Berhasil ambil data' ,'data'=>$data);
              }else {
                $msg = array('status' => 0, 'message'=>'Data tidak ditemukan' ,'data'=>array());
              }
      
        $this->response($msg);
    }
}