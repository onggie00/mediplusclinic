<?php
date_default_timezone_set('Asia/Jakarta');
defined('BASEPATH') OR exit('No direct script access allowed');

class Banner extends CI_Controller {

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
    $data['title_page'] = "Manajemen Banner Mediplus";
    $data['nama_lengkap'] = $this->mymodel->getbywhere('admin','username',$this->session->userdata('admin'),"row")->nama_lengkap;
    $data['err_msg'] =  $this->session->flashdata('msg');
    $data['success_msg'] =  $this->session->flashdata('success_msg');
    $this->load->view('admin/header', $data);
    $this->load->view('admin/data_banner');
    $this->load->view('admin/footer');
  }
  public function alldata()
  {
    $this->load->model(array('Banner_datatable'));
    $fetch_data = $this->Banner_datatable->make_datatables();
           $data = array();
           $nomor=1;
           foreach($fetch_data as $value)
           {
            if ($value->is_deleted == "0") {
                $sub_array = array();
                $sub_array[] = $nomor;
                if (!empty($value->img_file)) {
                  $sub_array[] ='<img src="'.base_url("assets/image/banner/".$value->img_file).'" alt="" width="450px" height="150px">';
                }else{
                  $sub_array[] ='<img src="'.base_url("assets/image/banner/kosong.png").'" alt="" width="450px" height="150px">';
                }
                $convert = date("d m Y N",strtotime($value->created_at));
                $convert = explode(" ", $convert);
                $tgl = $convert[0];
                $bln = $this->get_bulan($convert[1]);
                $thn = $convert[2];
                $hari = $this->get_hari($convert[3]);
                $tgl = $hari.", ".$tgl." ".$bln." ".$thn;
                $sub_array[] = $tgl;

                $sub_array[] ='
                <button type="button" name="update" id="'.$value->banner_id.'" class="btn btn-sm btn-primary update">
                <i class="mdi mdi-pencil-circle ml-1"></i> Ubah</button>
                <br><br>
                <button type="button" name="delete" id="'.$value->banner_id.'" class="btn btn-sm btn-danger delete">
                <i class="mdi mdi-delete-circle ml-1"></i> Hapus</button>';

                $data[] = $sub_array;
                $nomor++;
            }
           }
           $output = array(
                "draw"                    =>    intval($_POST["draw"]) ,
                "recordsTotal"          =>      $this->Banner_datatable->get_all_data(),
                "recordsFiltered"     =>     $this->Banner_datatable->get_filtered_data(),
                "data"                    =>     $data
           );
           echo json_encode($output);
  }
  public function insertdata()
  {
    if(!empty($_FILES["img_file"]['name'])){
      $files = $_FILES;
       $cpt = count($_FILES['img_file']['name']);
       for($i=0; $i<$cpt; $i++)
        {
            $this->load->library('upload');

          $_FILES['img_file']['name']= $files['img_file']['name'][$i];
          $_FILES['img_file']['type']= $files['img_file']['type'][$i];
          $_FILES['img_file']['tmp_name']= $files['img_file']['tmp_name'][$i];
          $_FILES['img_file']['error']= $files['img_file']['error'][$i];
          $_FILES['img_file']['size']= $files['img_file']['size'][$i];

            //$this->load->library('multi_upload');
            $config['upload_path'] = './assets/image/banner/'; //path folder
            $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
            $config['encrypt_name'] = TRUE; //Enkripsi nama yang terupload
            $this->upload->initialize($config);
            if ($this->upload->do_upload('img_file')){
                $gbr = $this->upload->data();
                //Compress Image
                /*$config['image_library']='gd2';
                $config['source_image']='./assets/image/banner/'.$gbr['file_name'];
                $config['create_thumb']= FALSE;
                $config['maintain_ratio']= FALSE;
                $config['quality']= '100%';
                $config['width']= 600;
                $config['height']= 300;
                $config['new_image']= './assets/image/banner/'.$gbr['file_name'];
                $this->load->library('image_lib', $config);
                $this->image_lib->resize();
                */
                $gambar=$gbr['file_name'];
                $data_detail  = array(
                   "img_file" => $gambar,
                   "created_at" => date("Y-m-d H:i:s"),
                   "is_deleted" => 0
                );
                $in = $this->mymodel->insert('banner',$data_detail);
                $this->session->set_flashdata('success_msg','Data Berhasil Ditambahkan');
          }else {
            $er = $this->upload->display_errors();
            echo $er;
            $this->session->set_flashdata('msg',"Image gagal diupload");
          }
        }
      }
      redirect('admin/owner/banner/');
}

  public function updatedata()
  {
    if(!empty($_FILES['img']['name'])){
          $this->load->library('upload');
          $config['upload_path'] = './assets/image/banner/'; //path folder
          $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
          $config['encrypt_name'] = TRUE; //Enkripsi nama yang terupload
          $this->upload->initialize($config);
          if ($this->upload->do_upload('img')){
              $gbr = $this->upload->data();
              //Compress Image
              /*$config['image_library']='gd2';
              $config['source_image']='./assets/image/banner/'.$gbr['file_name'];
              $config['create_thumb']= FALSE;
              $config['maintain_ratio']= FALSE;
              $config['quality']= '100%';
              $config['width']= 400;
              $config['height']= 400;
              $config['new_image']= './assets/image/banner/'.$gbr['file_name'];
              $this->load->library('image_lib', $config);
              $this->image_lib->resize();
              */
              $cek = $this->mymodel->getbywhere('banner','banner_id',$_REQUEST['data_id'],'row');
              if ($cek->img_file!=null) {
                unlink('./assets/image/banner/'.$cek->img_file);
              }
              $gambar=$gbr['file_name'];
          $data = array(
              "img_file" => $gambar,
              "created_at" => date('Y-m-d H:i:s')
            );
          if(!empty($data)){
            $up = $this->mymodel->update('banner',$data,'banner_id',$_REQUEST['data_id']);
            $this->session->set_flashdata('success_msg','Data Berhasil Diubah');
          }else{
            $this->session->set_flashdata('msg','Gagal Update Data');
          }
        }else {
          $er = $this->upload->display_errors();
          $this->session->set_flashdata('msg',"Image gagal diupload");
        }
    }
    redirect('admin/owner/banner/');
  }
  public function deletedata()
  {
    $cek = $this->mymodel->getbywhere('banner','banner_id',$_REQUEST['data_id'],'row');
    /*if ($cek->img_file!=null) {
      unlink('./assets/image/banner/'.$cek->img_file);
    }*/
    $data_banner = array(
      "is_deleted" => "1"
      );
    $del = $this->mymodel->update('banner',$data_banner,'banner_id',$_REQUEST['data_id']);
    if ($del) {
      $this->session->set_flashdata('success_msg','Berhasil Hapus Data');
    }else{
      $this->session->set_flashdata('msg','Gagal Hapus Data! (Data Tidak Ditemukan)');
    }
    //echo $this->db->last_query();
    redirect('admin/owner/banner/');
  }
  public function getdataedit()
  {
    $id = $_REQUEST['id'];
    $data["data"] = $this->mymodel->getbywhere('banner','banner_id',$id,"row");
    $this->load->view('admin/modal_edit/banner',$data);
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
