<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
/** @noinspection PhpIncludeInspection */
//To Solve File REST_Controller not found
require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

date_default_timezone_set('Asia/Jakarta');
class Redeem_merchandise extends REST_Controller {

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
        if (empty($cektoken)) {
            $response =  array('status' => 0 , 'message' => 'Token Tidak Ditemukan' );
        }else{
          $merchendise_id = $this->post('merchandise_id');
          $merchendise =  $this->mymodel->getbywhere('merchandise','merchandise_id',$merchendise_id,'row');
          if (isset($merchendise)) {
            if ($cektoken->poin - $merchendise->poin >= 0 ) {
              $data = array(
                  "poin" => $cektoken->poin - $merchendise->poin
              );
              $this->mymodel->update('relawan',$data,'token',$token);
              $data = array(
                  "merchandise_id" => $merchendise_id,
                  'relawan_id' => $cektoken->relawan_id,
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
              );
                $in = $this->mymodel->insert('relawan_merchandise',$data);
              $response =  array('status' => 1 , 'message' => 'Berhasil rendeem' );

            }else {
              $response =  array('status' => 0 , 'message' => 'Poin anda tidak cukup' );
            }
          }else {
            $response =  array('status' => 0 , 'message' => 'Merchandise tidak ditemukan' );
          }


        }
        $this->set_response($response, REST_Controller::HTTP_OK);
    }


}
