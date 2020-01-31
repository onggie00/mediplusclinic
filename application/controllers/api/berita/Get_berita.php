<?php
header("Access-Control-Allow-Origin: *");
date_default_timezone_set('Asia/Jakarta');

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

class Get_berita extends REST_Controller {
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

        $berita = $this->mymodel->getbywherelimitsort('berita','is_deleted','0','0','6','created_at','DESC');
        if (!empty($berita)) {
          foreach ($berita as $key => $value) {
            if ($value->img_file == "") {
              $value->img_file = "kosong.png";
            }
          $value->img_file = base_url('assets/image/berita/'.$value->img_file);
          $convert = date("d m Y N H i s",strtotime($value->created_at));
          $convert = explode(" ", $convert);
          $tgl = $convert[0];
          $bln = $this->get_bulan($convert[1]);
          $thn = $convert[2];
          $hari = $this->get_hari($convert[3]);
          $value->created_at = $hari.", ".$tgl." ".$bln." ".$thn." ".$convert[4].":".$convert[5]." WIB";
          }
          
          $msg = array('status' => 1, 'message'=>'Berhasil ambil data' ,'data'=>$berita);
        }
        else{
          $msg = array('status' => 0, 'message'=>'Tidak ada berita' ,'data'=>array());
        }
        $this->response($msg);
    }
}
?>
