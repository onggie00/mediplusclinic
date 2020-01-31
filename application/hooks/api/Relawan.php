<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');
// This can be removed if you use __autoload() in config.php OR use Modular Extensions
/** @noinspection PhpIncludeInspection */
//To Solve File REST_Controller not found
require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Relawan extends REST_Controller {

    function __construct()
    {
        parent::__construct();
    }

    public function index_post()
    {
      $token = md5( date('Y-m-d H:i:s').$this->post('phone').$this->post('fullname'));
      $data = array(
        'fullname' => $this->post('fullname'),
        'phone' => $this->post('phone'),
        'email' => strtolower($this->post('email')),
        'password' => md5(md5($this->post('password'))),
        'prov_id' => $this->post('prov_id'),
        'kab_id' => $this->post('kab_id'),
        'kec_id' => $this->post('kec_id'),
        "kelurahan" => $this->post('kelurahan'),
        "address" => $this->post('address'),
        "gender" => $this->post('gender'),
        'token' => $token,
        'register_from' => $this->post('register_from'),
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s')
      );
      $cekemail =  $this->mymodel->getbywhere('relawan','email="'.$this->post('email').'" and is_deleted=0',null,'row');
      $cekphone =  $this->mymodel->getbywhere('relawan','phone="'.$this->post('phone').'" and is_deleted=0',null,'row');
      if (count($cekemail)>0&&$this->post('email')!= "") {
        $response =  array('status' => 0 , 'message' => 'Email Sudah Terdaftar', 'token'=> "" );
      }else if (count($cekphone)>0) {
        $response =  array('status' => 0 , 'message' => 'No Telepon Sudah Terdaftar', 'token'=> "" );
      }else{
        $in = $this->mymodel->insert('relawan',$data);
        if (!empty($in))
        {
            $response =  array('status' => 1 , 'message' => 'Berhasil Register', 'token'=> $token );
        }
        else
        {
          $response =  array('status' => 0 , 'message' => 'Gagal register', 'token'=> "" );
        }
      }

        $this->set_response($response, REST_Controller::HTTP_OK);
    }


}
