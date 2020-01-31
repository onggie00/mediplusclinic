<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
/** @noinspection PhpIncludeInspection */
//To Solve File REST_Controller not found
require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

date_default_timezone_set('Asia/Jakarta');
class Rank extends REST_Controller {

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

        $page = $this->get('page');
        if ( $page < 1) { $page=1; }
        $total = $this->get('total');
        $start = ($page - 1) * $total;
        $rank = $this->mymodel->withquery('SELECT   img_file, poin,relawan_id,fullname,prov_id,kab_id,@curRank := @curRank + 1 AS rank
        FROM      relawan p, (SELECT @curRank := 0) r
        ORDER BY  poin desc limit '.$start.','.$total,'result');
        foreach ($rank as $key => $value) {
            $value->kabupaten =  $this->mymodel->getbywhere('kabupaten','kab_id',$value->kab_id,'row')->nama;
            $value->provinsi =  $this->mymodel->getbywhere('provinsi','prov_id',$value->prov_id,'row')->nama;
              $value->img_file = base_url('assets/img/relawan/').$value->img_file;
        }
        $response =  array('status' => 1 , 'message' => 'Data Ditemukan' , 'data'=>$rank);
        $this->set_response($response, REST_Controller::HTTP_OK);
    }


}
