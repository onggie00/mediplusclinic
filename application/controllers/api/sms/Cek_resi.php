<?php
date_default_timezone_set('Asia/Jakarta');

defined('BASEPATH') OR exit('No direct script access allowed');

use Restserver\Libraries\REST_Controller;
// This can be removed if you use __autoload() in config.php OR use Modular Extensions
/** @noinspection PhpIncludeInspection */
//To Solve File REST_Controller not found
require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';
class Cek_resi extends REST_Controller {
    function __construct()
    {
        parent::__construct();
    }

    public function rajaongkir($resi,$kurir){
      $curl = curl_init();

      curl_setopt_array($curl, array(
        CURLOPT_URL => "https://pro.rajaongkir.com/api/waybill",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => "waybill=".$resi."&courier=".$kurir,
        CURLOPT_HTTPHEADER => array(
          "content-type: application/x-www-form-urlencoded",
          "key: 37f68525a24987cb69e10d7b86aac5d5"
        ),
      ));

      $response = curl_exec($curl);
      $err = curl_error($curl);

      curl_close($curl);

      if ($err) {
        echo "cURL Error #:" . $err;
      } else {
        echo $response;
      }
    }
    public function index_post()
    {
      $token = "";
      $headers=array();
      foreach (getallheaders() as $name => $value) {
          $headers[$name] = $value;
      }
      if(isset($headers['token']))
        $token =  $headers['token'];

      if ($token != '') {
          $mem = $this->mymodel->getbywhere('member','token',$token,"row");
          //$track_id = $this->post('track_id');
          $resi = $this->post('resi');
          $kurir = $this->post('kurir');
          $message = "";
          $stats="";
          if (isset($mem)) {
            $data = $this->mymodel->withquery("select * from htrans 
              where resi ='".$resi." order by htrans_id desc'",'row');
            /*foreach ($data as $key => $value) {
              $kurir = $value->kurir;
              if ($value->updated_at==null) {
                $value->updated_at ="";
              }
            }*/
            $cek = $this->rajaongkir($resi,$kurir);
            /*foreach ($cek as $key => $value) {
              if ($value->status->code==400) {
                $message = "gagal cek, Resi Tidak Valid";
                $stats = 0;
              }else{
                $message = "Berhasil!";
                $stats = 1;
              }
            }*/

            if (!empty($data)) {
              $msg = array('status' => 1, 'message'=>'Berhasil Cek Data' ,'data'=>$cek);
            }else {
              $msg = array('status' => 0, 'message'=>'Gagal Cek Data' ,'data'=>array());
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
}
