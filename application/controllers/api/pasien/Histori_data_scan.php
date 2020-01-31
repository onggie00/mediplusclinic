<?php
date_default_timezone_set('Asia/Jakarta');

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Histori_data_scan extends REST_Controller {
    function __construct()
    {
        parent::__construct();
    }
    public function get_bulan($bulan){
    $bln = "";
    if ($bulan == 1) {
      $bln = "Januari";
    }else if ($bulan == 2) {
      $bln = "Februari";
    }else if ($bulan == 3) {
      $bln = "Maret";
    }else if ($bulan == 4) {
      $bln = "April";
    }else if ($bulan == 5) {
      $bln = "Mei";
    }else if ($bulan == 6) {
      $bln = "Juni";
    }else if ($bulan == 7) {
      $bln = "Juli";
    }else if ($bulan == 8) {
      $bln = "Agustus";
    }else if ($bulan == 9) {
      $bln = "September";
    }else if ($bulan == 10) {
      $bln = "Oktober";
    }else if ($bulan == 11) {
      $bln = "November";
    }else if ($bulan == 12) {
      $bln = "Desember";
    }
    return $bln;
  }
  public function get_hari($h){
    $hari = "";
    if ($h == 1) {
      $hari = "Senin";
    }else if ($h == 2) {
      $hari = "Selasa";
    }else if ($h == 3) {
      $hari = "Rabu";
    }else if ($h == 4) {
      $hari = "Kamis";
    }else if ($h == 5) {
      $hari = "Jumat";
    }else if ($h == 6) {
      $hari = "Sabtu";
    }else if ($h == 7) {
      $hari = "Minggu";
    }
    return $hari;
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
        $data = $this->mymodel->withquery("select histori_data_scan_id,dokter_id,created_at from histori_data_scan where pasien_id='".$pasien->pasien_id."' and is_deleted='0' order by created_at DESC, klinik_id ASC",'result');

        foreach ($data as $key => $value) {
          //$value->nama_klinik = $this->mymodel->getbywhere('klinik','klinik_id',$value->klinik_id,'row')->nama_klinik;
          //$value->jenis_poli = $this->mymodel->getbywhere('category_poli','category_poli_id',$value->category_poli_id,'row')->nama_poli;
          $value->nama_dokter = $this->mymodel->getbywhere('dokter','dokter_id',$value->dokter_id,'row')->nama_dokter;
          /*if ($this->mymodel->getbywhere('dokter','dokter_id',$value->dokter_id,'row')->img_file != null) {
              $value->img_file = base_url('assets/image/dokter/'.$this->mymodel->getbywhere('dokter','dokter_id',$value->dokter_id,'row')->img_file);
          }else{
            $value->img_file = base_url('assets/image/dokter/kosong.png');
          }
          
          $get_kunjungan = $this->mymodel->withquery("select count(*) as jumlah from histori_data_scan where pasien_id='".$pasien->pasien_id."' and dokter_id='".$value->dokter_id."' and is_deleted='0' ","row");
          $value->total_kunjungan = $get_kunjungan->jumlah;

          if ($value->updated_at == null) {
            $value->updated_at = "";
          }
          */
          $convert = date("d m Y N",strtotime($value->created_at));
          $convert = explode(" ", $convert);
          $tgl = $convert[0];
          $bln = $this->get_bulan($convert[1]);
          $thn = $convert[2];
          $hari = $this->get_hari($convert[3]);
          $value->created_at = $hari.", ".$tgl." ".$bln." ".$thn;
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
