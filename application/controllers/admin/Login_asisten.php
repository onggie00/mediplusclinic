<?php

date_default_timezone_set('Asia/Jakarta');
defined('BASEPATH') OR exit('No direct script access allowed');


class Login_asisten extends CI_Controller {

  public function index()
  {
     $user = $this->session->userdata('asisten');
      if ($user!="") {
        redirect('admin/asisten/dashboard/');
      }
      $data['err_msg'] =  $this->session->flashdata('msg');
    $this->load->view('admin/login_asisten',$data);
  }
  public function do_login()
  {
    $date = date('Y-m-d H:i:s');
    $cek = $this->asisten->checkusername($_REQUEST['username']);
    if ($cek!="") {
      $login = $this->asisten->do_login($_REQUEST['username'],$_REQUEST['password']);
      if ($login!="") {
        $this->session->set_userdata('asisten',$_REQUEST['username']);
      }
      else {
        echo "err2";
        $this->session->set_flashdata('msg','Password Salah');
      }
    }else {
      echo "err1";
      $this->session->set_flashdata('msg','Username Tidak Ditemukan');
    }
    //echo $this->session->userdata('asisten');
    redirect('admin/login_asisten');
  }
  public function logout($value='')
  {
    $this->session->unset_userdata('asisten');
    redirect('admin/auth_login');
  }
}
?>
