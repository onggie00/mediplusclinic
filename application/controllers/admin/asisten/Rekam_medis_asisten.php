<?php
date_default_timezone_set('Asia/Jakarta');
defined('BASEPATH') OR exit('No direct script access allowed');

class Rekam_medis_asisten extends CI_Controller {

  
  public function index($val = "")
  {
    $this->is_login();
    $msg = $this->session->flashdata('msg');
    $this->session->set_flashdata('msg',$msg);
    $data['title_page'] = "Data Rekam Medis";
    $data['nama_lengkap'] = $this->mymodel->getbywhere('asisten_dokter','username',$this->session->userdata('asisten'),"row")->nama_lengkap;
    $data['err_msg'] =  $this->session->flashdata('msg');
    $data['success_msg'] =  $this->session->flashdata('success_msg');
    $this->load->view('admin/header_asisten_dokter', $data);
    $this->load->view('admin/data_rekam_medis_asisten');
    $this->load->view('admin/footer');
  }
  public function alldata()
  {
    $this->load->model(array('Rekam_medis_datatable'));
    $fetch_data = $this->Rekam_medis_datatable->make_datatables();
           $data = array();
           $nomor=1;
           foreach($fetch_data as $value)
           {
            $get_asisten_data = $this->mymodel->getbywhere('asisten_dokter','username',$this->session->userdata('asisten'),'row');
            $get_dokter = $this->mymodel->getbywhere('dokter','dokter_id',$get_asisten_data->dokter_id,'row');
            if ($value->is_deleted == "0" && $value->dokter_id == $get_dokter->dokter_id) {
                $sub_array = array();
                $get_pasien = $this->mymodel->getbywhere('pasien','pasien_id',$value->pasien_id,'row');
                $get_klinik = $this->mymodel->getbywhere('klinik','klinik_id',$value->klinik_id,'row');
                $get_poli = $this->mymodel->getbywhere('category_poli','category_poli_id',$value->category_poli_id,'row');

                $sub_array[] = $nomor;
                $sub_array[] = $get_pasien->nama_lengkap;

                $sub_array[] ='
                <button type="button" name="detail" id="'.$value->histori_data_scan_id.'" class="btn btn-sm btn-warning detail">
                 Detail Rekam Medis</button>
                <br><br>
                <button type="button" name="update" id="'.$value->histori_data_scan_id.'" class="btn btn-sm btn-primary update">
                <i class="mdi mdi-pencil-circle ml-1"></i> Ubah</button>
                <button type="button" name="delete" id="'.$value->histori_data_scan_id.'" class="btn btn-sm btn-danger delete">
                <i class="mdi mdi-delete-circle ml-1"></i> Hapus</button>';
                
                $sub_array[] = $value->nomor_antri;
                $sub_array[] = $value->alasan_kunjungan;
                $sub_array[] = $value->keluhan_utama;
                $sub_array[] = $value->riwayat_medis;
                $sub_array[] = $value->keterangan_obat;
                $sub_array[] = $value->keterangan_lain;
                $sub_array[] = $get_dokter->nama_dokter;
                $sub_array[] = "Rp.".number_format($value->biaya,0,"",".");

                $data[] = $sub_array;
                $nomor++;
            }
           }
           $output = array(
                "draw"                    =>    intval($_POST["draw"]) ,
                "recordsTotal"          =>      $this->Rekam_medis_datatable->get_all_data(),
                "recordsFiltered"     =>     $this->Rekam_medis_datatable->get_filtered_data(),
                "data"                    =>     $data
           );
           echo json_encode($output);
  }
  public function insertdata()
  {
    $get_dokter = $this->mymodel->getbywhere('dokter','dokter_id',$_REQUEST['dokter_id'],'row');
    $data = array(
        "dokter_id" => $_REQUEST['dokter_id'],
        "pasien_id" => $_REQUEST['pasien_id'],
        "klinik_id" => $get_dokter->klinik_id,
        "category_poli_id" => $get_dokter->category_poli_id,
        "alasan_kunjungan" => $_REQUEST['alasan_kunjungan'],
        "keluhan_utama" => $_REQUEST['keluhan_utama'],
        "riwayat_medis" => $_REQUEST['riwayat_medis'],
        "nomor_antri" => $_REQUEST['nomor_antri'],
        "biaya" => $_REQUEST['biaya'],
        "created_at" => date("Y-m-d H:i:s"),
        "is_deleted" => "0"
        );
    
     if(!empty($data)){
        $in = $this->mymodel->insert('histori_data_scan',$data);
        if ($in) {
        $this->session->set_flashdata('success_msg','Data Berhasil Ditambahkan');
        }
      }else {
        $this->session->set_flashdata('msg',"Gagal Insert Data");
      }
      redirect('admin/asisten/rekam_medis_asisten/');
  }

  public function updatedata()
  {
    $get_dokter = $this->mymodel->getbywhere('dokter','dokter_id',$_REQUEST['dokter_id'],'row');
     $data = array(
        "dokter_id" => $_REQUEST['dokter_id'],
        "pasien_id" => $_REQUEST['pasien_id'],
        "klinik_id" => $get_dokter->klinik_id,
        "category_poli_id" => $get_dokter->category_poli_id,
        "alasan_kunjungan" => nl2br($_REQUEST['alasan_kunjungan']),
        "keluhan_utama" => nl2br($_REQUEST['keluhan_utama']),
        "riwayat_medis" => nl2br($_REQUEST['riwayat_medis']),
        "keterangan_obat" => nl2br($_REQUEST['keterangan_obat']),
        "keterangan_lain" => nl2br($_REQUEST['keterangan_lain']),
        "nomor_antri" => $_REQUEST['nomor_antri'],
        "biaya" => $_REQUEST['biaya'],
        "updated_at" => date("Y-m-d H:i:s")
        );
    
     if(!empty($data)){
        $up = $this->mymodel->update('histori_data_scan',$data,"histori_data_scan_id",$_REQUEST['data_id']);
        if ($up) {
        $this->session->set_flashdata('success_msg','Data Berhasil Diubah');
        }
      }else {
        $this->session->set_flashdata('msg',"Gagal Update Data");
      }
      //echo $this->db->last_query();
      redirect('admin/asisten/rekam_medis_asisten/');
  }
  public function deletedata()
  {
    $data_rekam_medis = array(
      "is_deleted" => "1",
      );
    $cek = $this->mymodel->getbywhere('detail_data_scan','histori_data_scan_id',$_REQUEST['data_id'],'result');
    foreach ($cek as $key => $value) {
      if ($value->img_file!=null) {
        unlink('./assets/image/data_scan/'.$value->img_file);
      }
    }

    $del = $this->mymodel->update('histori_data_scan',$data_rekam_medis,'histori_data_scan_id',$_REQUEST['data_id']);
    if ($del) {
      $this->session->set_flashdata('success_msg','Berhasil Hapus Data');
    }else{
      $this->session->set_flashdata('msg','Gagal Hapus Data! (Data Tidak Ditemukan)');
    }
    //echo $this->db->last_query();
    redirect('admin/asisten/rekam_medis_asisten/');
  }
  public function getdataedit()
  {
    $id = $_REQUEST['id'];
    $data["data"] = $this->mymodel->getbywhere('histori_data_scan','histori_data_scan_id',$id,"row");
    $this->load->view('admin/modal_edit/rekam_medis_asisten',$data);
  }
  public function getdetaildata()
  {
    $id = $_REQUEST['id'];
    $data["data"] = $this->mymodel->getbywhere('histori_data_scan','histori_data_scan_id',$id,"row");
    $data['detail_data'] = $this->mymodel->getbywhere('detail_data_scan','histori_data_scan_id',$id,'result');
    $this->load->view('admin/modal_edit/detail_rekam_medis_asisten',$data);
  }
  public function is_login()
  {
    $islogin = $this->session->userdata('asisten');
    if ($islogin=="") {
      redirect('admin/login_asisten/');
    }
  }
}
?>
