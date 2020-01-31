<?php
date_default_timezone_set('Asia/Jakarta');
defined('BASEPATH') OR exit('No direct script access allowed');

class Biaya_pasien_asisten extends CI_Controller {

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
    $data['title_page'] = "Manajemen Biaya Awal Pasien";
    $data['nama_lengkap'] = $this->mymodel->getbywhere('asisten_dokter','username',$this->session->userdata('asisten'),"row")->nama_lengkap;
    $data['err_msg'] =  $this->session->flashdata('msg');
    $data['success_msg'] =  $this->session->flashdata('success_msg');
    $this->load->view('admin/header_asisten_dokter', $data);
    $this->load->view('admin/data_biaya_pasien_asisten');
    $this->load->view('admin/footer');
  }
  public function alldata()
  {
    $this->load->model(array('Biaya_pasien_asisten_datatable'));
    $fetch_data = $this->Biaya_pasien_asisten_datatable->make_datatables();
           $data = array();
           $nomor=1;
           foreach($fetch_data as $value)
           {
            $get_asisten_data = $this->mymodel->getbywhere('asisten_dokter','username',$this->session->userdata('asisten'),'row');
            if ($value->dokter_id == $get_asisten_data->dokter_id) {
              $pasien = $this->mymodel->getbywhere('pasien','pasien_id',$value->pasien_id,'row');
              $dokter = $this->mymodel->getbywhere('dokter','dokter_id',$value->dokter_id,'row');
                $sub_array = array();
                $sub_array[] = $nomor;
                $sub_array[] = $pasien->nama_lengkap;;
                $sub_array[] = $dokter->nama_dokter;
                $convert = date("d m Y N",strtotime($value->date_payment));
                $convert = explode(" ", $convert);
                $tgl = $convert[0];
                $bln = $this->get_bulan($convert[1]);
                $thn = $convert[2];
                $hari = $this->get_hari($convert[3]);
                $tgl = $hari.", ".$tgl." ".$bln." ".$thn;
                $sub_array[] = $tgl;
                $convert = date("d m Y N",strtotime($value->date_expired));
                $convert = explode(" ", $convert);
                $tgl = $convert[0];
                $bln = $this->get_bulan($convert[1]);
                $thn = $convert[2];
                $hari = $this->get_hari($convert[3]);
                $tgl = $hari.", ".$tgl." ".$bln." ".$thn;
                $sub_array[] = $tgl;
                $sub_array[] = "Rp. ".number_format($value->biaya,0,"",".");
                //Cek Kadaluarsa
                $tgl_expired = date_create(date("Y-m-d",strtotime($value->date_expired)));
                $today = date_create(date("Y-m-d"));
                $selisih = date_diff($today,$tgl_expired);
                $selisih = $selisih->format('%r%a');
                if ($selisih < 0) {
                  $sub_array[] = "Sudah Tidak Berlaku (Expired)";
                }else if($selisih == 0){
                  $sub_array[] = "Jatuh Tempo Hari ini";
                }else{
                  $sub_array[] = "Masih Berlaku";
                }
                $sub_array[] ='
                <button type="button" name="update" id="'.$value->expired_payment_id.'" class="btn btn-sm btn-primary update">
                <i class="mdi mdi-pencil-circle ml-1"></i> Ubah</button>
                <br><br>
                <button type="button" name="delete" id="'.$value->expired_payment_id.'" class="btn btn-sm btn-danger delete">
                <i class="mdi mdi-delete-circle ml-1"></i> Hapus</button>';
                $data[] = $sub_array;
                $nomor++;
            }
           }
           $output = array(
                "draw"                    =>    intval($_POST["draw"]) ,
                "recordsTotal"          =>      $this->Biaya_pasien_asisten_datatable->get_all_data(),
                "recordsFiltered"     =>     $this->Biaya_pasien_asisten_datatable->get_filtered_data(),
                "data"                    =>     $data
           );
           echo json_encode($output);
  }
  public function insertdata()
  {
    $data= array();
    //Cek terdaftar / tidak
    $get_info_pasien = $this->mymodel->getbywhere('expired_payment',"pasien_id='".$_REQUEST['pasien_id']."' and dokter_id=",$_REQUEST['dokter_id'],'row');
    if (!empty($get_info_pasien)) {
      //Cek Kadaluarsa
      $tgl_expired = date_create(date("Y-m-d",strtotime($value->date_expired)));
      $today = date_create(date("Y-m-d"));
      $selisih = date_diff($today,$tgl_expired);
      $selisih = $selisih->format('%r%a');

      $this->session->set_flashdata('msg',"Gagal Insert Data (Masa Aktif masih berlaku, Silahkan Hapus Data lama dahulu untuk menambahkan data tersebut)");
    }else{
      $get_asisten = $this->mymodel->getbywhere('asisten_dokter','username',$this->session->userdata('asisten'),'row');
      $get_dokter = $this->mymodel->getbywhere('dokter','dokter_id',$get_asisten->dokter_id,'row');
      $data = array(
        "dokter_id" => $_REQUEST['dokter_id'],
        "pasien_id" => $_REQUEST['pasien_id'],
        "date_payment" => date("Y-m-d H:i:s"),
        "date_expired" => date("Y-m-d H:i:s",strtotime($_REQUEST['date_expired']."+1 year")),
        "biaya" => $_REQUEST['biaya']
        );
      if(!empty($data)){
        $in = $this->mymodel->insert('expired_payment',$data);
        if ($in) {
        $this->session->set_flashdata('success_msg','Data Berhasil Ditambahkan');
        }
      }else {
        $this->session->set_flashdata('msg',"Gagal Insert Data (Masa Aktif masih berlaku, Silahkan Hapus Data lama dahulu untuk menambahkan data tersebut)");
      }
    }
      redirect('admin/asisten/dashboard/');
  }

  public function updatedata()
  {
     $data_update = array(
        "dokter_id" => $_REQUEST['dokter_id'],
        "pasien_id" => $_REQUEST['pasien_id'],
        "date_payment" => $_REQUEST['date_payment'],
        "date_expired" => $_REQUEST['date_expired'],
        "biaya" => $_REQUEST['biaya']
        );
    if(!empty($data_update)){
      $up = $this->mymodel->update('expired_payment',$data_update,'expired_payment_id',$_REQUEST['data_id']);
      if ($up) {
        $this->session->set_flashdata('success_msg','Data Berhasil Diubah');
      }else{
        $this->session->set_flashdata('success_msg','Gagal Update Data');
      }
    }
    //echo $this->db->last_query();
    redirect('admin/asisten/biaya_pasien_asisten/');
  }
  public function deletedata()
  {
    $del = $this->mymodel->delete('expired_payment','expired_payment_id',$_REQUEST['data_id']);
    if ($del) {
      $this->session->set_flashdata('success_msg','Berhasil Hapus Data');
    }else{
      $this->session->set_flashdata('msg','Gagal Hapus Data! (Data Tidak Ditemukan)');
    }
    //echo $this->db->last_query();
    redirect('admin/asisten/biaya_pasien_asisten/');
  }
  public function getdataedit()
  {
    $id = $_REQUEST['id'];
    $data["data"] = $this->mymodel->getbywhere('expired_payment','expired_payment_id',$id,"row");
    $this->load->view('admin/modal_edit/biaya_pasien_asisten',$data);
  }
  public function is_login()
  {
    $islogin = $this->session->userdata('asisten');
    if ($islogin=="") {
      redirect('admin/login_asisten/');
    }
  }
}
?>
