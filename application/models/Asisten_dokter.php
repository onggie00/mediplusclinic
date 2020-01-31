<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Asisten_dokter extends CI_Model {
  public function __construct()
  {
    parent::__construct();
  }
  public function getall()
  {
    return $this->db->get('asisten_dokter')->result();
  }
  public function getalllimit($start,$limit)
  {
    return $this->db->get('asisten_dokter',$limit,$start)->result();
  }
  public function getbyid($id)
  {
    return $this->db->where('id_asisten_dokter',$id)->get('asisten_dokter')->row();
  }
  public function checkusername($u){
    return $this->db->where('username',$u)->get('asisten_dokter')->row();
  }
  public function do_login($u,$p){
    return $this->db->where('username',$u)->where('password',md5($p))
    ->where('is_deleted',"0")->get('asisten_dokter')->row();
  }
  public function insert($data)
  {
    $this->db->insert('asisten_dokter',$data);
    return $this->db->affected_rows();
  }
  public function update($data,$id)
  {

    $this->db->where('id_asisten_dokter',$id)->update('asisten_dokter',$data);
    return $this->db->affected_rows();
  }
  public function delete($id)
  {
    $this->db->where('id_asisten_dokter',$id)->delete('asisten_dokter');
    return $this->db->affected_rows();
  }
}
?>
