<?php
date_default_timezone_set('Asia/Jakarta');

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Ambil_antrian extends REST_Controller {
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

      $msg="";
      $nomor=0;
      if ($token != '') {
        $pasien = $this->mymodel->getbywhere('pasien','token',$token,"row");
        if (isset($pasien)) {
          $dokter_id = $this->post('dokter_id');
          $get_info_dokter = $this->mymodel->getbywhere('dokter','dokter_id',$dokter_id,'row');
          //Cek Pasien sudah antri / belum
          $cek_pasien_antri = $this->mymodel->getbywhere('antrian',"status_antrian='0' and dokter_id='".$dokter_id."' and pasien_id=",$pasien->pasien_id,"row");
          if (empty($cek_pasien_antri)) {
            $antrian_terkini = $this->mymodel->getbywhere('antrian','dokter_id',$dokter_id,'result');
          foreach ($antrian_terkini as $key => $value) {
            $nomor = $value->nomor_antri;
          }
          //Cek total Antrian dokter
          $cek_antrian = $this->mymodel->getlastwhere('antrian',"(status_antrian='0' or status_antrian='1' or status_antrian='2') and dokter_id=",$dokter_id,'nomor_antri');
            //  echo $this->db->last_query();
             // var_dump($cek_antrian);
              $antri1 = 0;
              if(!empty($cek_antrian)){
                  $antri1 = $cek_antrian->nomor_antri;
              }
          $cek_batas_antrian = $this->mymodel->getbywhere('dokter','dokter_id',$dokter_id,'row')->batas_antrian;
          $nomor++;
          if ($antri1 < $cek_batas_antrian) {
              $data = array(
                "pasien_id" => $pasien->pasien_id,
                "dokter_id" => $dokter_id,
                "klinik_id" => $get_info_dokter->klinik_id,
                "category_poli_id" => $get_info_dokter->category_poli_id,
                "nomor_antri" => $nomor,
                "notifikasi_antrian" => "3",
                "status_antrian" => "0"
                );
              $in = $this->mymodel->insert('antrian',$data);
              if ($in) {
                //cek pasien member ke dokter
                $cek_member = $this->mymodel->getbywhere('expired_payment',"pasien_id='".$pasien->pasien_id."' and dokter_id=",$dokter_id,'row');
                if (!empty($cek_member)) {
                  //cek kadaluarsa
                  $tgl_expired = date_create(date("Y-m-d",strtotime($cek_member->date_expired)));
                  $today = date_create(date("Y-m-d"));
                  $selisih = date_diff($today,$tgl_expired);
                  $selisih = $selisih->format('%r%a');
                  if ($selisih > 0) {
                    $data['status_bayar'] = "Sudah Bayar";
                    $data['biaya'] = "Rp. 0";
                  }
                }else{
                  $data['status_bayar'] = "Belum Bayar";
                  $data['biaya'] = "Rp. ".number_format($get_info_dokter->biaya,0,"",".");
                }
                if ($data['status_antrian'] == "0") {
                  $data['status_antrian'] = "Antri";
                }else if ($data['status_antrian'] == "2") {
                  $data['status_antrian'] = "Dibatalkan";
                }else{
                  $data['status_antrian'] = "Selesai";
                }
                $data['category_poli_id'] = $this->mymodel->getbywhere('category_poli','category_poli_id',$data['category_poli_id'],'row')->nama_poli;
                $data['klinik_id'] = $this->mymodel->getbywhere('klinik','klinik_id',$data['klinik_id'],'row')->nama_klinik;
                $data['pasien_id'] = $this->mymodel->getbywhere('pasien','pasien_id',$data['pasien_id'],'row')->nama_lengkap;
                $data["nama_dokter"] = $get_info_dokter->nama_dokter;
                $data['total_kunjungan'] = count($this->mymodel->getbywhere('hantrian_dokter',"pasien_id='".$pasien->pasien_id."' and dokter_id=",$dokter_id,'result'));
                //$data['nama_klinik'] = $this->mymodel->getbywhere('klinik','klinik_id',$get_info_dokter->klinik_id,'row')->nama_klinik;
                $msg = array('status' => 1, 'message'=>'Berhasil Ambil Antrian ','data'=>$data);
              }
            }else{
              $msg = array('status' => 0, 'message'=>'Telah Mencapai Batas Antrian Maksimal, Silahkan Antri Kembali Besok');
            }
          }else {
            $data = $this->mymodel->getbywhere('antrian',"dokter_id='".$dokter_id."' and pasien_id=",$pasien->pasien_id,'row');
            //cek pasien member ke dokter
            $cek_member = $this->mymodel->getbywhere('expired_payment',"pasien_id='".$pasien->pasien_id."' and dokter_id=",$dokter_id,'row');
            if (!empty($cek_member)) {
              //cek kadaluarsa
              $tgl_expired = date_create(date("Y-m-d",strtotime($cek_member->date_expired)));
              $today = date_create(date("Y-m-d"));
              $selisih = date_diff($today,$tgl_expired);
              $selisih = $selisih->format('%r%a');
            if ($selisih > 0) {
                $data->status_bayar = "Sudah Bayar";
                $data->biaya = "Rp. 0";
              }
            }else{
              $data->status_bayar = "Belum Bayar";
              $data->biaya = "Rp. ".number_format($get_info_dokter->biaya,0,"",".");
            }
            if ($data->status_antrian == "0") {
                  $data->status_antrian = "Antri";
                }else{
                  $data->status_antrian = "Selesai";
                }
                $data->category_poli_id = $this->mymodel->getbywhere('category_poli','category_poli_id',$data->category_poli_id,'row')->nama_poli;
                $data->klinik_id = $this->mymodel->getbywhere('klinik','klinik_id',$data->klinik_id,'row')->nama_klinik;
                $data->pasien_id = $this->mymodel->getbywhere('pasien','pasien_id',$data->pasien_id,'row')->nama_lengkap;
            $data->nama_dokter = $get_info_dokter->nama_dokter;
            $data->total_kunjungan = count($this->mymodel->getbywhere('hantrian_dokter',"pasien_id='".$pasien->pasien_id."' and dokter_id=",$dokter_id,'result'));
            //$data->nama_klinik = $this->mymodel->getbywhere('klinik','klinik_id',$get_info_dokter->klinik_id,'row')->nama_klinik;
            
            $msg = array('status' => 0, 'message'=>'Anda Sudah Mengambil Antrian','data'=>$data);
          }
        }else {
            $msg = array('status' => 0, 'message'=>'Token Tidak Ditemukan ');
        }
      }else {
        $data = array();
        $msg = array('status' => 0, 'message'=>'Token anda kosong');
      }
      $this->response($msg);
    }

}
