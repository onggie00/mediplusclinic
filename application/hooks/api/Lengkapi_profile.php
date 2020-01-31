<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
/** @noinspection PhpIncludeInspection */
//To Solve File REST_Controller not found
require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

date_default_timezone_set('Asia/Jakarta');
class Lengkapi_profile extends REST_Controller {

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
          if ($cektoken->zipcode != "" && $cektoken->rt != "" && $cektoken->rw != "") {
              $data = array(

                  "no_ktp" => $this->post('no_ktp'),
                "rt" => $this->post('rt'),
                "rw" => $this->post('rw'),
                "zipcode" => $this->post('zipcode')
              );
              $this->mymodel->update('relawan',$data,'token',$token);
              $response =  array('status' => 1 , 'message' => 'Berhasil Memperbaharui Profile' );
          }else {

            $date = date('Y-m-d');
              $data = array(
                'relawan_id' => $cektoken->relawan_id,
                'poin' => 50,
                'keterangan' => "Lengkapi Biodata",
                'created_at' => date('Y-m-d H:i:s')
              );
              $in = $this->mymodel->insert('history_poin',$data);
              $data = array(
                'poin' => $cektoken->poin + 50,
                "rt" => $this->post('rt'),
                "rw" => $this->post('rw'),
                "zipcode" => $this->post('zipcode'),
                  "no_ktp" => $this->post('no_ktp')
              );
              $this->mymodel->update('relawan',$data,'token',$token);
              $response =  array('status' => 1 , 'message' => 'Berhasil Melengkapi Profile' );
          }



        }
        $this->set_response($response, REST_Controller::HTTP_OK);
    }


}
