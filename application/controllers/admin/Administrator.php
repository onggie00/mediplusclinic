<?php
date_default_timezone_set('Asia/Jakarta');
defined('BASEPATH') OR exit('No direct script access allowed');

class Administrator extends CI_Controller {
  public function index($val = "")
  {
    $this->is_login();
    $msg = $this->session->flashdata('msg');
    $this->session->set_flashdata('msg',$msg);
    $data['title_page'] = "Administrator";
    $data['nama_lengkap'] = $this->mymodel->getbywhere('admin','username',$this->session->userdata('admin'),"row")->nama_lengkap;
    $data['err_msg'] =  $this->session->flashdata('msg');
    $data['success_msg'] =  $this->session->flashdata('success_msg');
    $this->load->view('admin/header', $data);
    $this->load->view('admin/data_administrator');
    $this->load->view('admin/footer');
  }
  public function alldata()
  {
    $this->load->model(array('Administrator_datatable'));
    $fetch_data = $this->Administrator_datatable->make_datatables();
           $data = array();
           $nomor=1;
           foreach($fetch_data as $value)
           {
                $sub_array = array();
                $sub_array[] = $nomor;
                $sub_array[] = $value->nama_lengkap;
                $sub_array[] = $value->notelp;
                $sub_array[] = $value->username;
                if ($value->privileges == 1) {
                  $sub_array[] = "Owner";
                }else if($value->privileges == 2){
                  $sub_array[] = "Admin";
                }
                
                $sub_array[] ='
                <button type="button" name="update" id="'.$value->id.'" class="btn btn-sm btn-primary update">
                <i class="iconsminds-pen"></i> Ubah</button>
                <br><br>
                <button type="button" name="delete" id="'.$value->id.'" class="btn btn-sm btn-danger delete">
                <i class="iconsminds-remove"></i> Hapus</button>';
                $data[] = $sub_array;
                $nomor++;
           }
           $output = array(
                "draw"                    =>    intval($_POST["draw"]) ,
                "recordsTotal"          =>      $this->Administrator_datatable->get_all_data(),
                "recordsFiltered"     =>     $this->Administrator_datatable->get_filtered_data(),
                "data"                    =>     $data
           );
           echo json_encode($output);
  }
  public function insertdata()
  {
    if($_REQUEST['password'] != "" && $_REQUEST['username'] != ""){
         if ($_REQUEST['password'] == $_REQUEST['cpassword']) {
          $cek_user = $this->mymodel->getbywhere('admin','username',$_REQUEST['username'],'result');
          if (!empty($cek_user) ) {
            $this->session->set_flashdata('msg','Username Sudah Terdaftar');
            redirect('admin/administrator/');
          }else{
           $data_administrator = array(
              "id" => "",
              "nama_lengkap" => $_REQUEST['nama_lengkap'],
              "notelp" => $_REQUEST['notelp'],
              "username" => $_REQUEST['username'],
              "password" => md5($_REQUEST['cpassword']),
              "privileges" => $_REQUEST['privileges']
              );
              $this->mymodel->insert('admin',$data_administrator);
              $this->session->set_flashdata('success_msg','Berhasil Tambah Data');
              redirect('admin/administrator/');
            }
         }else{
          $this->session->set_flashdata('msg','Password Dan Konfirmasi Password Tidak Sama!');
          redirect('admin/administrator/');
         }
      }else {
        $this->session->set_flashdata('msg','Data Tidak Valid (Kolom Kosong)');
        redirect('admin/administrator/');
      }
  }

  public function updatedata()
  {
    if(empty($_REQUEST['password'])){
      $data_admin = array(
        "nama_lengkap" => $_REQUEST['nama_lengkap'],
        "notelp" => $_REQUEST['notelp'],
        "privileges" => $_REQUEST['privileges']
        );
      if (!empty($data_admin)){
        $up = $this->mymodel->update('admin',$data_admin,'id',$_REQUEST['data_id']);
        $this->session->set_flashdata('success_msg','Berhasil Ubah Data');
      }
    }else if($_REQUEST['password'] == $_REQUEST['cpassword'] && !empty($_REQUEST['password'])){
       $data_admin = array(
          "nama_lengkap" => $_REQUEST['nama_lengkap'],
          "notelp" => $_REQUEST['notelp'],
          "password" => md5($_REQUEST['cpassword']),
          "privileges" => $_REQUEST['privileges']
          );
        if (!empty($data_admin)){
          $up = $this->mymodel->update('admin',$data_admin,'id',$_REQUEST['data_id']);
          $this->session->set_flashdata('success_msg','Berhasil Ubah Password');
        }
      }else{
          $this->session->set_flashdata('msg','Gagal Update! (Input Data tidak Valid / Kosong)');
      }
      //echo $this->db->last_query();
    redirect('admin/administrator/');
  }
  public function deletedata()
  {
    $this->mymodel->delete('admin','id',$_REQUEST['data_id']);
    $this->session->set_flashdata('success_msg','Berhasil Hapus Data');
    //echo $this->db->last_query();
    redirect('admin/administrator/');
  }
  public function getdataedit()
  {
    $id = $_REQUEST['id'];
    $data["data"] = $this->mymodel->getbywhere('admin','id',$id,"row");
    $this->load->view('admin/modal_edit/administrator',$data);
  }
  public function is_login()
  {
    $about_img = $this->session->userdata('admin');
    if ($about_img=="") {
      redirect('admin/login/');
    }
  }
}
?>
