<?php
date_default_timezone_set('Asia/Jakarta');
defined('BASEPATH') OR exit('No direct script access allowed');

class Manajemen_dokter extends CI_Controller {

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
    $data['title_page'] = "Manajemen Dokter";
    $data['nama_lengkap'] = $this->mymodel->getbywhere('admin','username',$this->session->userdata('admin'),"row")->nama_lengkap;
    $data['err_msg'] =  $this->session->flashdata('msg');
    $data['success_msg'] =  $this->session->flashdata('success_msg');
    $this->load->view('admin/header', $data);
    $this->load->view('admin/data_dokter');
    $this->load->view('admin/footer');
  }
  public function alldata()
  {
    $this->load->model(array('Dokter_datatable'));
    $fetch_data = $this->Dokter_datatable->make_datatables();
           $data = array();
           $nomor=1;
           foreach($fetch_data as $value)
           {
            if ($value->is_deleted == "0") {
                $poli = $this->mymodel->getbywhere('category_poli','category_poli_id',$value->category_poli_id,'row');
                $rs = $this->mymodel->getbywhere('klinik','klinik_id',$value->klinik_id,'row');
                $sub_array = array();
                $sub_array[] = $nomor;
                $sub_array[] = $value->nama_dokter;
                $sub_array[] = $value->phone;
                $sub_array[] = $value->username;
                $sub_array[] = $value->alamat;
                $sub_array[] = $value->email;
                $sub_array[] = $value->nomor_sip;
                if (!empty($value->img_file)) {
                  $sub_array[] ='<img src="'.base_url("assets/image/dokter/".$value->img_file).'" alt="" width="100px" height="100px">';
                }else{
                  $sub_array[] ='<img src="'.base_url("assets/image/dokter/kosong.png").'" alt="" width="100px" height="100px">';
                }
                $sub_array[] = $rs->nama_klinik;
                $sub_array[] = $poli->nama_poli;
                if ($value->is_aktif == "0") {
                  $sub_array[] = "Nonaktif";
                }else{
                  $sub_array[] = "Aktif";
                }

                if ($value->is_aktif == "0") {
                  $sub_array[] ='
                  <button type="button" name="update" id="'.$value->dokter_id.'" class="btn btn-sm btn-primary update">
                  <i class="mdi mdi-pencil-circle ml-1"></i> Ubah</button>
                  <br><br>
                  <button type="button" name="delete" id="'.$value->dokter_id.'" class="btn btn-sm btn-success delete2">
                  <i class="mdi mdi-delete-circle ml-1"></i> Aktifkan</button>
                  <br><br>
                  <button type="button" name="reset_pass" id="'.$value->dokter_id.'" class="btn btn-sm btn-secondary reset_pass">
                  <i class="mdi mdi-pencil-circle ml-1"></i> Reset Password</button>
                  ';
                }else if($value->is_aktif == "1"){
                  $sub_array[] ='
                  <button type="button" name="update" id="'.$value->dokter_id.'" class="btn btn-sm btn-primary update">
                  <i class="mdi mdi-pencil-circle ml-1"></i> Ubah</button>
                  <br><br>
                  <button type="button" name="delete" id="'.$value->dokter_id.'" class="btn btn-sm btn-danger delete">
                  <i class="mdi mdi-delete-circle ml-1"></i> Nonaktifkan</button>
                  <br><br>
                  <button type="button" name="reset_pass" id="'.$value->dokter_id.'" class="btn btn-sm btn-secondary reset_pass">
                  <i class="mdi mdi-pencil-circle ml-1"></i> Reset Password</button>
                  ';
                }
                

                $data[] = $sub_array;
                $nomor++;
            }
           }
           $output = array(
                "draw"                    =>    intval($_POST["draw"]) ,
                "recordsTotal"          =>      $this->Dokter_datatable->get_all_data(),
                "recordsFiltered"     =>     $this->Dokter_datatable->get_filtered_data(),
                "data"                    =>     $data
           );
           echo json_encode($output);
  }
  public function insertdata()
  {
    $cek_username = $this->mymodel->getbywhere('dokter','username',$_REQUEST['username'],'row');
    if (empty($cek_username)) {
      if ($_REQUEST['password'] == $_REQUEST['cpassword']) {
        if(!empty($_FILES['img']['name'])){
          $this->load->library('upload');
          $config['upload_path'] = './assets/image/dokter/'; //path folder
          $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
          $config['encrypt_name'] = TRUE; //Enkripsi nama yang terupload
          $this->upload->initialize($config);
          if ($this->upload->do_upload('img')){
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

              $gambar=$gbr['file_name'];
          $data = array(
          "nama_dokter" => $_REQUEST['nama_dokter'],
          "phone" => $_REQUEST['phone'],
          "alamat" => $_REQUEST['alamat'],
          "email" => $_REQUEST['email'],
          "img_file" => $gambar,
          "username" => $_REQUEST['username'],
          "password" => md5($_REQUEST['cpassword']),
          "token" => md5(date('Y-m-d H:i:s').$_REQUEST['username']),
          "category_poli_id" => $_REQUEST['category_poli_id'],
          "klinik_id" => $_REQUEST['klinik_id'],
          "status_pembayaran" => "0",
          "nomor_sip" => $_REQUEST['nomor_sip'],
          "is_aktif" => 1,
          "status_aktif" => 0,
          "tanggal_pembayaran" => null,
          "biaya_pembayaran" => 0,
          "expired" => null,
          "created_at" => date('Y-m-d H:i:s'),
          "is_deleted" => "0"
          );

         if(!empty($data)){
            $in = $this->mymodel->insert('dokter',$data);
            if ($in) {
              $data2 = array(
                "dokter_id" => $this->mymodel->getlast('dokter',"dokter_id")->dokter_id
                );
              $in2 = $this->mymodel->insert('jadwal_dokter',$data2);
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
      redirect('admin/owner/manajemen_dokter/');
  }
}

  public function updatedata()
  {
    if(!empty($_FILES['img']['name'])){
          $this->load->library('upload');
          $config['upload_path'] = './assets/image/dokter/'; //path folder
          $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
          $config['encrypt_name'] = TRUE; //Enkripsi nama yang terupload
          $this->upload->initialize($config);
          if ($this->upload->do_upload('img')){
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
              if ($cek->img_file!=null) {
                unlink('./assets/image/dokter/'.$cek->img_file);
              }
              $gambar=$gbr['file_name'];
      $data = array(
        "nama_dokter" => $_REQUEST['nama_dokter'],
        "phone" => $_REQUEST['phone'],
        "alamat" => $_REQUEST['alamat'],
        "email" => $_REQUEST['email'],
        "img_file" => $gambar,
        "nomor_sip" => $_REQUEST['nomor_sip'],
        "category_poli_id" => $_REQUEST['category_poli_id'],
        "klinik_id" => $_REQUEST['klinik_id'],
        "updated_at" => date('Y-m-d H:i:s')
        );
    if(!empty($data)){
      $up = $this->mymodel->update('dokter',$data,'dokter_id',$_REQUEST['data_id']);
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
        "nama_dokter" => $_REQUEST['nama_dokter'],
        "phone" => $_REQUEST['phone'],
        "alamat" => $_REQUEST['alamat'],
        "email" => $_REQUEST['email'],
        "nomor_sip" => $_REQUEST['nomor_sip'],
        "category_poli_id" => $_REQUEST['category_poli_id'],
        "klinik_id" => $_REQUEST['klinik_id'],
        "updated_at" => date('Y-m-d H:i:s')
        );
      $this->mymodel->update("dokter",$data,'dokter_id',$_REQUEST['data_id']);
      $this->session->set_flashdata('success_msg','Data Berhasil Diubah');
    }
    
    //echo $this->db->last_query();
    redirect('admin/owner/manajemen_dokter/');
  }
  public function deletedata()
  {
    $cek = $this->mymodel->getbywhere('dokter','dokter_id',$_REQUEST['data_id'],'row');
    if ($cek->img_file!=null) {
      unlink('./assets/image/dokter/'.$cek->img_file);
    }
    $data_dokter = array(
      "is_deleted" => "1"
      );
    $del = $this->mymodel->update('dokter',$data_dokter,'dokter_id',$_REQUEST['data_id']);
    if ($del) {
      $this->session->set_flashdata('success_msg','Berhasil Hapus Data');
    }else{
      $this->session->set_flashdata('msg','Gagal Hapus Data! (Data Tidak Ditemukan)');
    }
    //echo $this->db->last_query();
    redirect('admin/owner/manajemen_dokter/');
  }
  public function resetpassword(){
    $data = array(
      "password" => md5("12345678")
      );
    $res = $this->mymodel->update('dokter',$data,'dokter_id',$_REQUEST['data_id']);
    if ($res) {
      $this->session->set_flashdata('success_msg','Berhasil Reset Password');
    }else{
      $this->session->set_flashdata('msg','Gagal Reset Password! (Data Tidak Ditemukan)');
    }
    redirect('admin/owner/manajemen_dokter/');
  }
  public function getdataedit()
  {
    $id = $_REQUEST['id'];
    $data["data"] = $this->mymodel->getbywhere('dokter','dokter_id',$id,"row");
    $this->load->view('admin/modal_edit/dokter',$data);
  }
  public function nonaktif(){
    $id =$_REQUEST['data_id'];
    
    $data = array(
      "is_aktif" => 0
      );
    $up = $this->mymodel->update('dokter',$data,'dokter_id',$id);
    if ($up) {
      $this->session->set_flashdata('msg','Dokter telah di Nonaktifkan');
    }
    redirect('admin/owner/manajemen_dokter/');
  }
  public function aktif(){
    $id =$_REQUEST['data_id2'];
    
    $data = array(
      "is_aktif" => 1
      );
    $up = $this->mymodel->update('dokter',$data,'dokter_id',$id);
    if ($up) {
      $this->session->set_flashdata('success_msg','Dokter telah di Aktifkan');
    }
    echo $this->db->last_query();
    redirect('admin/owner/manajemen_dokter/');
  }
  public function is_login()
  {
    $about_img = $this->session->userdata('admin');
    $check = $this->session->userdata('kode_verifikasi');
    if ($about_img=="" || $check=="") {
      redirect('admin/login/');
    }
  }
}
?>
