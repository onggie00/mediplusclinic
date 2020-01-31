<?php
date_default_timezone_set('Asia/Jakarta');

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class ubah_foto_profile extends REST_Controller {
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

      if ($token != '') {
          $pasien = $this->mymodel->getbywhere('pasien','token',$token,"row");
          if (isset($pasien)) {
            $data=array();
            if (!empty($_FILES['img']['name'])) {
              $uploaddir = './assets/image/pasien/';
              $img = explode('.', $_FILES['img']['name']);
              $extension = end($img);
              $file_name =  md5(date('y-m-d h:i:s').$_FILES['img']['name']).".".$extension;
              $uploadfile = $uploaddir.$file_name;
              $status = 0;
              if (move_uploaded_file($_FILES['img']['tmp_name'], $uploadfile)) {
                if ($pasien->img_file!="kosong.png") {
                  unlink($uploaddir.$pasien->img_file);
                }
              $data = array(
              "img_file" => $file_name
              );
                $msg = array('success'=>1,'message'=>'Upload Foto Berhasil');
              }
            }        
            
            if (!empty($data)) {
              $this->mymodel->update('pasien',$data,'pasien_id',$pasien->pasien_id);
              $data['img_file'] = base_url('assets/image/pasien/'.$data['img_file']);
              $msg = array('status' => 1, 'message'=>'Berhasil Update profile' ,'data'=>$data);
            }else {
              $msg = array('status' => 0, 'message'=>'Data tidak ditemukan' ,'data'=>array());
            }
          }else {
              $msg = array('status' => 0, 'message'=>'Token Tidak Ditemukan ');
          }

          $this->response($msg);
      }else {
        $data = array();
        $msg = array('status' => 0, 'message'=>'Token anda kosong');
        $this->response($msg);
      }
    }
}