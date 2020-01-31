<?php
date_default_timezone_set('Asia/Jakarta');

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Data_scan_pasien extends REST_Controller {
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
        $histori_id = $this->get('histori_id');

      $data = $this->mymodel->getbywhere('histori_data_scan','histori_data_scan_id',$histori_id,'row');
        
      $data->nama_dokter = $this->mymodel->getbywhere('dokter','dokter_id',$data->dokter_id,'row')->nama_dokter;
      $data->nama_klinik = $this->mymodel->getbywhere('klinik','klinik_id',$data->klinik_id,'row')->nama_klinik;
      $data->jenis_poli = $this->mymodel->getbywhere('category_poli','category_poli_id',$data->category_poli_id,'row')->nama_poli;
      $data->nama_pasien = $pasien->nama_lengkap;
      //$data->umur = date('Y-m-d')-date("Y-m-d",strtotime($pasien->tanggal_lahir))." Tahun";
      $tgl_lahir = date_create(date("Y-m-d",strtotime($pasien->tanggal_lahir)));
      $data->umur_pasien = date_diff(date_create(date("Y-m-d")),$tgl_lahir)->y." Tahun";
      $data->biaya = "Rp.".number_format($data->biaya,0,"",".");

        if ($data->updated_at == null) {
          $data->updated_at = "";
        }
      $convert = date("d m Y N",strtotime($data->created_at));
      $convert = explode(" ", $convert);
      $tgl = $convert[0];
      $bln = $this->get_bulan($convert[1]);
      $thn = $convert[2];
      $hari = $this->get_hari($convert[3]);
      $data->created_at = $hari.", ".$tgl." ".$bln." ".$thn;
        
        
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