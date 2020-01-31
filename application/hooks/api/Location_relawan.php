<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
/** @noinspection PhpIncludeInspection */
//To Solve File REST_Controller not found
require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

  class Location_relawan extends REST_Controller {

    function __construct()
    {
        parent::__construct();
    }

    public function index_get()
    {
        //$data = $this->mymodel->withquery('SELECT *,(select count(*) from relawan where relawan.kab_id = `kabupaten`.`kab_id`) as jumlah_relawan FROM `kabupaten` where (select count(*) from relawan where relawan.kab_id = `kabupaten`.`kab_id`) > 0','result');
        $data = $this->mymodel->withquery('SELECT *,(select count(*) from relawan where relawan.kab_id = `kabupaten`.`kab_id`) as jumlah_relawan FROM `kabupaten`','result');
        if (!empty($data))
        {
            $response =  array('status' => 1 , 'message' => 'Data ditemukan', 'data'=> $data );
        }
        else
        {
          $response =  array('status' => 0 , 'message' => 'Data tidak ditemukan', 'data'=> $data );
        }
        $this->set_response($response, REST_Controller::HTTP_OK);
    }


}
