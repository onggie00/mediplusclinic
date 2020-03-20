<?php
date_default_timezone_set('Asia/Jakarta');

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';
class Chat extends REST_Controller {
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

      if ($token!='') {
        $pasien = $this->mymodel->getbywhere('pasien','token',$token,'row');;
          if (isset($pasien)) {
              $pesan =$this->post('pesan');
              $url =$this->post('url_galery');
              if(empty($pesan)) $pesan="";

              $ddd = $this->post('dokter_id');
              $galery_type = $this->post('galery_type');

              $data = array(
                'chatroom_id' => 0,
                'pasien_id' => $pasien->pasien_id,
                'chat' => $pesan,
                'dokter_id' => $ddd,
                'customer_is_sender'=>1,
                'created_at' => date('Y-m-d H:i:s')
              );

              if (!empty($_FILES['galery_chat']['name'])) {
                $uploaddir = './assets/galerychat/';
                $img = explode('.', $_FILES['galery_chat']['name']);
                $extension = end($img);
                $file_name =  md5(date('y-m-d h:i:s').$_FILES['galery_chat']['name']).".".$extension;
                $uploadfile = $uploaddir.$file_name;

                if (move_uploaded_file($_FILES['galery_chat']['tmp_name'], $uploadfile)) {
                  $data["url_galery"] = base_url("assets/galerychat/".$file_name);
                  $data["galery_type"] = $galery_type;
                }
              }

              $in = $this->mymodel->insert('chat',$data);
              if ($in) {
                $msg = array('status'=>1,'message'=>'Chat Berhasil Terkirim','data'=>$data);
              }else {
                $msg = array('status'=>0,'message'=>'Gagal insert','data'=>array());
              }
              //$this->firebase($this->post('id_chat_category'),$this->post('date_time'));

          }else {
              $msg = array('status' => 0, 'message'=>'Token Tidak Ditemukan ','data'=>array());
          }

          $this->response($msg);
      }else {
        $data = array();
        $msg = array('status' => 0, 'message'=>'Token anda kosong','data'=>array());
        $this->response($msg);
      }
    }
}
