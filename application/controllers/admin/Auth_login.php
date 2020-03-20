<?php

date_default_timezone_set('Asia/Jakarta');
defined('BASEPATH') OR exit('No direct script access allowed');


class Auth_login extends CI_Controller {

	public function index()
	{
		 $user = $this->session->userdata('admin');
     $asisten = $this->session->userdata('asisten_dokter');
     $dokter = $this->session->userdata('dokter');
     $check = $this->session->userdata('kode_verifikasi');
	    if ($user!="" && $check!="") {
	      redirect('admin/owner/dashboard/');
	    }else if ($asisten!="") {
        redirect('admin/asisten/dashboard/');
      }else if ($dokter!="") {
        redirect('admin/dokter/dashboard');
      }
    $data['err_msg'] = 	$this->session->flashdata('msg');
	 	$this->load->view('admin/auth_login',$data);
	}

  public function cek_login(){
    if (isset($_REQUEST['btn_admin'])) {
      $this->load->view('admin/login_admin');
    }else if (isset($_REQUEST['btn_dokter'])) {
      $this->load->view('admin/login_dokter');
    }else if (isset($_REQUEST['btn_asisten'])) {
      $this->load->view('admin/login_asisten');
    }else{
      $this->load->view('admin/auth_login');
    }
  }
	
}
?>
