
<?php
    date_default_timezone_set('Asia/Jakarta');
    
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    require APPPATH . 'libraries/REST_Controller.php';
    require APPPATH . 'libraries/Format.php';
    
    class Pencarian_dokter extends REST_Controller {
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
                $klinik_id = ""; $category_poli_id=""; $keyword="";
                if ($this->get('klinik_id')!=null) {
                    $klinik_id = $this->get('klinik_id');
                }
                if ($this->get('poli_id')!=null) {
                    $category_poli_id = $this->get('poli_id');
                }
                if ($this->get('keyword')!=null) {
                    $keyword = $this->get('keyword');
                }
                $q = "select * from dokter where is_deleted='0' ";
                if ($klinik_id != "") {
                    $q = $q."and klinik_id='".$klinik_id."' ";
                }
                if ($category_poli_id != "") {
                    $q = $q."and category_poli_id='".$category_poli_id."' ";
                }
                if ($keyword != "") {
                    $q = $q."and nama_dokter like '%".$keyword."%' ";
                }

                $data = $this->mymodel->withquery($q,'result');
                foreach ($data as $key => $value) {
                    $get_antrian_terakhir = $this->mymodel->withquery("select count(*) as jumlah from antrian where klinik_id='".$klinik_id."' and category_poli_id='".$value->category_poli_id."' ","row");
                    $value->antrian_terakhir = $get_antrian_terakhir->jumlah;
                    if (empty($value->antrian_terakhir)) {
                        $value->antrian_terakhir = "0";
                    }
                    if (empty($value->img_file)) {
                        $value->img_file = "kosong.png";
                    }
                    $value->img_file = base_url('assets/image/dokter/'.$value->img_file);
                    $get_poli_dokter = $this->mymodel->getbywhere('category_poli','category_poli_id',$value->category_poli_id,'row');
                    $value->poli_img_file = base_url('assets/image/poli/'.$get_poli_dokter->img_file);
                    $get_kunjungan = $this->mymodel->withquery("select count(*) as jumlah from histori_data_scan where pasien_id='".$pasien->pasien_id."' and dokter_id='".$value->dokter_id."' ","row");
                    $value->total_kunjungan = $get_kunjungan->jumlah;
                    if ($value->status_aktif == '0') {
                        $value->status_aktif = "Tidak Hadir";
                    }else if($value->status_aktif == '1'){
                        $value->status_aktif = "Hadir";
                    }
                    if ($value->is_aktif == '0') {
                        $value->is_aktif = "Dokter tidak aktif";
                    }else{
                        $value->is_aktif = "Dokter Aktif";
                    }
                    $value->klinik_id = $this->mymodel->getbywhere('klinik','klinik_id',$value->klinik_id,'row')->nama_klinik;
                    $value->category_poli_id = $this->mymodel->getbywhere('category_poli',"category_poli_id",$value->category_poli_id,'row')->nama_poli;
                }
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
