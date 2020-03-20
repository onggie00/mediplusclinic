<?php
date_default_timezone_set('Asia/Jakarta');

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Galery_chat extends REST_Controller {
  function __construct()
  {
      parent::__construct();
  }
  public function index_post()
  {
    if (!empty($_FILES['galery_chat']['name'])) {
      $uploaddir = './assets/galerychat/';
      $img = explode('.', $_FILES['galery_chat']['name']);
      $extension = end($img);
      $file_name =  md5(date('y-m-d h:i:s').$_FILES['galery_chat']['name']).".".$extension;
      $uploadfile = $uploaddir.$file_name;

      if (move_uploaded_file($_FILES['galery_chat']['tmp_name'], $uploadfile)) {
        $data = array(
          "file_name" => $file_name
        );
        $in = $this->mymodel->insert('galery_chat',$data);
        if ($in) {
          $type = 0;
          if ($extension == "jpeg" || $extension == "jpg" || $extension == "x-png" || $extension == "png"  ) {
            // code...
            $type = 1;
          }else{
            $type = 2;
          }
          $result = array(
            'url_galery' => base_url('assets/galerychat/'.$file_name),
            'galery_type' => $type
          );
          $msg = array('status'=>1,'message'=>'Galery Insert Success','data'=> $result);
        }else {
          $msg = array('status'=>0,'message'=>'Galery Insert Failed','data'=>array());
        }
      }else{
        $msg = array('status'=>0,'message'=>'Failed Move Files','data'=>array());
      }
    }else{
      $msg = array('status'=>0,'message'=>'Please input galery','data'=>array());
    }
    $this->response($msg);
  }
}
