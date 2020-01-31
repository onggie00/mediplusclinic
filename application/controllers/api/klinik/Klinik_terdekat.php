<?php
date_default_timezone_set('Asia/Jakarta');

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

class Klinik_terdekat extends REST_Controller {
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

      if ($token != '') {
        $radius = $this->get('radius');
        if (empty($radius)) {
          $radius = 14;
        }
          $pasien = $this->mymodel->getbywhere('pasien','token',$token,"row");
          if (isset($pasien)) {

            $page = $this->get('page');
            if ( $page < 1) { $page=1; }
            $total = $this->get('total');
            $start = ($page - 1) * $total;
            
            $data = $this->mymodel->withquery("select *, ( 6371 * acos( cos( radians(".$pasien->latitude.") ) * cos( radians( latitude ) ) * 
cos( radians( longitude ) - radians(".$pasien->longitude.") ) + sin( radians(".$pasien->latitude.") ) * 
sin( radians( latitude ) ) ) ) AS jarak FROM  klinik HAVING
jarak < ".$radius." AND status_pembayaran = '1' AND is_deleted = '0' ORDER BY jarak","result");
            
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
              $msg = array('status' => 0, 'message'=>'Token Tidak Ditemukan ');
          }

          $this->response($msg);
      }else {
        $data = array();
        $msg = array('status' => 0, 'message'=>'Token anda kosong');
        $this->response($msg);
      }
    }

    /*function getmerchant_terdekat($latitude1, $longitude1, $latitude2, $longitude2, $unit = 'Km') 
    {
       $theta = $longitude1 - $longitude2;
       $distance = (sin(deg2rad($latitude1)) * sin(deg2rad($latitude2))+
                   (cos(deg2rad($latitude1)) * cos(deg2rad($latitude2)) * cos(deg2rad($theta)));
       $distance = acos($distance); $distance = rad2deg($distance); 
       $distance = $distance * 60 * 1.1515;

       switch($unit) 
       { 
         case 'Mi': break;
         case 'Km' : $distance = $distance * 1.609344; 
       } 
       return (round($distance,2)); 
    }*/
}
