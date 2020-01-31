<?php

date_default_timezone_set('Asia/Jakarta');
defined('BASEPATH') OR exit('No direct script access allowed');


class Dashboard extends CI_Controller {
	public function index()
  {
    $this->is_login();

		$user = array();
    $htrans = array();
    $kalender = array();
    $status = array();
		$date = date('Y-m-d');
		$data = array();
		for($i =0;$i<12;$i++){
      $kali = 30*$i;
      $kali2 = $kali+30;
      $d1 = date('Y-m-d', strtotime( $date . ' -'.$kali.' day' ));
      //echo "<script>console.log(".$d1.");</script>";
      $d2 = date('y-m-d', strtotime( $date . ' -'.$i.' month' ));
      /*$htrans[$i] = $this->mymodel->withquery("select count(DISTINCT htrans_id) as jumlah from htrans
      where year(created_at) = '".$y."' and month(created_at) = '".$m."'
      and day(created_at) = '".$d."' and is_deleted='0'",'row')->jumlah;
      */

    //echo $this->db->last_query();
    }
    
    /*$data['antrian'] = $this->mymodel->withquery("select count(*) as jumlah from antrian
      where status_antrian='0'","row")->jumlah;
    */

		$data['title_page'] = "Dashboard Administrator";
    $data['nama_lengkap'] = $this->mymodel->getbywhere('admin','username',$this->session->userdata('admin'),"row")->nama_lengkap;
		$data['total_dokter'] = count($this->mymodel->getbywhere('dokter','is_deleted',"0",'result'));
    $data['total_pasien'] = count($this->mymodel->getbywhere('pasien','is_deleted',"0",'result'));
    $data['total_klinik'] = count($this->mymodel->getbywhere('klinik','is_deleted',"0",'result'));
    $data['total_poli'] = count($this->mymodel->getbywhere('category_poli','is_deleted',"0",'result'));
    //Check previleges
    $this->load->view('admin/header',$data);
		$this->load->view('admin/dashboard');
		$this->load->view('admin/footer');
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
