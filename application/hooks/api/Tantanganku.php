<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
/** @noinspection PhpIncludeInspection */
//To Solve File REST_Controller not found
require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

date_default_timezone_set('Asia/Jakarta');
class Tantanganku extends REST_Controller {

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

        $cektoken =  $this->mymodel->getbywhere('relawan','token',$token,'row');
        if (empty($cektoken)) {
            $response =  array('status' => 0 , 'message' => 'Token Tidak Ditemukan','data' => array());
        }else{
          $tantangan = array("Bagikan Berita",'Baca Berita',"Lengkapi Biodata");
          $poin = array("10","10","50");
          $data = array();
          for ($i=0; $i < count($tantangan); $i++) {
            $d = $this->mymodel->withquery("SELECT * FROM `history_poin` WHERE
              relawan_id = $cektoken->relawan_id and
              keterangan = '$tantangan[$i]' and
              substr(created_at,1,10) = '".date('Y-m-d')."'",'row');
              if (!empty($d)) {
                $dd = array('name' => $tantangan[$i],
                'poin'=> $poin[$i],'status'=>1);

                $data[] = $dd;
              }
              else {
                $dd = array('name' => $tantangan[$i],
                'poin'=> $poin[$i],'status'=>0);

                $data[] = $dd;
              }
          }

              $response =  array('status' => 1 , 'message' => 'Berhasil Ambil Data', 'data' => $data );
        }
        $this->set_response($response, REST_Controller::HTTP_OK);
    }


}
