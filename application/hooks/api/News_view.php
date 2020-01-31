<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
/** @noinspection PhpIncludeInspection */
//To Solve File REST_Controller not found
require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

date_default_timezone_set('Asia/Jakarta');
class News_view extends REST_Controller {

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

        $data = array(
          'news_id' => $this->post('news_id'),
          'created_at' => date('Y-m-d H:i:s')
        );
        $in = $this->mymodel->insert('news_view',$data);
        if (!empty($in))
        {
            $response =  array('status' => 1 , 'message' => 'Berhasil read' );
        }
        else
        {
          $response =  array('status' => 0 , 'message' => 'Gagal read' );
        }
        $this->set_response($response, REST_Controller::HTTP_OK);
    }


}
