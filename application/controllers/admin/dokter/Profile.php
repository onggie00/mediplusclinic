<?php
date_default_timezone_set('Asia/Jakarta');
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {

  public function index($val = "")
  {
    $this->is_login();
    $msg = $this->session->flashdata('msg');
    $this->session->set_flashdata('msg',$msg);
    $data['title_page'] = "Manajemen Jadwal &amp; Dokter";
    $data['nama_lengkap'] = $this->mymodel->getbywhere('dokter','username',$this->session->userdata('dokter'),"row")->nama_dokter;
    $data['foto_profil'] = $this->mymodel->getbywhere('dokter','username',$this->session->userdata('dokter'),"row")->img_file;
    $data['err_msg'] =  $this->session->flashdata('msg');
    $data['success_msg'] =  $this->session->flashdata('success_msg');
    $this->load->view('admin/header_dokter', $data);
    $this->load->view('admin/dashboard');
    $this->load->view('admin/footer');
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
      $in = $this->mymodel->insert('profile',$data);
      if ($in) {
        $this->session->set_flashdata('success_msg','Data Berhasil DiTambahkan');
      }else{
        $this->session->set_flashdata('success_msg','Gagal Tambah Data');
      }
    }
    //echo $this->db->last_query();
    redirect('admin/dokter/profile/');
  }

  public function ubahpassword()
  {
    $id = $_REQUEST['data_id3'];
    $pw_lama = $this->mymodel->getbywhere('dokter','dokter_id',$id,'row')->password;
    if ($_REQUEST['password'] == $_REQUEST['cpassword']) {
      $pw_baru = md5($_REQUEST['cpassword']); 
      $data = array(
        "password" => $pw_baru
        );
      if (!empty($data)) {
        $this->mymodel->update('dokter',$data,'dokter_id',$id);
        $this->session->set_flashdata('success_msg','Berhasil Ubah Password');
      }else{
        $this->session->set_flashdata('msg','Gagal Ubah Password');
      }
    }else{
      $this->session->set_flashdata('success_msg','Password baru dan Konfirmasi Password tidak sama');
    }
    //echo $this->db->last_query();
    redirect('admin/dokter/dashboard/');
  }
  public function ubahfoto()
  {
      if(!empty($_FILES['img_file']['name'])){
            $this->load->library('upload');
            $config['upload_path'] = './assets/image/dokter/'; //path folder
            $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
            $config['encrypt_name'] = TRUE; //Enkripsi nama yang terupload
            $this->upload->initialize($config);
            if ($this->upload->do_upload('img_file')){
                $gbr = $this->upload->data();
                //Compress Image
                $config['image_library']='gd2';
                $config['source_image']='./assets/image/dokter/'.$gbr['file_name'];
                $config['create_thumb']= FALSE;
                $config['maintain_ratio']= FALSE;
                $config['quality']= '100%';
                $config['width']= 400;
                $config['height']= 400;
                $config['new_image']= './assets/image/dokter/'.$gbr['file_name'];
                $this->load->library('image_lib', $config);
                $this->image_lib->resize();
                
               $cek = $this->mymodel->getbywhere('dokter','dokter_id',$_REQUEST['data_id'],'row');
              if ($cek->img_file != "kosong.png") {
                unlink('./assets/image/dokter/'.$cek->img_file);
              }else if($cek->type_file == "1"){
                unlink('./assets/image/dokter/'.$cek->video_file);
              }

                $gambar=$gbr['file_name'];
                $data_detail  = array(
                   "img_file" => $gambar
                );
                $up = $this->mymodel->update('dokter',$data_detail,'dokter_id',$_REQUEST['data_id2']);
                $this->session->set_flashdata('success_msg','Berhasil Ubah Foto');
        }else {
          $er = $this->upload->display_errors();
          $this->session->set_flashdata('msg',"Image gagal diupload");
        }
      }else{
        $this->session->set_flashdata('msg',"Image Kosong");
      }
      redirect('admin/dokter/dashboard/');
  }
  public function deletedata()
  {
    $del = $this->mymodel->delete('profile','profile_id',$_REQUEST['data_id']);
    if ($del) {
      $this->session->set_flashdata('success_msg','Berhasil Hapus Data');
    }else{
      $this->session->set_flashdata('msg','Gagal Hapus Data! (Data Tidak Ditemukan)');
    }
    //echo $this->db->last_query();
    redirect('admin/dokter/profile/');
  }
  public function getfotoedit()
  {
    $id = $_REQUEST['id'];
    $data["data"] = $this->mymodel->getbywhere('dokter','dokter_id',$id,"row");
    $this->load->view('admin/modal_edit/ubah_foto',$data);
  }
  public function getpwedit()
  {
    $id = $_REQUEST['id'];
    $data["data"] = $this->mymodel->getbywhere('dokter','dokter_id',$id,"row");
    $this->load->view('admin/modal_edit/ubah_password_dokter',$data);
  }
  public function is_login()
  {
    $islogin = $this->session->userdata('dokter');
    if ($islogin=="") {
      redirect('admin/login_dokter/');
    }
  }
}
?>
