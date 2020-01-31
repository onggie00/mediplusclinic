<?php 
date_default_timezone_set('Asia/Jakarta');

defined('BASEPATH') OR exit('No direct script access allowed');

require 'phpmailer/PHPMailerAutoload.php';
class Notifikasi_membership extends CI_Controller{
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
	public function cek_membership(){
		//echo "tes";
		$get_klinik = $this->mymodel->getbywhere('klinik',"is_deleted=","0",'result');
		//$get_pasien = $this->mymodel->getbywhere('pasien',"is_deleted=","0",'result');

		$judul = "Notifikasi Mediplus";
	//Membership Dokter
		foreach ($get_klinik as $key => $value) {
			if ($value->tanggal_expired != null) {
			$tgl_expired = date_create(date("Y-m-d",strtotime($value->tanggal_expired)));
			$today = date_create(date("Y-m-d"));
			$selisih = date_diff($today,$tgl_expired);
			$selisih = $selisih->format('%r%a');

			$convert = date("d m Y N",strtotime($value->tanggal_expired));
            $convert = explode(" ", $convert);
            $tgl = $convert[0];
            $bln = $this->get_bulan($convert[1]);
            $thn = $convert[2];
            $hari = $this->get_hari($convert[3]);
            $tgl_exp = $hari.", ".$tgl." ".$bln." ".$thn;
			if ($selisih <= 7 && $selisih > 0) {

				$deskripsi = "Masa Berlaku aplikasi Mediplus Tersisa <br/><b>".$selisih." hari lagi <br/>($tgl_exp)<br/></b> Silahkan melakukan perpanjangan.<br/> Terima Kasih.";
				$email = $value->email;
				$nama = $value->nama_klinik;
				$this->send_email($judul,$deskripsi,$nama,$email);
				//echo $deskripsi;
			}else if($selisih == 0){
				$deskripsi = "Masa Berlaku aplikasi Mediplus Telah Habis <b><br/>($tgl_exp)<br/></b> Silahkan Kontak Administrator untuk keterangan lebih lanjut.<br/> Terima Kasih.";
				$email = $value->email;
				$nama = $value->nama_klinik;
				$this->send_email($judul,$deskripsi,$nama,$email);
			}
			/*$cetak = $selisih->format('%r%a days');
			echo $value->nama_dokter." : ".$cetak."<br/>";*/
			}
		}
	//Membership Pasien
	/*	foreach ($get_pasien as $key => $value) {
			if ($value->expired != null) {
			$tgl_expired = date_create(date("Y-m-d",strtotime($value->expired)));
			$today = date_create(date("Y-m-d"));
			$selisih = date_diff($today,$tgl_expired);
			$selisih = $selisih->format('%r%a');
			$convert = date("d m Y N",strtotime($value->expired));
            $convert = explode(" ", $convert);
            $tgl = $convert[0];
            $bln = $this->get_bulan($convert[1]);
            $thn = $convert[2];
            $hari = $this->get_hari($convert[3]);
            $tgl_exp = $hari.", ".$tgl." ".$bln." ".$thn;
			if ($selisih <= 7 && $selisih > 0) {

				$deskripsi = "Masa Berlaku aplikasi Mediplus Tersisa <br/><b>".$selisih." hari lagi <br/>($tgl_exp)<br/></b> Silahkan melakukan perpanjangan.<br/> Terima Kasih.<br/>";
				$email = $value->email;
				$nama = $value->nama_lengkap;
				$this->send_email($judul,$deskripsi,$nama,$email);
			}else if($selisih == 0){
				$deskripsi = "Masa Berlaku aplikasi Mediplus Telah Habis <b><br/>($tgl_exp)<br/></b> Silahkan Kontak Administrator untuk keterangan lebih lanjut.<br/> Terima Kasih.<br/>";
				$email = $value->email;
				$nama = $value->nama_lengkap;
				$this->send_email($judul,$deskripsi,$nama,$email);
			}
		  }
		}
		*/
	}

	public function send_email($judul,$deskripsi,$nama,$email)
    {
      $to = urldecode($email);
      $mail = new PHPMailer;
      // Konfigurasi SMTP
      $mail->isSMTP();
      $mail->SMTPDebug =0;
      // $mail->Host = 'mail.namagz.com';
      $mail->Host = 'smtp.gmail.com';
      $mail->SMTPOptions = array(
         'ssl' => array(
           'verify_peer' => false,
           'verify_peer_name' => false,
           'allow_self_signed' => true
          )
      );
      $mail->SMTPAuth = true;
      // $mail->Username = 'syauqi@namagz.com';
      // $mail->Password = 'koroko11';
      $mail->Username = 'devs.mediplus@gmail.com';
      $mail->Password = 'bayuganteng2312';
      $mail->SMTPSecure = 'ssl';
      $mail->Port = 465;

      $mail->addReplyTo('no-reply@mediplus.com', 'Mediplus');
      $mail->setFrom('no-reply@mediplus.com', 'Mediplus');

      // Menambahkan penerima
      $mail->addAddress($to);

      // Menambahkan beberapa penerima


      // Subjek email
      $mail->Subject = $judul;

      // Mengatur format email ke HTML
      $mail->isHTML(true);

      // Konten/isi
       $data_['msg'] = $deskripsi;
       $data_['title'] = $judul;
       $data_['to'] = $nama;
       $mailContent = $this->load->view('broadcast_pesan',$data_,true);
      $mail->Body = $mailContent;
      // Menambahakn lampiran

      // Kirim email
      if(!$mail->send()){
          //echo 'Pesan tidak dapat dikirim.';
          //echo 'Mailer Error: ' . $mail->ErrorInfo;
          $this->session->set_flashdata('msg','Mailer Error: ' . $mail->ErrorInfo);
      }else{
          //echo 'Pesan telah terkirim ';
        $this->session->set_flashdata('msg','Pesan Terkirim '.$email);
      }
     echo $this->session->flashdata('msg')."<br/>".$deskripsi;
    //redirect('admin/owner/broadcast_pasien/');
    }

		public function notif_user()
		{
			$date = date("Y-m-d H:i:s");
			$date_1 = date('Y-m-d H:i:s', strtotime('-1 hour'));

				// echo "Pemberitahuan Berita Terbaru Ada $jum Berita Terbaru ".$value->id_fcm;
				// echo $this->db->last_query();
				//echo $this->send_user("Notifikasi Pengguna Aktif RSB","Terima Kasih Telah Menginstall Aplikasi RSB.",'dNDWQW_Ux40:APA91bHv3StL-_fNQcen4m5GXL91cztHGLDIN0QxWlv6W-qyg-byaMGg0wbahSyQbzeM0nKDw5XX0KPxEI9mzOZH3mmikdc-lB35nNN6IMCEcg_CHEnxCkrYO75vJaG4_THjWh2GdSdx','3348')."<br>";
				//echo "<hr>";
				echo $this->send_user("Notifikasi Pengguna Aktif RSB","Terima Kasih Telah Menginstall Aplikasi RSB.",'dNDWQW_Ux40:APA91bHv3StL-_fNQcen4m5GXL91cztHGLDIN0QxWlv6W-qyg-byaMGg0wbahSyQbzeM0nKDw5XX0KPxEI9mzOZH3mmikdc-lB35nNN6IMCEcg_CHEnxCkrYO75vJaG4_THjWh2GdSdx','3348','Onggie','Danny','260000')."<br>";
				echo "<hr>";
			foreach ($this->mymodel->getall('user') as $key => $value) {
				//$nomer = $this->mymodel->getbywhere('barcode','code',$value->barcode);
				if ($value->id_fcm!='') {
					//echo $this->send_user("Notifikasi Pengguna Aktif RSB","Terima Kasih Telah Menginstall Aplikasi RSB.",$value->id_fcm,$value->id_user)."<br>";


				}

			}
		}
		public function send_user($title,$desc,$id_fcm,$id_user,$nama_depan,$nama_belakang,$nomer)
		{
			$Msg = array(
				'body' => $desc,
				'title' => $title
			);
			$fcmFields = array(
				'to' => $id_fcm,
				'notification' => $Msg
				// 'data'=>$data
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
			$cek_penampung = $this->mymodel->getbywhere('penampung','id_user',$id_user,'row');
			if ($berhasil=='1') {
				$data = array(
					'id_user' => $id_user,
					'nama_depan' => $nama_depan,
					'nama_belakang' => $nama_belakang,
					'nomer_kode' => $nomer,
					'berhasil' => 1,
					'belum' => 0
					);
					if ($cek_penampung->id_user==$id_user) {
						$this->mymodel->update('penampung',$data,'id_user',$id_user);
						echo $id_user.' Update<br>';
					}
					else{
						$this->mymodel->insert('penampung',$data);
						echo $id_user.' Insert<br>';
					}

			}
			else if($berhasil=='0'){
				$data = array(
					'id_user' => $id_user,
					'nama_depan' => $nama_depan,
					'nama_belakang' => $nama_belakang,
					'nomer_kode' => $nomer,
					'berhasil' => 0,
					'belum' => 1
					);

					if ($cek_penampung->id_user==$id_user) {
						$this->mymodel->update('penampung',$data,'id_user',$id_user);
						echo $id_user.' Update<br>';
					}
					else{
						$this->mymodel->insert('penampung',$data);
						echo $id_user.' Insert<br>';
					}

			}
			echo $result . "\n\n";
		}
}

 ?>