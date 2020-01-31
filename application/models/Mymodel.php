<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Mymodel extends CI_Model {
  public function __construct()
  {
    parent::__construct();
  }
  public function getall($table)
  {
    return $this->db->get($table)->result();
  }
  public function getallsort($table,$order,$sort)
  {
    return $this->db->order_by($order,$sort)->get($table)->result();
  }
  public function withquery($query1,$result)
  {
    $query = $this->db->query($query1);
    if ($result=='result') {
      return $query->result();
    }else {
        return $query->row();
    }
  }
  public function add_history($msg)
  {
    $date = date('Y-m-d H:i:s');
    $us = $this->session->userdata('admin');
    $cek = $this->admin->checkusername($us);
    $datahistory  = array(
       "id_admin"=> $cek->id_admin,
       "keterangan"=> $msg,
       "date_time" => $date
    );
    $history = $this->mymodel->insert('history_admin',$datahistory);
  }
  public function getlast($table,$order)
  {
    return $this->db->order_by($order,'desc')->get($table)->row();
  }
  public function getfirst($table,$order)
  {
    return $this->db->order_by($order,'asc')->get($table)->row();
  }
  public function getlastwhere($table,$where,$id="",$order)
  {
    if ($id=="") {
      return $this->db->distinct()->where($where)->order_by($order,'desc')->get($table)->row();
    }else {
      return $this->db->distinct()->where($where,$id)->order_by($order,'desc')->get($table)->row();
    }
  }
  public function getalllimit($table,$start,$limit)
  {
    return $this->db->get($table,$limit,$start)->result();
  }
  public function getalllimitdesc($table,$start,$limit,$order)
  {
    return $this->db->order_by($order,'desc')->get($table,$limit,$start)->result();
  }
  public function getalllimitasc($table,$start,$limit,$order)
  {
    return $this->db->order_by($order,'asc')->get($table,$limit,$start)->result();
  }
  public function getbywhere($table,$where,$id="",$result="result")
  {
    if ($result=='result') {
      if ($id=="") {
        return $this->db->distinct()->where($where)->get($table)->result();
      }else {
        return $this->db->distinct()->where($where,$id)->get($table)->result();
      }

    }else {
      return $this->db->distinct()->where($where,$id)->get($table)->row();
    }

  }
  public function getbywherelimit($table,$where,$key="",$start,$limit)
  {
    if ($key=="") {
      return $this->db->where($where)->get($table,$limit,$start)->result();
    }else {
      return $this->db->where($where,$key)->get($table,$limit,$start)->result();
    }

  }
  public function getbywheresort($table,$where,$key="",$order,$sort)
  {
    if ($key=="") {
      return $this->db->where($where)->order_by($order,$sort)->get($table)->result();
    }else {
      return $this->db->where($where,$key)->order_by($order,$sort)->get($table)->result();
    }

  }
  public function getbywherelimitsort($table,$where,$key="",$start,$limit,$order,$sort)
  {
    if ($key=="") {
      return $this->db->where($where)->order_by($order,$sort)->get($table,$limit,$start)->result();
    }else {
      return $this->db->where($where,$key)->order_by($order,$sort)->get($table,$limit,$start)->result();
    }

  }
  public function insert($table,$data)
  {
    $this->db->insert($table,$data);
    return $this->db->affected_rows();
  }
  public function update($table,$data,$where,$id="")
  {
    if ($id=="") {
      $this->db->where($where)->update($table,$data);
    }else {
      $this->db->where($where,$id)->update($table,$data);
    }
    //return $this->db->affected_rows();
    return $this->db->last_query();
  }
  public function delete($table,$where,$id)
  {
    $this->db->where($where,$id)->delete($table);
    return $this->db->affected_rows();
  }
  public function delete2($table,$where,$id,$where2,$id2)
  {
    $this->db->where($where,$id)->where($where2,$id2)->delete($table);
    return $this->db->affected_rows();
  }
}
?>
