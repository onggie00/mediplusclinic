<?php

date_default_timezone_set('Asia/Jakarta');
defined('BASEPATH') OR exit('No direct script access allowed');
require_once('sms/api_sms_class_masking_json.php'); // class
ob_start();

class Login extends CI_Controller {

	public function index()
	{
		 $user = $this->session->userdata('admin');
     $check = $this->session->userdata('kode_verifikasi');
	    if ($user!="" && $check!="") {
	      redirect('admin/owner/dashboard/');
	    }
  			$data['err_msg'] = 	$this->session->flashdata('msg');
  	 	  $this->load->view('admin/auth_login',$data);
	}
	public function do_login()
  {
    $date = date('Y-m-d H:i:s');
    $cek = $this->admin->checkusername($_REQUEST['username']);
    if ($cek!="") {
      $login = $this->admin->do_login($_REQUEST['username'],$_REQUEST['password']);
      if ($login!="") {
        $this->session->set_userdata('admin',$_REQUEST['username']);
        $this->generate_code($_REQUEST['username']);
      }
      else {
        echo "err2";
        $this->session->set_flashdata('msg','Password Salah');
        redirect('admin/login');
      }
    }else {
      echo "err1";
      $this->session->set_flashdata('msg','Username Tidak Ditemukan');
      redirect('admin/login');
    }
		
  }
  public function generate_code($username){
    $length = 6;    
    $code =  substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'),1,$length);
    $data = array(
      "kode_verifikasi" => $code
      );
    $this->mymodel->update('admin',$data,'username',$username);
    //$this->send_sms("085853224803",$code);
    $this->send_sms("081234512432",$code);
    redirect('admin/login/verifikasi');
    //$this->load->view('verifikasi_admin');
  }
  public function check_code(){
    if (isset($_REQUEST['btn_login'])) {
     $kode = strtoupper($_REQUEST['code']);
     $cek = $this->mymodel->getbywhere('admin',"username='".$this->session->userdata('admin')."' and kode_verifikasi=",$kode,'row');
      if (!empty($cek)) {
        $this->session->set_userdata('kode_verifikasi',$cek->kode_verifikasi);
      }else{
        $this->session->set_flashdata('msg', 'Kode Verifikasi Salah');
      }
      //$this->load->view('admin/auth_login');
      redirect('admin/login'); 
    }
  }
  public function verifikasi(){
    $this->load->view('verifikasi_admin');
  }
  public function logout($value='')
  {
    $this->session->unset_userdata('admin');
    $this->session->unset_userdata('kode_verifikasi');
    redirect('admin/auth_login');
  }
  public function send_sms($no,$msg)
    {
      $apikey      = '8d78483437f63553058f9c5174e79267'; // api key
      $ipserver    = 'http://128.199.232.241'; // url server sms
      $urlendpoint = 'http://sms241.xyz/sms/api_sms_reguler_send_json.php'; // url endpoint api 
      $callbackurl = 'http://your_url_for_get_auto_update_status_sms'; // url callback get status sms

      // create header json
      $senddata = array(
        'apikey' => $apikey,
        'callbackurl' => $callbackurl,
        'datapacket'=>array()
      );

      // create detail data json
      // data 1
      $date=new DateTime();
      //$jam = $date->format('Y-m-d H:i:s');
      //$jam = date('Y-m-d H:i:s',strtotime( $jam ) + 10);
      $msg = str_replace("-"," ",$msg);
      $number1= $no;
      $message1="Pin Masuk Admin Mediplus : ".$msg." (Pin akan di reset setiap kali login ke admin panel Mediplus)";
      //$message1="Kode Verifikasi Admin Mediplus : ".$msg;
      $sendingdatetime1 = "";
      array_push($senddata['datapacket'],array(
        'number' => trim($number1),
        'message' => urlencode(stripslashes(utf8_encode($message1))),
        'sendingdatetime' => $sendingdatetime1
      ));
/*
// send sms 
$dt=json_encode($senddata);
$curlHandle = curl_init($urlendpoint);
curl_setopt($curlHandle, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($curlHandle, CURLOPT_POSTFIELDS, $dt);
curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curlHandle, CURLOPT_HTTPHEADER, array(
  'Content-Type: application/json',
  'Content-Length: ' . strlen($dt))
);
curl_setopt($curlHandle, CURLOPT_TIMEOUT, 5);
curl_setopt($curlHandle, CURLOPT_CONNECTTIMEOUT, 5);
$responjson = curl_exec($curlHandle);
curl_close($curlHandle);
header('Content-Type: application/json');
echo $responjson;
$json = json_decode($responjson, true);
      $ms= "";
      if (strtolower($json['sending_respon'][0]['globalstatustext'])=='success') {
       return 'Kode SMS Admin Mediplus telah dikirim ke nomer '.$no;
     }else {
       return 'Sms gagal terkirim';
     }
*/
      // class sms

      $sms = new sms_class_masking_json();
      $sms->setIp($ipserver);
      $sms->setData($senddata);
      $responjson = $sms->send();

      header('Content-Type: application/json');
      $json = json_decode($responjson, true);
      echo $responjson;
      $ms= "";
      if (strtolower($json['sending_respon'][0]['globalstatustext'])=='success') {
       return 'SMS dari Mediplus telah dikirim ke nomer '.$no;
     }else {
       return 'Sms gagal terkirim';
     }

  }
}
?>
