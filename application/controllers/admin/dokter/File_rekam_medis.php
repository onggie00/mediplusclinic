<?php
date_default_timezone_set('Asia/Jakarta');
defined('BASEPATH') OR exit('No direct script access allowed');

class File_rekam_medis extends CI_Controller {

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
    $data['title_page'] = "File Rekam Medis";
    $data['nama_lengkap'] = $this->mymodel->getbywhere('dokter','username',$this->session->userdata('dokter'),"row")->nama_dokter;
    $data['foto_profil'] = $this->mymodel->getbywhere('dokter','username',$this->session->userdata('dokter'),"row")->img_file;
    $data['err_msg'] =  $this->session->flashdata('msg');
    $data['success_msg'] =  $this->session->flashdata('success_msg');
    $this->load->view('admin/header_dokter', $data);
    $this->load->view('admin/data_file_rekam_medis');
    $this->load->view('admin/footer');
  }
  public function alldata()
  {
    $this->load->model(array('File_rekam_medis_datatable'));
    $fetch_data = $this->File_rekam_medis_datatable->make_datatables();
           $data = array();
           $nomor=1;
           foreach($fetch_data as $value)
           {
            $get_dokter = $this->mymodel->getbywhere('dokter','username',$this->session->userdata('dokter'),'row');
            $get_histori_id = $this->mymodel->getbywhere('histori_data_scan',"dokter_id='".$get_dokter->dokter_id."' and pasien_id=",$value->pasien_id,'row');
            if ($value->is_deleted == "0" && $value->dokter_id == $get_histori_id->dokter_id) {
                $sub_array = array();
                $get_pasien = $this->mymodel->getbywhere('pasien','pasien_id',$value->pasien_id,'row');
                $sub_array[] = $nomor;
                $sub_array[] = $get_pasien->nama_lengkap;
                if ($value->type_file == "0") {
                $sub_array[] = "Foto"; 
                }else{
                  $sub_array[] = "Video";
                }
                if ($value->type_file == "0") {
                  if (!empty($value->img_file)) {
                    $sub_array[] ='<img src="'.base_url("assets/image/data_scan/".$value->img_file).'" alt="" width="100px" height="100px">';
                  }
                }else if($value->type_file == "1"){
                  if (!empty($value->video_file)) {
                    $sub_array[] ='<video src="'.base_url('assets/image/data_scan/'.$value->video_file).'" width="250px" controls>
                      </video>';
                  }
                }
                $convert = date("d m Y N",strtotime($value->created_at));
                $convert = explode(" ", $convert);
                $tgl = $convert[0];
                $bln = $this->get_bulan($convert[1]);
                $thn = $convert[2];
                $hari = $this->get_hari($convert[3]);
                $tgl_rekam = $hari.", ".$tgl." ".$bln." ".$thn;
                $sub_array[] = $tgl_rekam;
                $sub_array[] = $get_dokter->nama_dokter;
                

                $sub_array[] ='
                <button type="button" name="update" id="'.$value->detail_data_scan_id.'" class="btn btn-sm btn-primary update">
                <i class="mdi mdi-pencil-circle ml-1"></i> Ubah</button>
                <br><br>
                <button type="button" name="delete" id="'.$value->detail_data_scan_id.'" class="btn btn-sm btn-danger delete">
                <i class="mdi mdi-delete-circle ml-1"></i> Hapus</button>';

                $data[] = $sub_array;
                $nomor++;
            }
           }
           $output = array(
                "draw"                    =>    intval($_POST["draw"]) ,
                "recordsTotal"          =>      $this->File_rekam_medis_datatable->get_all_data(),
                "recordsFiltered"     =>     $this->File_rekam_medis_datatable->get_filtered_data(),
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
            $config['upload_path'] = './assets/image/data_scan/'; //path folder
            $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp|mp4|avi|flv|wmv'; //type yang dapat diakses bisa anda sesuaikan
            $config['encrypt_name'] = TRUE; //Enkripsi nama yang terupload
            $this->upload->initialize($config);
            if ($this->upload->do_upload('img_file')){
                $gbr = $this->upload->data();
                //Compress Image
                /*$config['image_library']='gd2';
                $config['source_image']='./assets/image/data_scan/'.$gbr['file_name'];
                $config['create_thumb']= FALSE;
                $config['maintain_ratio']= FALSE;
                $config['quality']= '100%';
                $config['width']= 400;
                $config['height']= 400;
                $config['new_image']= './assets/image/data_scan/'.$gbr['file_name'];
                $this->load->library('image_lib', $config);
                $this->image_lib->resize();
                */
                $gambar=$gbr['file_name'];
                $tipe_file = $gbr['file_ext'];
                if ($tipe_file == ".jpg" || $tipe_file == ".jpeg" || $tipe_file == ".gif" || $tipe_file == ".png" || $tipe_file == ".bmp") {
                  $data_detail  = array(
                     "histori_data_scan_id"=> $_REQUEST['histori_data_scan_id'],
                     "pasien_id" => $this->mymodel->getbywhere('histori_data_scan','histori_data_scan_id',$_REQUEST['histori_data_scan_id'],'row')->pasien_id,
                     "dokter_id" => $_REQUEST['dokter_id'],
                     "type_file" => "0",
                     "img_file" => $gambar,
                     "created_at" => date("Y-m-d H:i:s"),
                     "is_deleted" => 0
                  );
                }else {
                // ffmpeg command to convert video
                //exec("ffmpeg -i ".$gbr['full_path']." -c:v libx264 -preset slow -crf 19 -c:a libvo_aacenc -b:a 128k ".$gbr['file_path'].$gbr['raw_name'].".mp4");
                exec("ffmpeg -i ".$gbr['full_path']." -pix_fmt yuv420p ".$gbr['file_path'].$gbr['raw_name'].".mp4", $output, $return_var);
                var_dump($output);
                var_dump($return_var);
                  $data_detail  = array(
                     "histori_data_scan_id"=> $_REQUEST['histori_data_scan_id'],
                     "pasien_id" => $this->mymodel->getbywhere('histori_data_scan','histori_data_scan_id',$_REQUEST['histori_data_scan_id'],'row')->pasien_id,
                     "dokter_id" => $_REQUEST['dokter_id'],
                     "type_file" => "1",
                     "video_file" => $gbr['raw_name'].".mp4",
                     //"video_file" => $gambar,
                     "created_at" => date("Y-m-d H:i:s"),
                     "is_deleted" => 0
                  );
                }
                $in = $this->mymodel->insert('detail_data_scan',$data_detail);
                $this->session->set_flashdata('success_msg','Data Berhasil Ditambahkan');
          }else {
            $er = $this->upload->display_errors();
            echo $er;
            $this->session->set_flashdata('msg',"Image gagal diupload");
          }
        }
      }
      
    redirect('admin/dokter/rekam_medis/');
  }
  public function insertdatamultiple(){
    if ($_REQUEST['type_file'] == "0") {
       $this->load->library('upload');
       $files = $_FILES;
       $cpt = count($_FILES['img_file']['name']);
       for($i=0; $i<$cpt; $i++)
      {           
          $_FILES['img_file']['name']= $files['img_file']['name'][$i];
          $_FILES['img_file']['type']= $files['img_file']['type'][$i];
          $_FILES['img_file']['tmp_name']= $files['img_file']['tmp_name'][$i];
          $_FILES['img_file']['error']= $files['img_file']['error'][$i];
          $_FILES['img_file']['size']= $files['img_file']['size'][$i];    

          $config['upload_path'] = './assets/image/data_scan/'; //path folder
          $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
          //$config['encrypt_name'] = TRUE; //Enkripsi nama yang terupload
          
          $this->upload->initialize($config);
          $this->upload->do_upload('img_file');
          $gbr = $this->upload->data();
          $er = $this->upload->display_errors();
          echo $er;
          $data_detail  = array(
                   "histori_data_scan_id"=> $_REQUEST['histori_data_scan_id'],
                   "pasien_id" => $this->mymodel->getbywhere('histori_data_scan','histori_data_scan_id',$_REQUEST['histori_data_scan_id'],'row')->pasien_id,
                   "dokter_id" => $_REQUEST['dokter_id'],
                   "type_file" => $_REQUEST['type_file'],
                   "img_file" => $gbr['file_name'],
                   "created_at" => date("Y-m-d H:i:s"),
                   "is_deleted" => 0
                );
          $this->mymodel->insert('detail_data_scan',$data_detail);
      }

    }else if ($_REQUEST['type_file'] == "1") {
      
    }
    //redirect('admin/dokter/rekam_medis/');
  }


  public function updatedata()
  {
    if ($_REQUEST['type_file'] == "0") {
      if(!empty($_FILES['img_file']['name'])){
            $this->load->library('upload');
            $config['upload_path'] = './assets/image/data_scan/'; //path folder
            $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
            $config['encrypt_name'] = TRUE; //Enkripsi nama yang terupload
            $this->upload->initialize($config);
            if ($this->upload->do_upload('img_file')){
                $gbr = $this->upload->data();
                //Compress Image
                /*$config['image_library']='gd2';
                $config['source_image']='./assets/image/data_scan/'.$gbr['file_name'];
                $config['create_thumb']= FALSE;
                $config['maintain_ratio']= FALSE;
                $config['quality']= '100%';
                $config['width']= 400;
                $config['height']= 400;
                $config['new_image']= './assets/image/data_scan/'.$gbr['file_name'];
                $this->load->library('image_lib', $config);
                $this->image_lib->resize();
                */
               $cek = $this->mymodel->getbywhere('detail_data_scan','detail_data_scan_id',$_REQUEST['data_id'],'row');
              if ($cek->type_file=="0") {
                unlink('./assets/image/data_scan/'.$cek->img_file);
              }else if($cek->type_file == "1"){
                unlink('./assets/image/data_scan/'.$cek->video_file);
              }

                $gambar=$gbr['file_name'];
                $data_detail  = array(
                   "histori_data_scan_id"=> $_REQUEST['histori_data_scan_id'],
                   "pasien_id" => $this->mymodel->getbywhere('histori_data_scan','histori_data_scan_id',$_REQUEST['histori_data_scan_id'],'row')->pasien_id,
                   "dokter_id" => $_REQUEST['dokter_id'],
                   "type_file" => $_REQUEST['type_file'],
                   "img_file" => $gambar,
                   "created_at" => date("Y-m-d H:i:s"),
                   "is_deleted" => 0
                );
                $up = $this->mymodel->update('detail_data_scan',$data_detail,'detail_data_scan_id',$_REQUEST['data_id']);
                $this->session->set_flashdata('success_msg','Data Berhasil Diubah');
        }else {
          $er = $this->upload->display_errors();
          $this->session->set_flashdata('msg',"Image gagal diupload");
        }
      }
    }else if($_REQUEST['type_file'] == "1"){
      if(!empty($_FILES['video']['name']))
      {
            $this->load->library('upload');
            $config['upload_path'] = './assets/image/data_scan/'; //path folder
            $config['allowed_types'] = 'mp4|avi|flv|wmv|'; //type yang dapat diakses bisa anda sesuaikan
            $config['encrypt_name'] = TRUE; //Enkripsi nama yang terupload
            $this->upload->initialize($config);
            if ($this->upload->do_upload('video')){
                $gbr = $this->upload->data();
                $gambar=$gbr['file_name'];
                
                $cek = $this->mymodel->getbywhere('detail_data_scan','detail_data_scan_id',$_REQUEST['data_id'],'row');
              if ($cek->type_file=="0") {
                unlink('./assets/image/data_scan/'.$cek->img_file);
              }else if($cek->type_file == "1"){
                unlink('./assets/image/data_scan/'.$cek->video_file);
              }
              exec("ffmpeg -i ".$gbr['full_path']." -pix_fmt yuv420p ".$gbr['file_path'].$gbr['raw_name'].".mp4");
                        $data_detail  = array(
                          "histori_data_scan_id"=> $_REQUEST['histori_data_scan_id'],
                          "pasien_id" => $this->mymodel->getbywhere('histori_data_scan','histori_data_scan_id',$_REQUEST['histori_data_scan_id'],'row')->pasien_id,
                          "dokter_id" => $_REQUEST['dokter_id'],
                          "type_file" => $_REQUEST['type_file'],
                          "video_file" => $gbr['raw_name'].".mp4",
                          "created_at" => date("Y-m-d H:i:s"),
                          "is_deleted" => 0
                          );
                      $up = $this->mymodel->update('detail_data_scan',$data_detail,'detail_data_scan_id',$_REQUEST['data_id']);
                      if($up){
                        if ($gbr['file_ext'] != ".mp4") {
                          //unlink('./assets/image/data_scan/'.$gambar);
                        }
                        $this->session->set_flashdata('success_msg','Data Berhasil Diubah');
                      }else {
                          $er = $this->upload->display_errors();
                          $this->session->set_flashdata('msg',"Video gagal diupload".$er);
                      }
                    
            }
        }else {
          $er = $this->upload->display_errors();
          $this->session->set_flashdata('msg',"Video gagal diupload".$er);
        }
      }
    redirect('admin/dokter/rekam_medis/');
  }
  public function deletedata()
  {
    $cek = $this->mymodel->getbywhere('detail_data_scan','detail_data_scan_id',$_REQUEST['data_id'],'row');
    if ($cek->type_file=="0") {
      unlink('./assets/image/data_scan/'.$cek->img_file);
    }else if($cek->type_file == "1"){
      unlink('./assets/image/data_scan/'.$cek->video_file);
    }
    $del = $this->mymodel->delete('detail_data_scan','detail_data_scan_id',$_REQUEST['data_id']);
    if ($del) {
      $this->session->set_flashdata('success_msg','Berhasil Hapus Data Scan');
    }else{
      $this->session->set_flashdata('msg','Gagal Hapus Data! (Data Tidak Ditemukan)');
    }
    //echo $this->db->last_query();
    redirect('admin/dokter/rekam_medis/');
  }
  public function getdataedit()
  {
    $id = $_REQUEST['id'];
    $data["data"] = $this->mymodel->getbywhere('detail_data_scan','detail_data_scan_id',$id,"row");
    $this->load->view('admin/modal_edit/file_rekam_medis',$data);
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
