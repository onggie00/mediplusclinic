<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
/** @noinspection PhpIncludeInspection */
//To Solve File REST_Controller not found
require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Misi extends REST_Controller {

    function __construct()
    {
        parent::__construct();
    }

    public function index_get()
    {
        $data = $this->mymodel->getall('misi');
        foreach ($data as $key => $value) {
          $value->img_file = base_url('assets/img/misi/').$value->img_file;
        }
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
