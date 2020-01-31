
<?php
    date_default_timezone_set('Asia/Jakarta');
    
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    require APPPATH . 'libraries/REST_Controller.php';
    require APPPATH . 'libraries/Format.php';
    
    class Notifikasi extends REST_Controller {
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
                $data = $this->mymodel->withquery("select * from notifikasi_pasien where id_pasien='".$pasien->pasien_id."' order by id_notifikasi_pasien DESC",'result');
                
                
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
