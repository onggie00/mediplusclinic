<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
/** @noinspection PhpIncludeInspection */
//To Solve File REST_Controller not found
require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

date_default_timezone_set('Asia/Jakarta');
class Score extends REST_Controller {

    function __construct()
    {
        parent::__construct();
    }

    public function index_get()
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
            $response =  array('status' => 0 , 'message' => 'Token Tidak Ditemukan' , 'data'=>"");
        }else{
          $cektoken->jumlah_tugas = count($this->mymodel->getbywhere('history_poin','relawan_id',$cektoken->relawan_id,'result'));
          $cektoken->jumlah_tugas = "$cektoken->jumlah_tugas";
          $rank = $this->mymodel->withquery('SELECT    relawan_id,fullname,@curRank := @curRank + 1 AS rank
          FROM      relawan p, (SELECT @curRank := 0) r
          ORDER BY  poin desc ','result');
          foreach ($rank as $key => $value) {
            if ($value->relawan_id == $cektoken->relawan_id) {
              $cektoken->myrank = $value->rank;

                $cektoken->img_file = base_url('assets/img/relawan/').$cektoken->img_file;
                  $cektoken->kabupaten =  $this->mymodel->getbywhere('kabupaten','kab_id',$cektoken->kab_id,'row')->nama;
                  $cektoken->provinsi =  $this->mymodel->getbywhere('provinsi','prov_id',$cektoken->prov_id,'row')->nama;
            }
          }
          $response =  array('status' => 1 , 'message' => 'Data Ditemukan' , 'data'=>$cektoken);

        }
        $this->set_response($response, REST_Controller::HTTP_OK);
    }


}
