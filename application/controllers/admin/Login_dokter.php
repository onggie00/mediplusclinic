<?php

date_default_timezone_set('Asia/Jakarta');
defined('BASEPATH') OR exit('No direct script access allowed');


class Login_dokter extends CI_Controller {

  public function index()
  {
     $user = $this->session->userdata('dokter');
      if ($user!="") {
        $get_dokter = $this->mymodel->getbywhere('dokter','username',$this->session->userdata('dokter'),'row');
        $cek_klinik = $this->mymodel->getbywhere('klinik','klinik_id',$get_dokter->klinik_id,'row');
        if($cek_klinik->paket == "Selamanya" || date("Y-m-d H:i:s",strtotime($cek_klinik->tanggal_expired)) >= date("Y-m-d H:i:s")){
            redirect('admin/dokter/dashboard/');
        }
        else if(date("Y-m-d H:i:s") > date("Y-m-d H:i:s",strtotime($cek_klinik->tanggal_expired))){
          redirect('admin/dokter/rekam_medis/');
        }
      }
      $data['err_msg'] =  $this->session->flashdata('msg');
    $this->load->view('admin/login_dokter',$data);
  }
  public function do_login()
  {
    $date = date('Y-m-d H:i:s');
    $cek = $this->dokter->checkusername($_REQUEST['username']);
    if ($cek!="") {
      $login = $this->dokter->do_login($_REQUEST['username'],$_REQUEST['password']);
        if ($login!="") {
          $this->session->set_userdata('dokter',$_REQUEST['username']);
        }else {
          echo "err2";
          $this->session->set_flashdata('msg','Password Salah');
        }
    }else {
      echo "err1";
      $this->session->set_flashdata('msg','Username Tidak Ditemukan');
    }
    //echo $this->session->userdata('dokter');
    redirect('admin/login_dokter');
  }
  public function logout($value='')
  {
    $this->session->unset_userdata('dokter');
    redirect('admin/auth_login');
  }
}
?>
