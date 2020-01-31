<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
/** @noinspection PhpIncludeInspection */
//To Solve File REST_Controller not found
require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

date_default_timezone_set('Asia/Jakarta');
class Profil extends REST_Controller {

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

        $cektoken =  $this->mymodel->getbywhere('relawan','token',$token,'result');
        if (empty($cektoken)) {
            $response =  array('status' => 0 , 'message' => 'Token Tidak Ditemukan','data' => array());
        }else{
          foreach ($cektoken as $key => $value) {
            $value->img_file = base_url('assets/img/relawan/').$value->img_file;
          }
              $response =  array('status' => 1 , 'message' => 'Berhasil Ambil Data', 'data' => $cektoken );
        }
        $this->set_response($response, REST_Controller::HTTP_OK);
    }


}
