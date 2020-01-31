<?php
date_default_timezone_set('Asia/Jakarta');
defined('BASEPATH') OR exit('No direct script access allowed');

class Biaya_klinik extends CI_Controller {

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
    $data['title_page'] = "Transaksi Klinik";
    $data['nama_lengkap'] = $this->mymodel->getbywhere('admin','username',$this->session->userdata('admin'),"row")->nama_lengkap;
    $data['err_msg'] =  $this->session->flashdata('msg');
    $data['success_msg'] =  $this->session->flashdata('success_msg');
    $this->load->view('admin/header', $data);
    $this->load->view('admin/data_biaya_klinik');
    $this->load->view('admin/footer');
  }
  public function alldata()
  {
    $this->load->model(array('Transaksi_klinik_datatable'));
    $fetch_data = $this->Transaksi_klinik_datatable->make_datatables();
           $data = array();
           $nomor=1;
           foreach($fetch_data as $value)
           {
            if ($value->is_deleted == "0") {
              $klinik = $this->mymodel->getbywhere('klinik','klinik_id',$value->klinik_id,'row');
                $sub_array = array();
                $sub_array[] = $nomor;
                $sub_array[] = $klinik->nama_klinik;
                if ($value->status_pembayaran == "1") {
                  $sub_array[] = "LUNAS";
                  $convert = date("d m Y N",strtotime($klinik->tanggal_pembayaran));
                  $convert = explode(" ", $convert);
                  $tgl = $convert[0];
                  $bln = $this->get_bulan($convert[1]);
                  $thn = $convert[2];
                  $hari = $this->get_hari($convert[3]);
                  $tgl_bayar = $hari.", ".$tgl." ".$bln." ".$thn;
                  $convert = date("d m Y N",strtotime($klinik->tanggal_expired));
                  $convert = explode(" ", $convert);
                  $tgl = $convert[0];
                  $bln = $this->get_bulan($convert[1]);
                  $thn = $convert[2];
                  $hari = $this->get_hari($convert[3]);
                  $tgl_tanggal_expired = $hari.", ".$tgl." ".$bln." ".$thn;
                  $sub_array[] = $tgl_bayar;
                  $sub_array[] = "Rp. ".number_format($value->biaya,0,"",".");
                  $sub_array[] = $tgl_tanggal_expired;
                }else{
                  $sub_array[] = "MENUNGGU PEMBAYARAN";
                  $sub_array[] = "Belum Dibayar";
                  $sub_array[] = "Rp. ".number_format($value->biaya,0,"",".");
                  $sub_array[] = "Belum tersedia";
                }

                 $sub_array[] ='
                <button type="button" name="update" id="'.$value->trans_klinik_id.'" class="btn btn-sm btn-primary update">
                <i class="mdi mdi-pencil-circle ml-1"></i> Ubah</button>
                <br><br>
                <button type="button" name="delete" id="'.$value->trans_klinik_id.'" class="btn btn-sm btn-danger delete">
                <i class="mdi mdi-delete-circle ml-1"></i> Hapus</button>';
                $data[] = $sub_array;
                $nomor++;
            }
           }
           $output = array(
                "draw"                    =>    intval($_POST["draw"]) ,
                "recordsTotal"          =>      $this->Transaksi_klinik_datatable->get_all_data(),
                "recordsFiltered"     =>     $this->Transaksi_klinik_datatable->get_filtered_data(),
                "data"                    =>     $data
           );
           echo json_encode($output);
  }
  public function insertdata()
  {
    $data = array();
    if ($_REQUEST['status_pembayaran'] == "1") {
      $paket = 0;
      $nama_paket = "";
      if ($_REQUEST['paket_aktif'] == "1") {
        $nama_paket = "1 Bulan";
        $paket = "+1 month";
      }else if($_REQUEST['paket_aktif'] == "2"){
        $nama_paket = "3 Bulan";
        $paket = "+3 month";
      }else if($_REQUEST['paket_aktif'] == "3"){
        $nama_paket = "6 Bulan";
        $paket = "+6 month";
      }else if($_REQUEST['paket_aktif'] == "4"){
        $nama_paket = "1 Tahun";
        $paket = "+1 year";
      }
      $data = array(
        "klinik_id" => $_REQUEST['klinik_id'],
        "status_pembayaran" => $_REQUEST['status_pembayaran'],
        "tanggal_pembayaran" => $_REQUEST['tanggal_pembayaran'],
        "biaya" => $_REQUEST['biaya'],
        "tanggal_expired" => date("Y-m-d H:i:s",strtotime($_REQUEST['tanggal_pembayaran'].$paket)),
        "paket" => $nama_paket,
        "created_at" => date('Y-m-d H:i:s')
        );
      $data2 = array(
        "is_aktif" => 1
        );
      $up = $this->mymodel->update('dokter',$data2,"klinik_id",$_REQUEST['klinik_id']);
    }else{
      $data = array(
        "klinik_id" => $_REQUEST['klinik_id'],
        "status_pembayaran" => $_REQUEST['status_pembayaran'],
        "tanggal_pembayaran" => null,
        "biaya" => $_REQUEST['biaya'],
        "tanggal_expired" => null,
        "created_at" => date('Y-m-d H:i:s')
        );
    }
     if(!empty($data)){
        $in = $this->mymodel->insert('trans_klinik',$data);
        if ($in) {
          $data_update = array();
          $nama_paket = "";
          $paket = 0;
            if ($_REQUEST['paket_aktif'] == "1") {
              $nama_paket = "1 Bulan";
              $paket = "+1 month";
            }else if($_REQUEST['paket_aktif'] == "2"){
              $nama_paket = "3 Bulan";
              $paket = "+3 month";
            }else if($_REQUEST['paket_aktif'] == "3"){
              $nama_paket = "6 Bulan";
              $paket = "+6 month";
            }else if($_REQUEST['paket_aktif'] == "4"){
              $nama_paket = "1 Tahun";
              $paket = "+1 year";
            }

          if ($_REQUEST['status_pembayaran'] == "1") {
            $data_update = array(
            "status_pembayaran" => $_REQUEST['status_pembayaran'],
            "tanggal_pembayaran" => $_REQUEST['tanggal_pembayaran'],
            "biaya" => $_REQUEST['biaya'],
            "tanggal_expired" => date("Y-m-d H:i:s",strtotime($_REQUEST['tanggal_pembayaran'].$paket)),
            "paket" => $nama_paket,
            );
          }else{
            $data_update = array(
            "status_pembayaran" => $_REQUEST['status_pembayaran'],
            "tanggal_pembayaran" => null,
            "biaya" => $_REQUEST['biaya'],
            "tanggal_expired" => null,
            "paket" => $nama_paket
            );
          }
        $up = $this->mymodel->update('klinik',$data_update,'klinik_id',$_REQUEST['klinik_id']);
        $this->session->set_flashdata('success_msg','Data Berhasil Ditambahkan');
        }
      }else {
        $this->session->set_flashdata('msg',"Gagal Insert Data");
      }
      redirect('admin/owner/rumah_sakit/');
  }

  public function updatedata()
  {
    $data_update = array(
        "klinik_id" => $_REQUEST['klinik_id'],
        "status_pembayaran" => $_REQUEST['status_pembayaran'],
        "tanggal_pembayaran" => $_REQUEST['tanggal_pembayaran'],
        "biaya" => $_REQUEST['biaya'],
        "tanggal_expired" => date("Y-m-d H:i:s",strtotime($_REQUEST['tanggal_pembayaran']."+1 year"))
        );
    if(!empty($data_update)){
      $up = $this->mymodel->update('trans_klinik',$data_update,'trans_klinik_id',$_REQUEST['data_id']);
      if ($up) {
        $tanggal_expired = null;
        if ($_REQUEST['status_pembayaran'] == "1") {
        $tanggal_expired = date("Y-m-d H:i:s",strtotime($_REQUEST['tanggal_pembayaran']."+1 year"));
        }
        $data_update2 = array(
          "status_pembayaran" => $_REQUEST['status_pembayaran'],
          "tanggal_pembayaran" => $_REQUEST['tanggal_pembayaran'],
          "biaya" => $_REQUEST['biaya'],
          "tanggal_expired" => $tanggal_expired
          );
        $up2 = $this->mymodel->update('klinik',$data_update2,'klinik_id',$_REQUEST['klinik_id']);
      }
      $this->session->set_flashdata('success_msg','Data Berhasil Diubah');
    }else{
      $this->session->set_flashdata('success_msg','Gagal Update Data');
    }
    //echo $this->db->last_query();
    redirect('admin/owner/rumah_sakit/');
  }
  public function deletedata()
  {
    $data_biaya_klinik = array(
      "is_deleted" => "1"
      );
    $del = $this->mymodel->update('trans_klinik',$data_biaya_klinik,'trans_klinik_id',$_REQUEST['data_id']);
    if ($del) {
      $this->session->set_flashdata('success_msg','Berhasil Hapus Data');
    }else{
      $this->session->set_flashdata('msg','Gagal Hapus Data! (Data Tidak Ditemukan)');
    }
    //echo $this->db->last_query();
    redirect('admin/owner/biaya_klinik/');
  }
  public function getdataedit()
  {
    $id = $_REQUEST['id'];
    $data["data"] = $this->mymodel->getbywhere('klinik','klinik_id',$id,"row");
    //$data["data"] = $this->mymodel->getbywhere('trans_klinik','trans_klinik_id',$id,"row");
    $this->load->view('admin/modal_add/transaksi_klinik',$data);
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
