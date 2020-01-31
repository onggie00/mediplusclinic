<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
/** @noinspection PhpIncludeInspection */
//To Solve File REST_Controller not found
require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

date_default_timezone_set('Asia/Jakarta');
class Kabkot extends REST_Controller {

  function __construct($config = 'rest') {
      parent::__construct($config);
  }

  // show data mahasiswa
  function index_get() {
        $id_prov = $this->get('prov_id');
        $ab = $this->mymodel->getbywheresort('kabupaten','prov_id',$id_prov,"nama","asc");
          $msg = array('status' => 1, 'message'=>'Ambil data Berhasil','data'=>$ab);
                $this->response($msg);
  }


}
