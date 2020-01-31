<?php
date_default_timezone_set('Asia/Jakarta');

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Cek_pembayaran_pasien extends REST_Controller {
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
        //$klinik_id = $this->get('klinik_id');
        //$category_poli_id = $this->get('poli_id');
        if ($pasien->status_pembayaran == "LUNAS") {
          $convert = date("d m Y N",strtotime($pasien->tanggal_pembayaran));
          $convert = explode(" ", $convert);
          $tgl = $convert[0];
          $bln = $this->get_bulan($convert[1]);
          $thn = $convert[2];
          $hari = $this->get_hari($convert[3]);
          $tgl_bayar = $hari.", ".$tgl." ".$bln." ".$thn;
          $convert = date("d m Y N",strtotime($pasien->expired));
          $convert = explode(" ", $convert);
          $tgl = $convert[0];
          $bln = $this->get_bulan($convert[1]);
          $thn = $convert[2];
          $hari = $this->get_hari($convert[3]);
          $tgl_expired = $hari.", ".$tgl." ".$bln." ".$thn;
          $data = array(
          "status_pembayaran" => $pasien->status_pembayaran,
          "biaya_pembayaran" => "Rp. ".number_format($pasien->biaya,0,"","."),
          "tanggal_pembayaran" => $tgl_bayar,
          "expired" => $tgl_expired
          ); 
        }else{
          $data = array(
            "status_pembayaran" => $pasien->status_pembayaran,
            "biaya_pembayaran" => "Rp. ".number_format($pasien->biaya,0,"",".")
            );
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