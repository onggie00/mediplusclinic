<?php
date_default_timezone_set('Asia/Jakarta');
defined('BASEPATH') OR exit('No direct script access allowed');

class Poli extends CI_Controller {

  
  public function index($val = "")
  {
    $this->is_login();
    $msg = $this->session->flashdata('msg');
    $this->session->set_flashdata('msg',$msg);
    $data['title_page'] = "Kategori Poli";
    $data['nama_lengkap'] = $this->mymodel->getbywhere('admin','username',$this->session->userdata('admin'),"row")->nama_lengkap;
    $data['err_msg'] =  $this->session->flashdata('msg');
    $data['success_msg'] =  $this->session->flashdata('success_msg');
    $this->load->view('admin/header', $data);
    $this->load->view('admin/data_poli');
    $this->load->view('admin/footer');
  }
  public function alldata()
  {
    $this->load->model(array('Poli_datatable'));
    $fetch_data = $this->Poli_datatable->make_datatables();
           $data = array();
           $nomor=1;
           foreach($fetch_data as $value)
           {
            if ($value->is_deleted == "0") {
                $sub_array = array();
                $sub_array[] = $nomor;
                $sub_array[] = $value->nama_poli;
                if (!empty($value->img_file)) {
                  $sub_array[] ='<img src="'.base_url("assets/image/poli/".$value->img_file).'" alt="" width="100px" height="100px">';
                }else{
                  $sub_array[] ='<img src="'.base_url("assets/image/poli/kosong.png").'" alt="" width="100px" height="100px">';
                }
                

                $sub_array[] ='
                <button type="button" name="update" id="'.$value->category_poli_id.'" class="btn btn-sm btn-primary update">
                <i class="mdi mdi-pencil-circle ml-1"></i> Ubah</button>
                <br><br>
                <button type="button" name="delete" id="'.$value->category_poli_id.'" class="btn btn-sm btn-danger delete">
                <i class="mdi mdi-delete-circle ml-1"></i> Hapus</button>';

                $data[] = $sub_array;
                $nomor++;
            }
           }
           $output = array(
                "draw"                    =>    intval($_POST["draw"]) ,
                "recordsTotal"          =>      $this->Poli_datatable->get_all_data(),
                "recordsFiltered"     =>     $this->Poli_datatable->get_filtered_data(),
                "data"                    =>     $data
           );
           echo json_encode($output);
  }
  public function insertdata()
  {
    if(!empty($_FILES['img']['name'])){
          $this->load->library('upload');
          $config['upload_path'] = './assets/image/poli/'; //path folder
          $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
          $config['encrypt_name'] = TRUE; //Enkripsi nama yang terupload
          $this->upload->initialize($config);
          if ($this->upload->do_upload('img')){
              $gbr = $this->upload->data();
              //Compress Image
              $config['image_library']='gd2';
              $config['source_image']='./assets/image/poli/'.$gbr['file_name'];
              $config['create_thumb']= FALSE;
              $config['maintain_ratio']= FALSE;
              $config['quality']= '100%';
              $config['width']= 400;
              $config['height']= 400;
              $config['new_image']= './assets/image/poli/'.$gbr['file_name'];
              $this->load->library('image_lib', $config);
              $this->image_lib->resize();

              $gambar=$gbr['file_name'];
              $data_poli  = array(
                 "nama_poli"=> $_REQUEST['nama_poli'],
                 "img_file" => $gambar
              );
              $in = $this->mymodel->insert('category_poli',$data_poli);
              $this->session->set_flashdata('success_msg','Data Berhasil Ditambahkan');
      }else {
        $er = $this->upload->display_errors();
        $this->session->set_flashdata('msg',"Image gagal diupload");
      }
    }else{
      $this->session->set_flashdata('msg',"Image yang diupload kosong");
    }
    redirect('admin/owner/poli/');
  }

  public function updatedata()
  {
    if(!empty($_FILES['img']['name'])){
          $this->load->library('upload');
          $config['upload_path'] = './assets/image/poli/'; //path folder
          $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
          $config['encrypt_name'] = TRUE; //Enkripsi nama yang terupload
          $this->upload->initialize($config);
          if ($this->upload->do_upload('img')){
              $gbr = $this->upload->data();
              //Compress Image
              $config['image_library']='gd2';
              $config['source_image']='./assets/image/poli/'.$gbr['file_name'];
              $config['create_thumb']= FALSE;
              $config['maintain_ratio']= FALSE;
              $config['quality']= '100%';
              $config['width']= 400;
              $config['height']= 400;
              $config['new_image']= './assets/image/poli/'.$gbr['file_name'];
              $this->load->library('image_lib', $config);
              $this->image_lib->resize();

              $cek = $this->mymodel->getbywhere('category_poli','category_poli_id',$_REQUEST['data_id'],'row');
              if ($cek->img_file!=null) {
                unlink('./assets/image/poli/'.$cek->img_file);
              }
              $gambar=$gbr['file_name'];
              $data_poli  = array(
                 "nama_poli"=> $_REQUEST['nama_poli'],
                 "img_file" => $gambar
              );
              $up = $this->mymodel->update('category_poli',$data_poli,"category_poli_id",$_REQUEST['data_id']);
              $this->session->set_flashdata('success_msg','Data Berhasil Diubah');
      }else {
        $er = $this->upload->display_errors();
        $this->session->set_flashdata('msg',"Image gagal diupload");
      }
    }else{
      $data = array(
        "nama_poli" => $_REQUEST['nama_poli']
        );
      $this->mymodel->update("category_poli",$data,'category_poli_id',$_REQUEST['data_id']);
      $this->session->set_flashdata('success_msg','Data Berhasil Diubah');
    }
    //echo $this->db->last_query();
    redirect('admin/owner/poli/');
  }
  public function deletedata()
  {
    $data_poli = array(
      "is_deleted" => "1",
      );
    $cek = $this->mymodel->getbywhere('category_poli','category_poli_id',$_REQUEST['data_id'],'row');
    if ($cek->img_file!=null) {
      unlink('./assets/image/poli/'.$cek->img_file);
    }
    $del = $this->mymodel->update('category_poli',$data_poli,'category_poli_id',$_REQUEST['data_id']);
    if ($del) {
      $this->session->set_flashdata('success_msg','Berhasil Hapus Data');
    }else{
      $this->session->set_flashdata('msg','Gagal Hapus Data! (Data Tidak Ditemukan)');
    }
    //echo $this->db->last_query();
    redirect('admin/owner/poli/');
  }
  public function getdataedit()
  {
    $id = $_REQUEST['id'];
    $data["data"] = $this->mymodel->getbywhere('category_poli','category_poli_id',$id,"row");
    $this->load->view('admin/modal_edit/poli',$data);
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
