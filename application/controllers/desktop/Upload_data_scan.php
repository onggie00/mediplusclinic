<?php
header('Access-Control-Allow-Origin: *');
date_default_timezone_set('Asia/Jakarta');
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
ob_start();
class Upload_data_scan extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
    }

    public function index_post()
    {
      $token = "";
      $headers=array();
      foreach (getallheaders() as $name => $value) {
          $headers[$name] = $value;
      }
      if(isset($headers['token']))
        $token =  $headers['token'];

      $msg="";
      if ($token!='') {
        $barcode = $this->post('barcode');
        $get_dokter = $this->mymodel->getbywhere('dokter','token',$token,'row');
        $get_barcode = $this->mymodel->getbywhere('barcode','barcode',$barcode,'row');
        $get_pasien = $this->mymodel->getbywhere('pasien','pasien_id',$get_barcode->pasien_id,'row');
        $data_histori = array(
            "pasien_id" => $get_pasien->pasien_id,
            "dokter_id" => $get_dokter->dokter_id,
            "klinik_id" => $get_dokter->klinik_id,
            "category_poli_id" => $get_dokter->category_poli_id,
            "created_at" => date("Y-m-d H:i:s"),
            "nomor_antri" => 0,
            "biaya" => 0
        );
        $in2 = $this->mymodel->insert('histori_data_scan',$data_histori);
        $data_histori['histori_data_scan_id'] = $this->mymodel->getlast('histori_data_scan','histori_data_scan_id')->histori_data_scan_id;
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

          $config['upload_path'] = './assets/image/data_scan/'; //path folder
          $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp|mp4|avi|flv|wmv|pdf|doc|txt|docx'; //type yang dapat diakses bisa anda sesuaikan
          $config['encrypt_name'] = TRUE; //Enkripsi nama yang terupload
            
            $this->upload->initialize($config);
            if ($this->upload->do_upload('img_file')){
                $gbr = $this->upload->data();
                $config['image_library']='gd2';
                $config['source_image'] = './assets/image/data_scan/'.$gbr['file_name'];
                $config['wm_overlay_path']  = './assets/image/admin/'."mediplus_3d_mini.png";

                $config['wm_type'] = 'overlay';
                //the overlay image
                $config['wm_opacity'] = 30;
                $config['wm_vrt_alignment'] = 'bottom';
                $config['wm_hor_alignment'] = 'right';
                $config['new_image'] = './assets/image/data_scan/'.$gbr['file_name'];
                $this->load->library('image_lib', $config);
                $this->image_lib->initialize($config);
                $this->image_lib->watermark();

                $gambar=$gbr['file_name'];
                $tipe_file = $gbr['file_ext'];
                if ($tipe_file == ".jpg" || $tipe_file == ".jpeg" || $tipe_file == ".gif" || $tipe_file == ".png" || $tipe_file == ".bmp") {
                  $data_detail  = array(
                     "histori_data_scan_id"=> $this->mymodel->getlast('histori_data_scan','histori_data_scan_id')->histori_data_scan_id,
                     "pasien_id" => $get_pasien->pasien_id,
                     "dokter_id" => $get_dokter->dokter_id,
                     "type_file" => "0",
                     "img_file" => $gambar,
                     "created_at" => date("Y-m-d H:i:s"),
                     "is_deleted" => 0
                  );
                }else if ($tipe_file == ".pdf" || $tipe_file == ".txt" || $tipe_file == ".doc" || $tipe_file == ".docx" ) {
                  $data_detail  = array(
                     "histori_data_scan_id"=> $this->mymodel->getlast('histori_data_scan','histori_data_scan_id')->histori_data_scan_id,
                     "pasien_id" => $get_pasien->pasien_id,
                     "dokter_id" => $get_dokter->dokter_id,
                     "type_file" => "2",
                     "pdf_file" => $gambar,
                     "created_at" => date("Y-m-d H:i:s"),
                     "is_deleted" => 0
                  );
                }
                else {
                exec("ffmpeg -i ".$gbr['full_path']." -pix_fmt yuv420p ".$gbr['file_path'].$gbr['raw_name'].".mp4", $output, $return_var);
                var_dump($output);
                var_dump($return_var);
                  $data_detail  = array(
                     "histori_data_scan_id"=> $this->mymodel->getlast('histori_data_scan','histori_data_scan_id')->histori_data_scan_id,
                     "pasien_id" => $get_pasien->pasien_id,
                     "dokter_id" => $get_dokter->dokter_id,
                     "type_file" => "1",
                     "video_file" => $gbr['raw_name'].".mp4",
                     //"video_file" => $gambar,
                     "created_at" => date("Y-m-d H:i:s"),
                     "is_deleted" => 0
                  );
                }
                $in = $this->mymodel->insert('detail_data_scan',$data_detail);
          }else {
            $er = $this->upload->display_errors();
            echo $er;
            $msg = array('status' => 0, 'message'=>'Gagal Upload Berkas' ,'data'=> $er);
          }
        }
        if (!empty($data_histori)) {
          $msg = array('status' => 1, 'message'=>'Berhasil Tambah Data' ,'data'=>$data_histori);
        }else {
          $msg = array('status' => 0, 'message'=>'Data Tidak Ditemukan' ,'data'=> $in);
        }
      }else {
        $data = array();
        $msg = array('status' => 0, 'message'=>'Token anda kosong');
      }
        $this->response($msg);
    }

}
?>
