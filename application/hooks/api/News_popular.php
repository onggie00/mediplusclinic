<?php
date_default_timezone_set('Asia/Jakarta');
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

use Restserver\Libraries\REST_Controller;
class News_popular extends REST_Controller {

  function __construct($config = 'rest') {
      parent::__construct($config);
  }
  function preg_trim($subject) {
  $regex = "/\s*(\.*)\s*/s";
  if (preg_match ($regex, $subject, $matches)) {
      $subject = $matches[1];
  }
  return $subject;
}
  // show data mahasiswa
  function index_get() {
    $token = "";
    $headers=array();
    foreach (getallheaders() as $name => $value) {
        $headers[$name] = $value;
    }
    if(isset($headers['token']))
      $token =  $headers['token'];

    $page = $this->get('page');
    $total = $this->get('total');
    $start = ($page - 1) * $total;
    $result= 'result';
    $data = $this->mymodel->withquery("SELECT DISTINCT m.news_id as news_id,
      (SELECT count(fav.news_id) from news_view fav where fav.news_id=m.news_id ) as jumlah_favorit
      from news as m where m.news_id in (SELECT news_id from news_view)
      or m.news_id not in (SELECT news_id from news_view) ORDER BY jumlah_favorit desc, m.news_id desc limit
      $start,$total"  ,$result);
    $dt=array();
      foreach ($data as $key => $value) {
         $news = $this->mymodel->getbywhere('news','news_id',$value->news_id,'row');
         $news->view_count = count($this->mymodel->getbywhere('news_view','news_id',$value->news_id));
         $news->view_count = "$news->view_count";
         $news->img_file = base_url('assets/img/news/').$news->img_file;
         $news->tumbnail_file = base_url('assets/img/news_tumbnail/').$news->tumbnail_file;

                       $date=date_create($news->created_at);
                     $news->created_at = converttgl(date_format($date,"d F Y"));
         $news->category_name =  $this->mymodel->getbywhere('news_category','news_category_id',$news->news_category_id,'row')->category_name;
         $dt[] =$news;
      }

      if (!empty($dt))
      {
          $response =  array('status' => 1 , 'message' => 'Data ditemukan', 'data'=> $dt );
      }
      else
      {
        $response =  array('status' => 0 , 'message' => 'Data tidak ditemukan', 'data'=> $dt );
      }
      $this->set_response($response, REST_Controller::HTTP_OK);
  }
}
