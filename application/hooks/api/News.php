<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
/** @noinspection PhpIncludeInspection */
//To Solve File REST_Controller not found
require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class News extends REST_Controller {

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
      $data = $this->mymodel->getbywherelimitsort('news','1','1',$start,$total,'news_id','desc');
        foreach ($data as $key => $value) {
            $value->img_file = base_url('assets/img/news/').$value->img_file;
            $value->tumbnail_file = base_url('assets/img/news_tumbnail/').$value->tumbnail_file;

              $date=date_create($value->created_at);
            $value->created_at = converttgl(date_format($date,"d F Y"));
            $value->category_name =  $this->mymodel->getbywhere('news_category','news_category_id',$value->news_category_id,'row')->category_name;

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
