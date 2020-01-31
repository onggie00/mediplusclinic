<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
/** @noinspection PhpIncludeInspection */
//To Solve File REST_Controller not found
require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

date_default_timezone_set('Asia/Jakarta');
class Mymerchandise extends REST_Controller {

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
          $c =  $this->mymodel->getbywhere('relawan_merchandise','relawan_id',$cektoken->relawan_id,'result');
          foreach ($c as $key => $value) {

              $m = $this->mymodel->getbywhere('merchandise','merchandise_id',$value->merchandise_id,'row');

                  $m->img_file = base_url('assets/img/merchandise/').$m->img_file;
                    $value->data_merchandise = $m;
          }
              $response =  array('status' => 1 , 'message' => 'Berhasil Ambil Data', 'data' => $c );
        }
        $this->set_response($response, REST_Controller::HTTP_OK);
    }


}
