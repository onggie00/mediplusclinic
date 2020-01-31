<?php
date_default_timezone_set('Asia/Jakarta');
defined('BASEPATH') OR exit('No direct script access allowed');

class Pasien_dokter_asisten extends CI_Controller {

  public function get_bulan($bulan){
    $bln = "";
    if ($bulan == 1) {
      $bln = "Januari";
    }else if ($bulan == 2) {
      $bln = "Februari";
    }else if ($bulan == 3) {
      $bln = "Maret";
    }else if ($bulan == 4) {
      $bln = "April";
    }else if ($bulan == 5) {
      $bln = "Mei";
    }else if ($bulan == 6) {
      $bln = "Juni";
    }else if ($bulan == 7) {
      $bln = "Juli";
    }else if ($bulan == 8) {
      $bln = "Agustus";
    }else if ($bulan == 9) {
      $bln = "September";
    }else if ($bulan == 10) {
      $bln = "Oktober";
    }else if ($bulan == 11) {
      $bln = "November";
    }else if ($bulan == 12) {
      $bln = "Desember";
    }
    return $bln;
  }
  public function get_hari($h){
    $hari = "";
    if ($h == 1) {
      $hari = "Senin";
    }else if ($h == 2) {
      $hari = "Selasa";
    }else if ($h == 3) {
      $hari = "Rabu";
    }else if ($h == 4) {
      $hari = "Kamis";
    }else if ($h == 5) {
      $hari = "Jumat";
    }else if ($h == 6) {
      $hari = "Sabtu";
    }else if ($h == 7) {
      $hari = "Minggu";
    }
    return $hari;
  }
  public function index($val = "")
  {
    $this->is_login();
    $msg = $this->session->flashdata('msg');
    $this->session->set_flashdata('msg',$msg);
    $data['title_page'] = "Manajemen Pasien Berlangganan";
    $data['nama_lengkap'] = $this->mymodel->getbywhere('asisten_dokter','username',$this->session->userdata('asisten'),"row")->nama_lengkap;
    $data['err_msg'] =  $this->session->flashdata('msg');
    $data['success_msg'] =  $this->session->flashdata('success_msg');
    $this->load->view('admin/header_asisten_dokter', $data);
    $this->load->view('admin/data_pasien_dokter_asisten');
    $this->load->view('admin/footer');
  }
  public function alldata()
  {
    $this->load->model(array('Pasien_dokter_asisten_datatable'));
    $fetch_data = $this->Pasien_dokter_asisten_datatable->make_datatables();
           $data = array();
           $nomor=1;
           foreach($fetch_data as $value)
           {
            $get_asisten_data = $this->mymodel->getbywhere('asisten_dokter','username',$this->session->userdata('asisten'),'row');
            if ($value->dokter_id == $get_asisten_data->dokter_id) {
              $get_dokter = $this->mymodel->getbywhere('dokter','dokter_id',$value->dokter_id,'row');
              $pasien = $this->mymodel->getbywhere('pasien','pasien_id',$value->pasien_id,'row');
              $klinik = $this->mymodel->getbywhere('klinik','klinik_id',$get_dokter->klinik_id,'row');
              $dokter = $this->mymodel->getbywhere('dokter','dokter_id',$value->dokter_id,'row');
                $sub_array = array();
                $sub_array[] = $nomor;
                $sub_array[] = $pasien->nama_lengkap;
                $sub_array[] = $klinik->nama_klinik;
                $sub_array[] = $get_dokter->ruangan;
                $sub_array[] = $dokter->nama_dokter;
                $convert = date("d m Y N",strtotime($value->date_payment));
                $convert = explode(" ", $convert);
                $tgl = $convert[0];
                $bln = $this->get_bulan($convert[1]);
                $thn = $convert[2];
                $hari = $this->get_hari($convert[3]);
                $tgl = $hari.", ".$tgl." ".$bln." ".$thn;
                $sub_array[] = "Rp. ".number_format($value->biaya,0,"",".");
                $sub_array[] = $tgl;
                
                $data[] = $sub_array;
                $nomor++;
            }
           }
           $output = array(
                "draw"                    =>    intval($_POST["draw"]) ,
                "recordsTotal"          =>      $this->Pasien_dokter_asisten_datatable->get_all_data(),
                "recordsFiltered"     =>     $this->Pasien_dokter_asisten_datatable->get_filtered_data(),
                "data"                    =>     $data
           );
           echo json_encode($output);
  }
  public function insertdata()
  {
      $data = array(
        "dokter_id" => $_REQUEST['dokter_id'],
        "pasien_id" => $_REQUEST['pasien_id'],
        "klinik_id" => $_REQUEST['klinik_id'],
        "ruangan" => $_REQUEST['ruangan'],
        "created_at" => date("Y-m-d H:i:s"),
        "biaya" => $_REQUEST['biaya'],
        "is_deleted" => "0"
        );
    
     if(!empty($data)){
        $in = $this->mymodel->insert('hantrian_dokter',$data);
        if ($in) {
        $this->session->set_flashdata('success_msg','Data Berhasil Ditambahkan');
        }
      }else {
        $this->session->set_flashdata('msg',"Gagal Insert Data");
      }
      redirect('admin/asisten/pasien_dokter_asisten/');
  }

  public function updatedata()
  {
    $data_update = array(
        "dokter_id" => $_REQUEST['dokter_id'],
        "pasien_id" => $_REQUEST['pasien_id'],
        "klinik_id" => $_REQUEST['klinik_id'],
        "ruangan" => $_REQUEST['ruangan'],
        "created_at" => date("Y-m-d H:i:s"),
        "biaya" => $_REQUEST['biaya']
        );
    if(!empty($data_update)){
      $up = $this->mymodel->update('hantrian_dokter',$data_update,'hantrian_dokter_id',$_REQUEST['data_id']);
      if ($up) {
        $this->session->set_flashdata('success_msg','Data Berhasil Diubah');
      }else{
        $this->session->set_flashdata('success_msg','Gagal Update Data');
      }
    }
    //echo $this->db->last_query();
    redirect('admin/asisten/pasien_dokter_asisten/');
  }
  public function deletedata()
  {
    $data_transaksi_dokter = array(
      "is_deleted" => "1"
      );
    $del = $this->mymodel->update('hantrian_dokter',$data_transaksi_dokter,'hantrian_dokter_id',$_REQUEST['data_id']);
    if ($del) {
      $this->session->set_flashdata('success_msg','Berhasil Hapus Data');
    }else{
      $this->session->set_flashdata('msg','Gagal Hapus Data! (Data Tidak Ditemukan)');
    }
    //echo $this->db->last_query();
    redirect('admin/asisten/pasien_dokter_asisten/');
  }
  public function getdataedit()
  {
    $id = $_REQUEST['id'];
    $data["data"] = $this->mymodel->getbywhere('hantrian_dokter','hantrian_dokter_id',$id,"row");
    $this->load->view('admin/modal_edit/pasien_dokter_asisten',$data);
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
