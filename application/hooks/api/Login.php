<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
/** @noinspection PhpIncludeInspection */
//To Solve File REST_Controller not found
require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Login extends REST_Controller {

    function __construct()
    {
        parent::__construct();
    }

    public function index_post()
    {
      $email =$this->post('phone');
        $cekphone = $this->mymodel->getbywhere('relawan',"email='$email' or phone='$email'",null,"row");
        if (count($cekphone)< 1) {
            $response =  array('status' => 0 , 'message' => 'No Telepon / Email Tidak Terdaftar', 'token'=> "","fullname"=>"" );
        }else{
          if (md5(md5($this->post('password'))) != $cekphone->password) {
            $response =  array('status' => 0 , 'message' => 'Password Salah', 'token'=> "" ,'fullname'=> "");
          }else {
            $response =  array('status' => 1 , 'message' => 'Berhasil Login', 'token'=> $cekphone->token,'fullname'=> $cekphone->fullname );
          }

        }
        $this->set_response($response, REST_Controller::HTTP_OK);
    }


}
