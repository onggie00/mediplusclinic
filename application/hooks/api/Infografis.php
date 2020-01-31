<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
/** @noinspection PhpIncludeInspection */
//To Solve File REST_Controller not found
require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Infografis extends REST_Controller {

    function __construct()
    {
        parent::__construct();
    }

    public function index_get()
    {
      $page = $this->get('page');
      if ( $page < 1) { $page=1; }
      $total = $this->get('total');
      $start = ($page - 1) * $total;
      $data = $this->mymodel->getbywherelimitsort('infografis','1','1',$start,$total,'infografis_id','desc');
        foreach ($data as $key => $value) {
            $value->pdf_file = base_url('assets/pdf/infografis/').$value->pdf_file;
            $value->tumbnail_file = base_url('assets/img/infografis_tumbnail/').$value->tumbnail_file;
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
