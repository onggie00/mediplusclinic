<?php
date_default_timezone_set('Asia/Jakarta');
defined('BASEPATH') OR exit('No direct script access allowed');

class Jadwal_dokter_asisten extends CI_Controller {

  public function index($val = "")
  {
    $this->is_login();
    $msg = $this->session->flashdata('msg');
    $this->session->set_flashdata('msg',$msg);
    $data['title_page'] = "Manajemen Jadwal &amp; Dokter";
    $data['nama_lengkap'] = $this->mymodel->getbywhere('asisten_dokter','username',$this->session->userdata('asisten'),"row")->nama_lengkap;
    $data['err_msg'] =  $this->session->flashdata('msg');
    $data['success_msg'] =  $this->session->flashdata('success_msg');
    $this->load->view('admin/header_asisten_dokter', $data);
    $this->load->view('admin/data_jadwal_dokter_asisten');
    $this->load->view('admin/footer');
  }
  public function alldata()
  {
    $this->load->model(array('Jadwal_dokter_datatable'));
    $fetch_data = $this->Jadwal_dokter_datatable->make_datatables();
           $data = array();
           $nomor=1;
           foreach($fetch_data as $value)
           {
            $get_asisten_data = $this->mymodel->getbywhere('asisten_dokter','username',$this->session->userdata('asisten'),'row');
            $get_dokter = $this->mymodel->getbywhere('dokter','dokter_id',$get_asisten_data->dokter_id,'row');

            if ($value->dokter_id == $get_dokter->dokter_id) {
                $sub_array = array();
                $sub_array[] = $nomor;
                $sub_array[] = $get_dokter->nama_dokter;
                $sub_array[] = $value->senin;
                $sub_array[] = $value->selasa;
                $sub_array[] = $value->rabu;
                $sub_array[] = $value->kamis;
                $sub_array[] = $value->jumat;
                $sub_array[] = $value->sabtu;
                $sub_array[] = $value->minggu;
                if ($get_dokter->status_aktif == "0") {
                  $sub_array[] = "Tidak Hadir";
                }else{
                  $sub_array[] = "Hadir";
                }
                $sub_array[] = $get_dokter->batas_antrian;
                $sub_array[] = $get_dokter->ruangan;

                $sub_array[] ='
                <button type="button" name="update" id="'.$value->jadwal_dokter_id.'" class="btn btn-sm btn-primary update">
                <i class="mdi mdi-pencil-circle ml-1"></i> Ubah</button>
                ';

                $data[] = $sub_array;
                $nomor++;
            }
           }
           $output = array(
                "draw"                    =>    intval($_POST["draw"]) ,
                "recordsTotal"          =>      $this->Jadwal_dokter_datatable->get_all_data(),
                "recordsFiltered"     =>     $this->Jadwal_dokter_datatable->get_filtered_data(),
                "data"                    =>     $data
           );
           echo json_encode($output);
  }
  public function insertdata()
  {
    $data = array(
      "dokter_id" => $_REQUEST['dokter_id'],
      "senin" => $_REQUEST['senin'],
      "selasa" => $_REQUEST['selasa'],
      "rabu" => $_REQUEST['rabu'],
      "kamis" => $_REQUEST['kamis'],
      "jumat" => $_REQUEST['jumat'],
      "sabtu" => $_REQUEST['sabtu'],
      "minggu" => $_REQUEST['minggu']
      );
    if(!empty($data)){
      $in = $this->mymodel->insert('jadwal_dokter',$data);
      if ($in) {
        $this->session->set_flashdata('success_msg','Data Berhasil DiTambahkan');
      }else{
        $this->session->set_flashdata('success_msg','Gagal Tambah Data');
      }
    }
    //echo $this->db->last_query();
    redirect('admin/asisten/jadwal_dokter_asisten/');
  }

  public function updatedata()
  {
    $data = array(
      "senin" => $_REQUEST['senin'],
      "selasa" => $_REQUEST['selasa'],
      "rabu" => $_REQUEST['rabu'],
      "kamis" => $_REQUEST['kamis'],
      "jumat" => $_REQUEST['jumat'],
      "sabtu" => $_REQUEST['sabtu'],
      "minggu" => $_REQUEST['minggu']
      );
    if(!empty($data)){
      $up = $this->mymodel->update('jadwal_dokter',$data,'jadwal_dokter_id',$_REQUEST['data_id']);
      if ($up) {
        $data_update = array(
          "status_aktif" => $_REQUEST['status_aktif'],
          "batas_antrian" => $_REQUEST['batas_antrian'],
          "ruangan" => $_REQUEST['ruangan']
          );
        if ($data_update['status_aktif'] == "0") {
          $data_update = array(
            "status_aktif" => $_REQUEST['status_aktif'],
            "batas_antrian" => "0",
            "ruangan" => $_REQUEST['ruangan']
            );
        }
        $get_dokter = $this->mymodel->getbywhere('jadwal_dokter','jadwal_dokter_id',$_REQUEST['data_id'],'row');
        $this->mymodel->update('dokter',$data_update,'dokter_id',$get_dokter->dokter_id);
        $this->session->set_flashdata('success_msg','Data Berhasil Diubah');
      }else{
        $this->session->set_flashdata('success_msg','Gagal Update Data');
      }
    }
    //echo $this->db->last_query();
    redirect('admin/asisten/jadwal_dokter_asisten/');
  }
  public function deletedata()
  {
    $del = $this->mymodel->delete('jadwal_dokter','jadwal_dokter_id',$_REQUEST['data_id']);
    if ($del) {
      $this->session->set_flashdata('success_msg','Berhasil Hapus Data');
    }else{
      $this->session->set_flashdata('msg','Gagal Hapus Data! (Data Tidak Ditemukan)');
    }
    //echo $this->db->last_query();
    redirect('admin/asisten/jadwal_dokter_asisten/');
  }
  public function getdataedit()
  {
    $id = $_REQUEST['id'];
    $data["data"] = $this->mymodel->getbywhere('jadwal_dokter','jadwal_dokter_id',$id,"row");
    $this->load->view('admin/modal_edit/jadwal_dokter_asisten',$data);
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
