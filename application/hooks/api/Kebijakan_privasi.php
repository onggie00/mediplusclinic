  <?php
  date_default_timezone_set('Asia/Jakarta');
  use Restserver\Libraries\REST_Controller;
  defined('BASEPATH') OR exit('No direct script access allowed');

  // This can be removed if you use __autoload() in config.php OR use Modular Extensions
  /** @noinspection PhpIncludeInspection */
  //To Solve File REST_Controller not found
  require APPPATH . 'libraries/REST_Controller.php';
  require APPPATH . 'libraries/Format.php';
  class Kebijakan_privasi extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
    }

    // show data mahasiswa
    function index_get() {
      $data = $this->mymodel->getbywhere('kebijakanprivasi','1','1','row');
      $msg = array('status' => 1, 'message'=>'Data berhasil diambil','data'=>$data);
      $this->response($msg);
    }
  }
