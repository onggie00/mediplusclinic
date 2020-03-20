<?php
date_default_timezone_set('Asia/Jakarta');
defined('BASEPATH') OR exit('No direct script access allowed');

class Rumah_sakit extends CI_Controller {

  public function index($val = "")
  {
    $this->is_login();
    $msg = $this->session->flashdata('msg');
    $this->session->set_flashdata('msg',$msg);
    $data['title_page'] = "Manajemen Rumah Sakit";
    $data['nama_lengkap'] = $this->mymodel->getbywhere('admin','username',$this->session->userdata('admin'),"row")->nama_lengkap;
    $data['err_msg'] =  $this->session->flashdata('msg');
    $data['success_msg'] =  $this->session->flashdata('success_msg');
    $this->load->view('admin/header', $data);
    $this->load->view('admin/data_rumah_sakit');
    $this->load->view('admin/footer');
  }
  public function alldata()
  {
    $this->load->model(array('Rumah_sakit_datatable'));
    $fetch_data = $this->Rumah_sakit_datatable->make_datatables();
           $data = array();
           $nomor=1;
           foreach($fetch_data as $value)
           {
            if ($value->is_deleted == "0") {
                $sub_array = array();
                $sub_array[] = $nomor;
                $sub_array[] = $value->nama_klinik;
                $sub_array[] = $value->phone;
                $sub_array[] = $value->paket;
                if ($value->tanggal_expired != null) {
                  $sub_array[] = date("d M Y H:i:s",strtotime($value->tanggal_expired));
                }else{
                  $sub_array[] = "Tidak ada";
                }
                $sub_array[] = $value->email;
                $sub_array[] = $value->longitude;
                $sub_array[] = $value->latitude;
                $sub_array[] = $value->jam_buka_tutup;
                $sub_array[] = $value->hari_buka_tutup;
                if (!empty($value->img_file)) {
                  $sub_array[] ='<img src="'.base_url("assets/image/klinik/".$value->img_file).'" alt="" width="100px" height="100px">';
                }else{
                  $sub_array[] ='<img src="'.base_url("assets/image/klinik/kosong.png").'" alt="" width="100px" height="100px">';
                }

                $sub_array[] ='
                <button type="button" name="detail" id="'.$value->klinik_id.'" class="btn btn-sm btn-warning detail">
                 Detail Poli Rumah Sakit</button>
                <br><br>
                <button type="button" name="update" id="'.$value->klinik_id.'" class="btn btn-sm btn-primary update">
                <i class="mdi mdi-pencil-circle ml-1"></i> Ubah</button>
                <button type="button" name="delete" id="'.$value->klinik_id.'" class="btn btn-sm btn-danger delete">
                <i class="mdi mdi-delete-circle ml-1"></i> Hapus</button>
                <br><br>
                <button type="button" name="biaya_klinik" id="'.$value->klinik_id.'" class="btn btn-sm btn-secondary biaya_klinik">
                 Tambah / Ubah Sewa</button>
                ';

                $data[] = $sub_array;
                $nomor++;
            }
           }
           $output = array(
                "draw"                    =>    intval($_POST["draw"]) ,
                "recordsTotal"          =>      $this->Rumah_sakit_datatable->get_all_data(),
                "recordsFiltered"     =>     $this->Rumah_sakit_datatable->get_filtered_data(),
                "data"                    =>     $data
           );
           echo json_encode($output);
  }
  public function insertdata()
  {
    if(!empty($_FILES['img']['name'])){
          $this->load->library('upload');
          $config['upload_path'] = './assets/image/klinik/'; //path folder
          $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
          $config['encrypt_name'] = TRUE; //Enkripsi nama yang terupload
          $this->upload->initialize($config);
          if ($this->upload->do_upload('img')){
              $gbr = $this->upload->data();
              //Compress Image
              $config['image_library']='gd2';
              $config['source_image']='./assets/image/klnik/'.$gbr['file_name'];
              $config['create_thumb']= FALSE;
              $config['maintain_ratio']= FALSE;
              $config['quality']= '100%';
              $config['width']= 400;
              $config['height']= 400;
              $config['new_image']= './assets/image/klinik/'.$gbr['file_name'];
              $this->load->library('image_lib', $config);
              $this->image_lib->resize();

              $gambar=$gbr['file_name'];
              
              $nama_paket = null;
              $paket = null;
              if ($_REQUEST['paket_aktif'] == "1") {
                $nama_paket = "1 Bulan";
                $paket = date("Y-m-d H:i:s",strtotime($_REQUEST['tanggal_pembayaran']."+1 month"));
              }else if($_REQUEST['paket_aktif'] == "2"){
                $nama_paket = "3 Bulan";
                $paket = date("Y-m-d H:i:s",strtotime($_REQUEST['tanggal_pembayaran']."+3 month"));
              }else if($_REQUEST['paket_aktif'] == "3"){
                $nama_paket = "6 Bulan";
                $paket = date("Y-m-d H:i:s",strtotime($_REQUEST['tanggal_pembayaran']."+6 month"));
              }else if($_REQUEST['paket_aktif'] == "4"){
                $nama_paket = "1 Tahun";
                $paket = date("Y-m-d H:i:s",strtotime($_REQUEST['tanggal_pembayaran']."+1 year"));
              }
              else if($_REQUEST['paket_aktif'] == "5"){
                $nama_paket = "Selamanya";
              }
              $data_klinik  = array(
                 "nama_klinik"=> $_REQUEST['nama_klinik'],
                 "img_file" => $gambar,
                 "phone" => $_REQUEST['phone'],
                 "email" => $_REQUEST['email'],
                 "alamat" => $_REQUEST['alamat'],
                 "jam_buka_tutup" => $_REQUEST['jam_buka_tutup'],
                 "hari_buka_tutup" => $_REQUEST['hari_buka_tutup'],
                 "longitude" => $_REQUEST['longitude'],
                 "latitude" => $_REQUEST['latitude'],
                 "tanggal_pembayaran" => date("Y-m-d H:i:s"),
                 "biaya" => $_REQUEST['biaya'],
                 "paket" => $nama_paket,
                 "tanggal_expired" => $paket,
                 "status_pembayaran" => "1",
                 "is_deleted" => "0"
              );
              $in = $this->mymodel->insert('klinik',$data_klinik);
              $data_trans_klinik = array(
                "klinik_id" => $this->mymodel->getlast('klinik','klinik_id')->klinik_id,
                "paket" => $nama_paket,
                "tanggal_pembayaran" => date("Y-m-d H:i:s"),
                "tanggal_expired" => $paket,
                "biaya" => $_REQUEST['biaya'],
                "status_pembayaran" => "1",
                "created_at" => date('Y-m-d H:i:s'),
                "is_deleted" => 0
              );
              $in2 = $this->mymodel->insert('trans_klinik',$data_trans_klinik);
              $data2 = array(
                "is_aktif" => 1
              );
              $up = $this->mymodel->update('dokter',$data2,"klinik_id",$this->mymodel->getlast('klinik','klinik_id')->klinik_id);
              if ($in && $in2 && $up) {
                $this->session->set_flashdata('success_msg','Data Berhasil Ditambahkan');
              }
      }else {
        $er = $this->upload->display_errors();
        $this->session->set_flashdata('msg',"Image gagal diupload");
      }
    }else{
      $this->session->set_flashdata('msg',"Image yang diupload kosong");
    }
      redirect('admin/owner/rumah_sakit/');
  }

  public function updatedata()
  {
    if(!empty($_FILES['img']['name'])){
          $this->load->library('upload');
          $config['upload_path'] = './assets/image/klinik/'; //path folder
          $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
          $config['encrypt_name'] = TRUE; //Enkripsi nama yang terupload
          $this->upload->initialize($config);
          if ($this->upload->do_upload('img')){
              $gbr = $this->upload->data();
              //Compress Image
              $config['image_library']='gd2';
              $config['source_image']='./assets/image/klinik/'.$gbr['file_name'];
              $config['create_thumb']= FALSE;
              $config['maintain_ratio']= FALSE;
              $config['quality']= '100%';
              $config['width']= 400;
              $config['height']= 400;
              $config['new_image']= './assets/image/klinik/'.$gbr['file_name'];
              $this->load->library('image_lib', $config);
              $this->image_lib->resize();

              $cek = $this->mymodel->getbywhere('klinik','klinik_id',$_REQUEST['data_id'],'row');
              if ($cek->img_file!=null) {
                unlink('./assets/image/klinik/'.$cek->img_file);
              }
              $gambar=$gbr['file_name'];
              $data_klinik  = array(
                 "nama_klinik"=> $_REQUEST['nama_klinik'],
                 "img_file" => $gambar,
                 "alamat" => $_REQUEST['alamat'],
                 "phone" => $_REQUEST['phone'],
                 "email" => $_REQUEST['email'],
                 "jam_buka_tutup" => $_REQUEST['jam_buka_tutup'],
                 "hari_buka_tutup" => $_REQUEST['hari_buka_tutup'],
                 "longitude" => $_REQUEST['longitude'],
                 "latitude" => $_REQUEST['latitude']
              );
              $up = $this->mymodel->update('klinik',$data_klinik,'klinik_id',$_REQUEST['data_id']);
              $this->session->set_flashdata('success_msg','Data Berhasil Diubah');
      }else {
        $er = $this->upload->display_errors();
        $this->session->set_flashdata('msg',"Image gagal diupload");
      }
    }else{
      $data_klinik  = array(
         "nama_klinik"=> $_REQUEST['nama_klinik'],
         "alamat" => $_REQUEST['alamat'],
         "phone" => $_REQUEST['phone'],
         "jam_buka_tutup" => $_REQUEST['jam_buka_tutup'],
         "email" => $_REQUEST['email'],
         "hari_buka_tutup" => $_REQUEST['hari_buka_tutup'],
         "longitude" => $_REQUEST['longitude'],
         "latitude" => $_REQUEST['latitude']
        );
      $up = $this->mymodel->update('klinik',$data_klinik,'klinik_id',$_REQUEST['data_id']);
      $this->session->set_flashdata('success_msg','Data Berhasil Diubah');
    }
    //echo $this->db->last_query();
    redirect('admin/owner/rumah_sakit/');
  }
  public function deletedata()
  {
    $data_rumah_sakit = array(
      "is_deleted" => "1"
      );
    $del = $this->mymodel->update('klinik',$data_rumah_sakit,'klinik_id',$_REQUEST['data_id']);
    if ($del) {
      $this->mymodel->delete('poli_klinik','klinik_id',$_REQUEST['data_id']);
      $this->session->set_flashdata('success_msg','Berhasil Hapus Data');
    }else{
      $this->session->set_flashdata('msg','Gagal Hapus Data! (Data Tidak Ditemukan)');
    }
    //echo $this->db->last_query();
    redirect('admin/owner/rumah_sakit/');
  }
  public function getdataedit()
  {
    $id = $_REQUEST['id'];
    $data["data"] = $this->mymodel->getbywhere('klinik','klinik_id',$id,"row");
    $this->load->view('admin/modal_edit/rumah_sakit',$data);
  }
  public function getdetaildata()
  {
    $id = $_REQUEST['id'];
    $data["data"] = $this->mymodel->getbywhere('poli_klinik','klinik_id',$id,"result");
    $data['klinik'] = $this->mymodel->getbywhere('klinik','klinik_id',$id,'row');
    $this->load->view('admin/modal_edit/detail_rumah_sakit',$data);
  }
  public function insertpoliklinik(){
    $inputnum = count($_REQUEST['check_poli']);
    for ($i=0;$i < $inputnum; $i++) {
      $data = array(
      "category_poli_id" => $_REQUEST['check_poli'][$i],
      "klinik_id" => $_REQUEST['klinik_id']
      );
     $in = $this->mymodel->insert('poli_klinik',$data);
     $this->session->set_flashdata('success_msg','Berhasil Tambah Poli');
    }
    redirect('admin/owner/rumah_sakit');
  }
  public function deletepoliklinik(){
     $del = $this->mymodel->delete('poli_klinik','poli_klinik_id',$_REQUEST['data_id']);
     $this->session->set_flashdata('success_msg','Berhasil Hapus Poli');
    //echo $this->db->last_query();
    redirect('admin/owner/rumah_sakit');
  }
  public function is_login()
  {
    $about_img = $this->session->userdata('admin');
    $check = $this->session->userdata('kode_verifikasi');
    if ($about_img=="" || $check =="") {
      redirect('admin/login/');
    }
  }
}
?>
