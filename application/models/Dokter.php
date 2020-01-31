<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Dokter extends CI_Model {
  public function __construct()
  {
    parent::__construct();
  }
  public function getall()
  {
    return $this->db->get('dokter')->result();
  }
  public function getalllimit($start,$limit)
  {
    return $this->db->get('dokter',$limit,$start)->result();
  }
  public function getbyid($id)
  {
    return $this->db->where('id_dokter',$id)->get('dokter')->row();
  }
  public function checkusername($u){
    return $this->db->where('username',$u)->get('dokter')->row();
  }
  public function do_login($u,$p){
    return $this->db->where('username',$u)->where('password',md5($p))
    ->where('is_deleted',"0")->get('dokter')->row();
  }
  public function insert($data)
  {
    $this->db->insert('dokter',$data);
    return $this->db->affected_rows();
  }
  public function update($data,$id)
  {

    $this->db->where('id_dokter',$id)->update('dokter',$data);
    return $this->db->affected_rows();
  }
  public function delete($id)
  {
    $this->db->where('id_dokter',$id)->delete('dokter');
    return $this->db->affected_rows();
  }
}
?>
