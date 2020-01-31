<?php 
date_default_timezone_set('Asia/Jakarta');

defined('BASEPATH') OR exit('No direct script access allowed');

class Reset_antrian extends CI_Controller{

	public function resetnomor(){
		$this->mymodel->delete('antrian',"status_antrian='0' or status_antrian='2' or status_antrian=",1,'result');
		echo $this->db->last_query();
	}
}
?>