<?php

date_default_timezone_set('Asia/Jakarta');
defined('BASEPATH') OR exit('No direct script access allowed');


class Login_dokter extends CI_Controller {

  public function index()
  {
     $user = $this->session->userdata('dokter');
      if ($user!="") {
        redirect('admin/dokter/dashboard/');
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
      if ($this->mymodel->getbywhere('dokter','username',$_REQUEST['username'],'row')->is_aktif == "0" ) {
        echo "err2";
        $this->session->set_flashdata('msg','Status Dokter Nonaktif, Silahkan Hubungi Administrator');
      }else{
        if ($login!="") {
          $this->session->set_userdata('dokter',$_REQUEST['username']);
        }else {
          echo "err2";
          $this->session->set_flashdata('msg','Password Salah');
        }
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
