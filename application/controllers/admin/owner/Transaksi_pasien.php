<?php
date_default_timezone_set('Asia/Jakarta');
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi_pasien extends CI_Controller {

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
    $data['title_page'] = "Transaksi Pasien";
    $data['nama_lengkap'] = $this->mymodel->getbywhere('admin','username',$this->session->userdata('admin'),"row")->nama_lengkap;
    $data['err_msg'] =  $this->session->flashdata('msg');
    $data['success_msg'] =  $this->session->flashdata('success_msg');
    $this->load->view('admin/header', $data);
    $this->load->view('admin/data_transaksi_pasien');
    $this->load->view('admin/footer');
  }
  public function alldata()
  {
    $this->load->model(array('Transaksi_pasien_datatable'));
    $fetch_data = $this->Transaksi_pasien_datatable->make_datatables();
           $data = array();
           $nomor=1;
           foreach($fetch_data as $value)
           {
            if ($value->is_deleted == "0") {
              $pasien = $this->mymodel->getbywhere('pasien','pasien_id',$value->pasien_id,'row');
                $sub_array = array();
                $sub_array[] = $nomor;
                $sub_array[] = $pasien->nama_lengkap;
                if ($value->status_pembayaran == "1") {
                  $sub_array[] = "LUNAS";
                  $convert = date("d m Y N",strtotime($pasien->tanggal_pembayaran));
                  $convert = explode(" ", $convert);
                  $tgl = $convert[0];
                  $bln = $this->get_bulan($convert[1]);
                  $thn = $convert[2];
                  $hari = $this->get_hari($convert[3]);
                  $tgl_bayar = $hari.", ".$tgl." ".$bln." ".$thn;
                  $convert = date("d m Y N",strtotime($pasien->expired));
                  $convert = explode(" ", $convert);
                  $tgl = $convert[0];
                  $bln = $this->get_bulan($convert[1]);
                  $thn = $convert[2];
                  $hari = $this->get_hari($convert[3]);
                  $tgl_expired = $hari.", ".$tgl." ".$bln." ".$thn;
                  $sub_array[] = $tgl_bayar;
                  $sub_array[] = "Rp. ".number_format($value->biaya_pembayaran,0,"",".");
                  $sub_array[] = $tgl_expired;
                }else{
                  $sub_array[] = "MENUNGGU PEMBAYARAN";
                  $sub_array[] = "Belum Dibayar";
                  $sub_array[] = "Rp. ".number_format($value->biaya_pembayaran,0,"",".");
                  $sub_array[] = "Belum tersedia";
                }

                $data[] = $sub_array;
                $nomor++;
            }
           }
           $output = array(
                "draw"                    =>    intval($_POST["draw"]) ,
                "recordsTotal"          =>      $this->Transaksi_pasien_datatable->get_all_data(),
                "recordsFiltered"     =>     $this->Transaksi_pasien_datatable->get_filtered_data(),
                "data"                    =>     $data
           );
           echo json_encode($output);
  }
  public function insertdata()
  {
    $data = array();
    if ($_REQUEST['status_pembayaran'] == "1") {
      $data = array(
        "pasien_id" => $_REQUEST['pasien_id'],
        "status_pembayaran" => $_REQUEST['status_pembayaran'],
        "tanggal_pembayaran" => $_REQUEST['tanggal_pembayaran'],
        "biaya_pembayaran" => $_REQUEST['biaya_pembayaran'],
        "expired" => date("Y-m-d H:i:s",strtotime($_REQUEST['tanggal_pembayaran']."+1 year")),
        "created_at" => date('Y-m-d H:i:s')
        );
    }else{
      $data = array(
        "pasien_id" => $_REQUEST['pasien_id'],
        "status_pembayaran" => $_REQUEST['status_pembayaran'],
        "tanggal_pembayaran" => null,
        "biaya_pembayaran" => $_REQUEST['biaya_pembayaran'],
        "expired" => null,
        "created_at" => date('Y-m-d H:i:s')
        );
    }
     if(!empty($data)){
        $in = $this->mymodel->insert('trans_pasien',$data);
        if ($in) {
          $data_update = array();
          if ($_REQUEST['status_pembayaran'] == "1") {
            $data_update = array(
            "status_pembayaran" => $_REQUEST['status_pembayaran'],
            "tanggal_pembayaran" => $_REQUEST['tanggal_pembayaran'],
            "biaya_pembayaran" => $_REQUEST['biaya_pembayaran'],
            "expired" => date("Y-m-d H:i:s",strtotime($_REQUEST['tanggal_pembayaran']."+1 year")),
            "updated_at" => date("Y-m-d H:i:s")
            );
          }else{
            $data_update = array(
            "status_pembayaran" => $_REQUEST['status_pembayaran'],
            "tanggal_pembayaran" => null,
            "biaya_pembayaran" => $_REQUEST['biaya_pembayaran'],
            "expired" => null,
            "updated_at" => date("Y-m-d H:i:s")
            );
          }
        $up = $this->mymodel->update('pasien',$data_update,'pasien_id',$_REQUEST['pasien_id']);
        $this->session->set_flashdata('success_msg','Data Berhasil Ditambahkan');
        }
      }else {
        $this->session->set_flashdata('msg',"Gagal Insert Data");
      }
      redirect('admin/owner/transaksi_pasien/');
  }

  public function updatedata()
  {
    $data_update = array(
        "pasien_id" => $_REQUEST['pasien_id'],
        "status_pembayaran" => $_REQUEST['status_pembayaran'],
        "tanggal_pembayaran" => $_REQUEST['tanggal_pembayaran'],
        "biaya_pembayaran" => $_REQUEST['biaya_pembayaran'],
        "expired" => date("Y-m-d H:i:s",strtotime($_REQUEST['tanggal_pembayaran']."+1 year"))
        );
    if(!empty($data_update)){
      $up = $this->mymodel->update('trans_pasien',$data_update,'trans_pasien_id',$_REQUEST['data_id']);
      echo $up;
      if ($up) {
        $expired = null;
        if ($_REQUEST['status_pembayaran'] == "1") {
        $expired = date("Y-m-d H:i:s",strtotime($_REQUEST['tanggal_pembayaran']."+1 year"));
        }
        $data_update2 = array(
          "status_pembayaran" => $_REQUEST['status_pembayaran'],
          "tanggal_pembayaran" => $_REQUEST['tanggal_pembayaran'],
          "biaya_pembayaran" => $_REQUEST['biaya_pembayaran'],
          "expired" => $expired
          );
        $up2 = $this->mymodel->update('pasien',$data_update2,'pasien_id',$_REQUEST['pasien_id']);
      }
      $this->session->set_flashdata('success_msg','Data Berhasil Diubah');
    }else{
      $this->session->set_flashdata('success_msg','Gagal Update Data');
    }
    //echo $this->db->last_query();
    redirect('admin/owner/transaksi_pasien/');
  }
  public function deletedata()
  {
    $data_transaksi_pasien = array(
      "is_deleted" => "1"
      );
    $del = $this->mymodel->update('trans_pasien',$data_transaksi_pasien,'trans_pasien_id',$_REQUEST['data_id']);
    if ($del) {
      $this->session->set_flashdata('success_msg','Berhasil Hapus Data');
    }else{
      $this->session->set_flashdata('msg','Gagal Hapus Data! (Data Tidak Ditemukan)');
    }
    //echo $this->db->last_query();
    redirect('admin/owner/transaksi_pasien/');
  }
  public function getdataedit()
  {
    $id = $_REQUEST['id'];
    $data["data"] = $this->mymodel->getbywhere('trans_pasien','trans_pasien_id',$id,"row");
    $this->load->view('admin/modal_edit/transaksi_pasien',$data);
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
