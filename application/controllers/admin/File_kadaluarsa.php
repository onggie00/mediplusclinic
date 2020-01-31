<?php 
date_default_timezone_set('Asia/Jakarta');

defined('BASEPATH') OR exit('No direct script access allowed');

class File_kadaluarsa extends CI_Controller{

	public function deletefile(){
		$get_data_file = $this->mymodel->getbywhere('detail_data_scan','is_deleted','0','result');
		foreach ($get_data_file as $key => $value) {
			$tgl_expired = date_create(date("Y-m-d",strtotime($value->created_at)));
			$today = date_create(date("Y-m-d"));
			$selisih = date_diff($tgl_expired,$today);
			$selisih = $selisih->format('%r%a');
			if ($selisih == 30) {
              	if ($value->img_file != "") {
                	unlink('./assets/image/data_scan/'.$value->img_file);
              		echo "berhasil hapus ".$value->img_file."<br/>";
              	}
              	if ($value->video_file != "") {
              		unlink('./assets/image/data_scan/'.$value->video_file);
              		echo "berhasil hapus ".$value->video_file."<br/>";
              	}
			}
			//echo $value->detail_data_scan_id." - ".$selisih."<br/>";
		}
		echo $this->db->last_query();
	}
}
?>