<?php
date_default_timezone_set('Asia/Jakarta');
defined('BASEPATH') OR exit('No direct script access allowed');

class Infophp extends CI_Controller {
	public function index($val = "")
  {
    echo phpinfo();
    echo php_ini_loaded_file();  
  }
	public function alldata()
  {

  }
}
?>
