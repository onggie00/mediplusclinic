<?php
header('Access-Control-Allow-Origin: *');
date_default_timezone_set('Asia/Jakarta');
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
ob_start();
class Login_pasien extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
    }

    function get_bulan($bulan){
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

// insert new data to account
    function index_post() {
      $token = "";
      $headers=array();
      foreach (getallheaders() as $name => $value) {
          $headers[$name] = $value;
      }
      
      $username = $this->post('username');
      $password = md5($this->post('password'));
      $msg = "";

      if ($username != "" && $password != "") {
        $cek_user = $this->mymodel->getbywhere('pasien','username',$username,'row');
        if (!empty($cek_user)) {
          $cek_pass = $this->mymodel->getbywhere('pasien',"username='".$username."' and password =",$password,'row');
          if (!empty($cek_pass)) {
            $data = $cek_pass;

        $convert = date("d m Y",strtotime($data->tanggal_lahir));
        $convert = explode(" ", $convert);
        $tgl = $convert[0];
        $bln = $this->get_bulan($convert[1]);
        $thn = $convert[2];
        $data->tanggal_lahir = $tgl." ".$bln." ".$thn;
            
            $data->img_file = base_url("assets/image/pasien/".$data->img_file);
            
            $msg = array('status' => 1, 'message'=>'Berhasil Login',"token" => $data->token);
          }else{
            $msg = array('status' => 0, 'message'=>'Password Salah!',"token" =>"");
          }

        }else{
          $msg = array('status' => 0, 'message'=>'Username tidak ditemukan!',"token" =>"");
        }
      }
        $this->response($msg);
    }

}
?>
