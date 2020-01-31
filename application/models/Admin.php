<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Model {
  public function __construct()
  {
    parent::__construct();
  }
  public function getall()
  {
    return $this->db->get('admin')->result();
  }
  public function getalllimit($start,$limit)
  {
    return $this->db->get('admin',$limit,$start)->result();
  }
  public function getbyid($id)
  {
    return $this->db->where('id_admin',$id)->get('admin')->row();
  }
  public function checkusername($u){
    return $this->db->where('username',$u)->get('admin')->row();
  }
  public function do_login($u,$p){
    return $this->db->where('username',$u)->where('password',md5($p))
    ->get('admin')->row();
  }
  public function insert($data)
  {
    $this->db->insert('admin',$data);
    return $this->db->affected_rows();
  }
  public function update($data,$id)
  {

    $this->db->where('id_admin',$id)->update('admin',$data);
    return $this->db->affected_rows();
  }
  public function delete($id)
  {
    $this->db->where('id_admin',$id)->delete('admin');
    return $this->db->affected_rows();
  }
}
?>
