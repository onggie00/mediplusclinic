<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
/** @noinspection PhpIncludeInspection */
//To Solve File REST_Controller not found
require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Change_fcmid extends REST_Controller {

    function __construct()
    {
        parent::__construct();
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
        $cektoken =  $this->mymodel->getbywhere('relawan','token',$token,'row');
        if (count($cektoken)< 1) {
            $response =  array('status' => 0 , 'message' => 'Token Tidak Ditemukan' );
        }else{
          $data = array('fcm_id' => $this->post('fcm_id') );
          $this->mymodel->update('relawan',$data,'token',$token);
          $response =  array('status' => 1 , 'message' => 'Berhasil Ganti FCMID');
        }
        $this->set_response($response, REST_Controller::HTTP_OK);
    }


}
