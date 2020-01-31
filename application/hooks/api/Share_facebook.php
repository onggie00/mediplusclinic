<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
/** @noinspection PhpIncludeInspection */
//To Solve File REST_Controller not found
require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

date_default_timezone_set('Asia/Jakarta');
class Share_facebook extends REST_Controller {

    function __construct()
    {
        parent::__construct();
    }

    public function index_post()
    {
      $token = "";
      $headers=array();
      foreach (getallheaders() as $name => $value) {
          $headers[$name] = $value;
      }
      if(isset($headers['token']))
        $token =  $headers['token'];

        $cektoken =  $this->mymodel->getbywhere('relawan','token',$token,'row');
        if (empty($cektoken)) {
            $response =  array('status' => 0 , 'message' => 'Token Tidak Ditemukan' );
        }else{
          $date = date('Y-m-d');
          $news_id = $this->post('news_id');
          $cekShare =  $this->mymodel->getbywhere('share_facebook',"date_share='$date' and relawan_id = $cektoken->relawan_id and news_id =$news_id",null,'row');
          if (!empty($cekShare)) {
            $response =  array('status' => 0 , 'message' => 'Hari Ini Berita ini sudah anda bagikan ke facebook' );
          }else {
          $data = array(
            'relawan_id' => $cektoken->relawan_id,
            'news_id' => $news_id,
              'date_share' => $date,
              'created_at' => date('Y-m-d H:i:s')
            );
            $in = $this->mymodel->insert('share_facebook',$data);
            $data = array(
              'relawan_id' => $cektoken->relawan_id,
              'poin' => 10,
              'keterangan' => "Share Facebook",
              'created_at' => date('Y-m-d H:i:s')
            );
            $in = $this->mymodel->insert('history_poin',$data);

            $data = array('poin' => $cektoken->poin + 10);
            $this->mymodel->update('relawan',$data,'token',$token);

            if (!empty($in))
            {
                $response =  array('status' => 1 , 'message' => 'Berhasil Share' );
            }
            else
            {
              $response =  array('status' => 0 , 'message' => 'Gagal Share' );
            }
          }

        }
        $this->set_response($response, REST_Controller::HTTP_OK);
    }


}
