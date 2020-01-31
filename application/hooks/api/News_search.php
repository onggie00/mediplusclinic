<?php
date_default_timezone_set('Asia/Jakarta');
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

use Restserver\Libraries\REST_Controller;

class News_search extends REST_Controller {

  function __construct($config = 'rest') {
      parent::__construct($config);
  }
  // show data mahasiswa
  function index_get() {
      $token = "";
      $headers=array();
      foreach (getallheaders() as $name => $value) {
          $headers[$name] = $value;
      }
      if(isset($headers['token']))
        $token =  $headers['token'];

          $data = array();
          $page = $this->get('page');
          if ( $page < 1) { $page=1; }
          $total = $this->get('total');
          $q = $this->get('q');
          $start = ($page - 1) * $total;
          $dt = $this->mymodel->getbywherelimitsort('news',"title like '%$q%'","",$start,$total,'created_at','desc');
          foreach ($dt as $key => $value) {
            $value->view_count = count($this->mymodel->getbywhere('news_view','news_id',$value->news_id));
            $value->view_count = "$value->view_count";
            $value->img_file = base_url('assets/img/news/').$value->img_file;
            $value->tumbnail_file = base_url('assets/img/news_tumbnail/').$value->tumbnail_file;
                          $date=date_create($value->created_at);
                        $value->created_at = converttgl(date_format($date,"d F Y"));
            $value->category_name =  $this->mymodel->getbywhere('news_category','news_category_id',$value->news_category_id,'row')->category_name;
          }
          if (!empty($dt))
          {
              $response =  array('status' => 1 , 'message' => 'Data ditemukan', 'data'=> $dt );
          }
          else
          {
            $response =  array('status' => 0 , 'message' => 'Data tidak ditemukan', 'data'=> $dt );
          }
          $this->set_response($response, REST_Controller::HTTP_OK);

  }


}
?>
