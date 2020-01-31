<?php
date_default_timezone_set('Asia/Jakarta');
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/vendor/autoload.php';

define( 'API_ACCESS_KEY', 'AAAAFOwiYw0:APA91bFIXvpDlPOBQJilN-999raTtzUE3AMiJog50Q41JU2VZKPhvM2K2PX639ABtBowd5tQF1fzD-O1e7cI9S5IOxQq4W32GHfOFCPnOFtQF-UmNHIHHj_MNKA_ThpLpDFGhSVnMV3v' );
class Chat extends CI_Controller {

	public function __construct() {
        parent::__construct();
  }
	public function index($val = "")
  {
    redirect('admin/dokter/chat/data');
  }
	public function send_notif($title,$desc,$id_fcm,$data)
	{
		$Msg = array(
			'body' => $desc,
			'title' => $title
		);
		
		$fcmFields = array(
			'to' => $id_fcm,
			'notification' => $Msg,
			 'data'=>$data
		);
		$headers = array(
			'Authorization: key=' . API_ACCESS_KEY,
			'Content-Type: application/json'
		);
		$ch = curl_init();
		curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
		curl_setopt( $ch,CURLOPT_POST, true );
		curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
		curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
		curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
		curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fcmFields ) );
		$result = curl_exec($ch );
		curl_close( $ch );

		$cek_respon = explode(',',$result);
		$berhasil = substr($cek_respon[1],strpos($cek_respon[1],':')+1);
		echo $result."\n\n";
	}
	public function data($val = "")
  {
    $this->is_login();
    $get_dokter = $this->mymodel->getbywhere('dokter','dokter_id');
		$msg = $this->session->flashdata('msg');
		$this->session->set_flashdata('msg',$msg);
		$data['title_page'] = "Pesan Dokter";
		$data['foto_profil'] = $this->mymodel->getbywhere('dokter','username',$this->session->userdata('dokter'),"row")->img_file;
		$data['mydata'] =  $this->mymodel->getbywhere('dokter','username',$this->session->userdata('dokter'),"row");
		$chatrr= $this->mymodel->getbywheresort("histori_data_scan","dokter_id",$data['mydata']->dokter_id,"histori_data_scan_id","desc");
		$data["chat_room"] = $chatrr;
	  $data['nama_lengkap'] = $this->mymodel->getbywhere('dokter','username',$this->session->userdata('dokter'),"row")->nama_dokter;
    $data['err_msg'] =  $this->session->flashdata('msg');
    $data['success_msg'] =  $this->session->flashdata('success_msg');
    $this->load->view('admin/header_dokter', $data);
    $this->load->view('admin/data_chat');
    $this->load->view('admin/footer');
  }

	public function reloadchat($value='')
	{
		$this->load->view("admin/ajax/detail_chat");
	}
	public function insertchat($value='')
	{
		$mydata =  $this->mymodel->getbywhere('dokter','username',$this->session->userdata('dokter'),"row");
			$data = array(
			 'chatroom_id' => 0,
			 'pasien_id' => $_REQUEST['pasien_id'],
			 'dokter_id' => $mydata->dokter_id,
			 'chat' => $_REQUEST['pesan'],
			 'customer_is_sender'=>0,
			 'created_at' => date('Y-m-d H:i:s')
		 );
		$this->mymodel->insert('chat',$data);
		$chat= $this->mymodel->getlastwhere("chat","dokter_id",$mydata->dokter_id,"chat_id");

		$token = 'M1vX3FQ2Vsd4WCzsTL5TXWxHeDpDyFMW1QdeiEGa';
		$url= "https://mediplus-15263.firebaseio.com/";
		$token = 'M1vX3FQ2Vsd4WCzsTL5TXWxHeDpDyFMW1QdeiEGa';
		$firebase = new \Firebase\FirebaseLib($url, $token);

		$dateTime = date("YmdHis");
		$test = [
			'chat' => $_REQUEST['pesan'],
		 	'customer_is_sender'=>"0",
		];
		$firebase->set("C".$mydata->dokter_id . '/' . $_REQUEST['pasien_id'] . '/' . $dateTime, $test);
		$this->send_notif("Pesan Dari $mydata->nama_dokter",$_REQUEST['pesan'], $this->mymodel->getbywhere('pasien','pasien_id',$_REQUEST['pasien_id'],'row')->fcm_id, array("id_dokter"=>$mydata->dokter_id) );
		echo $chat->chat_id;
	}
	public function send_chat($value='')
	{
		$mytoken = $_REQUEST['tkn'];
	$url = "https://greenism-be024.firebaseio.com/";

	$token = '9LMbNI2de6gneZTkV5YEDtFICHiBsJ2o9tswgoAu';
		$url= "https://greenism-be024.firebaseio.com/";
	$token = 'LQdBj5wjYGB6C8iLmedXAXIA02nWakCxkxhYK8ww';
	$path = "$mytoken";
	$firebase = new \Firebase\FirebaseLib($url, $token);

	$dateTime = date("YmdHis");
	$test = [
			'mychat' => "",
			'theychat' => $_REQUEST['mychat']

	];
	$firebase->set($path . '/' . $_REQUEST['id'] . '/' . $dateTime, $test);
	$this->send_notif("Pesan Dari Admin",$_REQUEST['mychat'], $this->mymodel->getbywhere('member','token',$path,'row')->fcm_id );
	}
	public function chat_list_side()
	{
		$data['mydata'] =  $this->mymodel->getbywhere('dokter','username',$this->session->userdata('dokter'),"row");
		$id = $data['mydata']->dokter_id;
		$list = $this->mymodel->withquery("SELECT DISTINCT `dokter_id`,`pasien_id` FROM chat where dokter_id = $id ORDER by `chat_id` desc",'result');
		$data["chat_room"] = $list;
		$this->load->view('admin/ajax/chat_list_side',$data);
	}
	public function is_login()
  {
    $islogin = $this->session->userdata('dokter');
    if ($islogin=="") {
      redirect('admin/login_dokter/');
    }
  }
}
?>
