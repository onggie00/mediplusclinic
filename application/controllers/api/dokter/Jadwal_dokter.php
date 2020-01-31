<?php
    date_default_timezone_set('Asia/Jakarta');
    
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    require APPPATH . 'libraries/REST_Controller.php';
    require APPPATH . 'libraries/Format.php';
    
    class Jadwal_dokter extends REST_Controller {
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
            
            $msg="";
            if ($token!='') {
                $pasien = $this->mymodel->getbywhere('pasien','token',$token,'row');
                $dokter_id = $this->get('dokter_id');
                $data = $this->mymodel->getbywhere("jadwal_dokter","dokter_id",$dokter_id,"result");
                if (!empty($data)) {
                    $msg = array('status' => 1, 'message'=>'Berhasil ambil data' ,'data'=>$data);
                }else {
                    $msg = array('status' => 0, 'message'=>'Data tidak ditemukan' ,'data'=>array());
                }
            }else {
                $data = array();
                $msg = array('status' => 0, 'message'=>'Token anda kosong','data'=>array());
            }
            $this->response($msg);
        }
    }
