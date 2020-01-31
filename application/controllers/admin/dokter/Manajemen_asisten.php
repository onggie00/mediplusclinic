<?php
date_default_timezone_set('Asia/Jakarta');
defined('BASEPATH') OR exit('No direct script access allowed');

class Manajemen_asisten extends CI_Controller {

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
    $data['title_page'] = "Manajemen Asisten Dokter";
    $data['nama_lengkap'] = $this->mymodel->getbywhere('dokter','username',$this->session->userdata('dokter'),"row")->nama_dokter;
    $data['foto_profil'] = $this->mymodel->getbywhere('dokter','username',$this->session->userdata('dokter'),"row")->img_file;
    $data['err_msg'] =  $this->session->flashdata('msg');
    $data['success_msg'] =  $this->session->flashdata('success_msg');
    $this->load->view('admin/header_dokter', $data);
    $this->load->view('admin/data_manajemen_asisten');
    $this->load->view('admin/footer');
  }
  public function alldata()
  {
    $this->load->model(array('Asisten_datatable'));
    $fetch_data = $this->Asisten_datatable->make_datatables();
           $data = array();
           $nomor=1;
           foreach($fetch_data as $value)
           {
            $get_dokter = $this->mymodel->getbywhere('dokter','username',$this->session->userdata('dokter'),'row');
            if ($value->is_deleted == "0" && $value->dokter_id == $get_dokter->dokter_id) {
                $sub_array = array();
                $sub_array[] = $nomor;
                $sub_array[] = $value->nama_lengkap;
                $sub_array[] = $value->phone;
                $sub_array[] = $value->alamat;
                if (!empty($value->img_file)) {
                  $sub_array[] ='<img src="'.base_url("assets/image/asisten_dokter/".$value->img_file).'" alt="" width="100px" height="100px">';
                }else{
                  $sub_array[] ='<img src="'.base_url("assets/image/dokter/kosong.png").'" alt="" width="100px" height="100px">';
                }
                $sub_array[] = $get_dokter->nama_dokter;

                $sub_array[] ='
                <button type="button" name="update" id="'.$value->asisten_dokter_id.'" class="btn btn-sm btn-primary update">
                <i class="mdi mdi-pencil-circle ml-1"></i> Ubah</button>
                <br><br>
                <button type="button" name="delete" id="'.$value->asisten_dokter_id.'" class="btn btn-sm btn-danger delete">
                <i class="mdi mdi-delete-circle ml-1"></i> Hapus</button>';

                $data[] = $sub_array;
                $nomor++;
            }
           }
           $output = array(
                "draw"                    =>    intval($_POST["draw"]) ,
                "recordsTotal"          =>      $this->Asisten_datatable->get_all_data(),
                "recordsFiltered"     =>     $this->Asisten_datatable->get_filtered_data(),
                "data"                    =>     $data
           );
           echo json_encode($output);
  }
  public function insertdata()
  {
    $cek_username = $this->mymodel->getbywhere('asisten_dokter','username',$_REQUEST['username'],'row');
    if (empty($cek_username)) {
      if ($_REQUEST['password'] == $_REQUEST['cpassword']) {
        if(!empty($_FILES['img']['name'])){
          $this->load->library('upload');
          $config['upload_path'] = './assets/image/asisten_dokter/'; //path folder
          $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
          $config['encrypt_name'] = TRUE; //Enkripsi nama yang terupload
          $this->upload->initialize($config);
          if ($this->upload->do_upload('img')){
              $gbr = $this->upload->data();
              //Compress Image
              $config['image_library']='gd2';
              $config['source_image']='./assets/image/asisten_dokter/'.$gbr['file_name'];
              $config['create_thumb']= FALSE;
              $config['maintain_ratio']= FALSE;
              $config['quality']= '100%';
              $config['width']= 400;
              $config['height']= 400;
              $config['new_image']= './assets/image/asisten_dokter/'.$gbr['file_name'];
              $this->load->library('image_lib', $config);
              $this->image_lib->resize();

              $gambar=$gbr['file_name'];
          $data = array(
          "nama_lengkap" => $_REQUEST['nama_lengkap'],
          "phone" => $_REQUEST['phone'],
          "alamat" => $_REQUEST['alamat'],
          "img_file" => $gambar,
          "dokter_id" => $this->mymodel->getbywhere('dokter','username',$this->session->userdata('dokter'),'row')->dokter_id,
          "username" => $_REQUEST['username'],
          "password" => md5($_REQUEST['cpassword']),
          "created_at" => date('Y-m-d H:i:s'),
          "is_deleted" => "0"
          );

         if(!empty($data)){
            $in = $this->mymodel->insert('asisten_dokter',$data);
            if ($in) {
              $this->session->set_flashdata('success_msg','Data Berhasil Ditambahkan');
            }
          }else {
            $this->session->set_flashdata('msg',"Gagal Insert Data");
          }
        }else{
          $this->session->set_flashdata('msg',"Image yang diupload kosong");
        }
      }else{
        $this->session->set_flashdata('msg',"Password dan Konfirmasi Password tidak sama!");
      }
    }else{
      $this->session->set_flashdata('msg',"Username Sudah Terdaftar");
    }
      redirect('admin/dokter/manajemen_asisten/');
  }
}

  public function updatedata()
  {
    if(!empty($_FILES['img']['name'])){
          $this->load->library('upload');
          $config['upload_path'] = './assets/image/asisten_dokter/'; //path folder
          $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
          $config['encrypt_name'] = TRUE; //Enkripsi nama yang terupload
          $this->upload->initialize($config);
          if ($this->upload->do_upload('img')){
              $gbr = $this->upload->data();
              //Compress Image
              $config['image_library']='gd2';
              $config['source_image']='./assets/image/asisten_dokter/'.$gbr['file_name'];
              $config['create_thumb']= FALSE;
              $config['maintain_ratio']= FALSE;
              $config['quality']= '100%';
              $config['width']= 400;
              $config['height']= 400;
              $config['new_image']= './assets/image/asisten_dokter/'.$gbr['file_name'];
              $this->load->library('image_lib', $config);
              $this->image_lib->resize();

              $cek = $this->mymodel->getbywhere('asisten_dokter','asisten_dokter_id',$_REQUEST['data_id'],'row');
              if ($cek->img_file!=null) {
                unlink('./assets/image/asisten_dokter/'.$cek->img_file);
              }
              $gambar=$gbr['file_name'];
      $data = array(
        "nama_lengkap" => $_REQUEST['nama_lengkap'],
        "phone" => $_REQUEST['phone'],
        "alamat" => $_REQUEST['alamat'],
        "img_file" => $gambar,
        "updated_at" => date('Y-m-d H:i:s')
        );
    if(!empty($data)){
      $up = $this->mymodel->update('asisten_dokter',$data,'asisten_dokter_id',$_REQUEST['data_id']);
      $this->session->set_flashdata('success_msg','Data Berhasil Diubah');
    }else{
      $this->session->set_flashdata('success_msg','Gagal Update Data');
    }
      $this->session->set_flashdata('success_msg','Data Berhasil Diubah');
      }else {
        $er = $this->upload->display_errors();
        $this->session->set_flashdata('msg',"Image gagal diupload");
      }
    }else{
      $data = array(
        "nama_lengkap" => $_REQUEST['nama_lengkap'],
        "phone" => $_REQUEST['phone'],
        "alamat" => $_REQUEST['alamat'],
        "updated_at" => date('Y-m-d H:i:s')
        );
      $this->mymodel->update("asisten_dokter",$data,'asisten_dokter_id',$_REQUEST['data_id']);
      $this->session->set_flashdata('success_msg','Data Berhasil Diubah');
    }
    
    //echo $this->db->last_query();
    redirect('admin/dokter/manajemen_asisten/');
  }
  public function deletedata()
  {
    $cek = $this->mymodel->getbywhere('asisten_dokter','asisten_dokter_id',$_REQUEST['data_id'],'row');
    if ($cek->img_file!=null) {
      unlink('./assets/image/asisten_dokter/'.$cek->img_file);
    }
    $data_asisten = array(
      "is_deleted" => "1"
      );
    $del = $this->mymodel->update('asisten_dokter',$data_asisten,'asisten_dokter_id',$_REQUEST['data_id']);
    if ($del) {
      $this->session->set_flashdata('success_msg','Berhasil Hapus Data');
    }else{
      $this->session->set_flashdata('msg','Gagal Hapus Data! (Data Tidak Ditemukan)');
    }
    //echo $this->db->last_query();
    redirect('admin/dokter/manajemen_asisten/');
  }
  public function getdataedit()
  {
    $id = $_REQUEST['id'];
    $data["data"] = $this->mymodel->getbywhere('asisten_dokter','asisten_dokter_id',$id,"row");
    $this->load->view('admin/modal_edit/manajemen_asisten',$data);
  }
  public function is_login()
  {
    $about_img = $this->session->userdata('dokter');
    if ($about_img=="") {
      redirect('admin/login_dokter/');
    }
  }
}
?>
