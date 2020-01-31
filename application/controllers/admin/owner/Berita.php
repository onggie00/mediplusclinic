<?php
date_default_timezone_set('Asia/Jakarta');
defined('BASEPATH') OR exit('No direct script access allowed');

class Berita extends CI_Controller {

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
    $data['title_page'] = "Manajemen Berita Mediplus";
    $data['nama_lengkap'] = $this->mymodel->getbywhere('admin','username',$this->session->userdata('admin'),"row")->nama_lengkap;
    $data['err_msg'] =  $this->session->flashdata('msg');
    $data['success_msg'] =  $this->session->flashdata('success_msg');
    $this->load->view('admin/header', $data);
    $this->load->view('admin/data_berita');
    $this->load->view('admin/footer');
  }
  public function alldata()
  {
    $this->load->model(array('Berita_datatable'));
    $fetch_data = $this->Berita_datatable->make_datatables();
           $data = array();
           $nomor=1;
           foreach($fetch_data as $value)
           {
            if ($value->is_deleted == "0") {
                $sub_array = array();
                $sub_array[] ='
                <button type="button" name="update" id="'.$value->berita_id.'" class="btn btn-sm btn-primary update">
                <i class="mdi mdi-pencil-circle ml-1"></i> Ubah</button>
                <br><br>
                <button type="button" name="delete" id="'.$value->berita_id.'" class="btn btn-sm btn-danger delete">
                <i class="mdi mdi-delete-circle ml-1"></i> Hapus</button>';
                $sub_array[] = $nomor;
                $sub_array[] = $value->judul;
                $sub_array[] = nl2br($value->deskripsi);
                $sub_array[] = $value->sumber;
                if (!empty($value->img_file)) {
                  $sub_array[] ='<img src="'.base_url("assets/image/berita/".$value->img_file).'" alt="" width="250px" height="150px">';
                }else{
                  $sub_array[] ='<img src="'.base_url("assets/image/berita/kosong.png").'" alt="" width="250px" height="150px">';
                }
                $convert = date("d m Y N",strtotime($value->created_at));
                $convert = explode(" ", $convert);
                $tgl = $convert[0];
                $bln = $this->get_bulan($convert[1]);
                $thn = $convert[2];
                $hari = $this->get_hari($convert[3]);
                $tgl = $hari.", ".$tgl." ".$bln." ".$thn;
                $sub_array[] = $tgl;


                $data[] = $sub_array;
                $nomor++;
            }
           }
           $output = array(
                "draw"                    =>    intval($_POST["draw"]) ,
                "recordsTotal"          =>      $this->Berita_datatable->get_all_data(),
                "recordsFiltered"     =>     $this->Berita_datatable->get_filtered_data(),
                "data"                    =>     $data
           );
           echo json_encode($output);
  }
  public function insertdata()
  {
    if(!empty($_FILES["img_file"]['name'])){
          $this->load->library('upload');

            //$this->load->library('multi_upload');
            $config['upload_path'] = './assets/image/berita/'; //path folder
            $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
            $config['encrypt_name'] = TRUE; //Enkripsi nama yang terupload
            $this->upload->initialize($config);
            if ($this->upload->do_upload('img_file')){
                $gbr = $this->upload->data();
                //Compress Image
                /*$config['image_library']='gd2';
                $config['source_image']='./assets/image/berita/'.$gbr['file_name'];
                $config['create_thumb']= FALSE;
                $config['maintain_ratio']= FALSE;
                $config['quality']= '100%';
                $config['width']= 600;
                $config['height']= 300;
                $config['new_image']= './assets/image/berita/'.$gbr['file_name'];
                $this->load->library('image_lib', $config);
                $this->image_lib->resize();
                */
                $gambar=$gbr['file_name'];
                $data_detail  = array(
                  "judul" => $_REQUEST['judul'],
                  "deskripsi" => $_REQUEST['deskripsi'],
                  "sumber" => $_REQUEST['sumber'],
                   "img_file" => $gambar,
                   "created_at" => date("Y-m-d H:i:s"),
                   "is_deleted" => 0
                );
                $in = $this->mymodel->insert('berita',$data_detail);
                $this->session->set_flashdata('success_msg','Data Berhasil Ditambahkan');
          }else {
            $er = $this->upload->display_errors();
            echo $er;
            $this->session->set_flashdata('msg',"Image gagal diupload");
          }
      }else{
        $data_detail  = array(
          "judul" => $_REQUEST['judul'],
          "deskripsi" => $_REQUEST['deskripsi'],
          "sumber" => $_REQUEST['sumber'],
           "created_at" => date("Y-m-d H:i:s"),
           "is_deleted" => 0
        );
        $in = $this->mymodel->insert('berita',$data_detail);
        $this->session->set_flashdata('success_msg','Data Berhasil Ditambahkan');
      }
      redirect('admin/owner/berita/');
}

  public function updatedata()
  {
    if(!empty($_FILES['img']['name'])){
          $this->load->library('upload');
          $config['upload_path'] = './assets/image/berita/'; //path folder
          $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
          $config['encrypt_name'] = TRUE; //Enkripsi nama yang terupload
          $this->upload->initialize($config);
          if ($this->upload->do_upload('img')){
              $gbr = $this->upload->data();
              //Compress Image
              /*$config['image_library']='gd2';
              $config['source_image']='./assets/image/berita/'.$gbr['file_name'];
              $config['create_thumb']= FALSE;
              $config['maintain_ratio']= FALSE;
              $config['quality']= '100%';
              $config['width']= 400;
              $config['height']= 400;
              $config['new_image']= './assets/image/berita/'.$gbr['file_name'];
              $this->load->library('image_lib', $config);
              $this->image_lib->resize();
              */
              $cek = $this->mymodel->getbywhere('berita','berita_id',$_REQUEST['data_id'],'row');
              if ($cek->img_file!=null) {
                unlink('./assets/image/berita/'.$cek->img_file);
              }
              $gambar=$gbr['file_name'];
          $data = array(
              "judul" => $_REQUEST['judul'],
              "deskripsi" => $_REQUEST['deskripsi'],
              "sumber" => $_REQUEST['sumber'],
              "img_file" => $gambar,
              "created_at" => date('Y-m-d H:i:s')
            );
          if(!empty($data)){
            $up = $this->mymodel->update('berita',$data,'berita_id',$_REQUEST['data_id']);
            $this->session->set_flashdata('success_msg','Data Berhasil Diubah');
          }else{
            $this->session->set_flashdata('msg','Gagal Update Data');
          }
        }else {
          $er = $this->upload->display_errors();
          $this->session->set_flashdata('msg',"Image gagal diupload");
        }
    }else{
      $data = array(
              "judul" => $_REQUEST['judul'],
              "deskripsi" => $_REQUEST['deskripsi'],
              "sumber" => $_REQUEST['sumber'],
              "created_at" => date('Y-m-d H:i:s')
            );
          if(!empty($data)){
            $up = $this->mymodel->update('berita',$data,'berita_id',$_REQUEST['data_id']);
            $this->session->set_flashdata('success_msg','Data Berhasil Diubah');
          }
    }
    redirect('admin/owner/berita/');
  }
  public function deletedata()
  {
    $cek = $this->mymodel->getbywhere('berita','berita_id',$_REQUEST['data_id'],'row');
    /*if ($cek->img_file!=null) {
      unlink('./assets/image/berita/'.$cek->img_file);
    }*/
    $data_berita = array(
      "is_deleted" => "1"
      );
    $del = $this->mymodel->update('berita',$data_berita,'berita_id',$_REQUEST['data_id']);
    if ($del) {
      $this->session->set_flashdata('success_msg','Berhasil Hapus Data');
    }else{
      $this->session->set_flashdata('msg','Gagal Hapus Data! (Data Tidak Ditemukan)');
    }
    //echo $this->db->last_query();
    redirect('admin/owner/berita/');
  }
  public function getdataedit()
  {
    $id = $_REQUEST['id'];
    $data["data"] = $this->mymodel->getbywhere('berita','berita_id',$id,"row");
    $this->load->view('admin/modal_edit/berita',$data);
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
