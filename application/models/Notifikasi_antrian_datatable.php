<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
Class Notifikasi_antrian_datatable extends CI_Model
{
      var $table = "antrian";
      var $select_column = array("*");
      var $order_column = array('pasien_id');
      function make_query($term=''){ //term is value of $_REQUEST['search']['value']
          $column = array('a.*','p.nama_lengkap','d.nama_dokter');
          $this->db->select('a.*','p.nama_lengkap');
          $this->db->from('antrian as a');
          $this->db->join('dokter as d', 'd.dokter_id = a.dokter_id','left');
          $this->db->join('pasien as p', 'a.pasien_id = p.pasien_id','left');
          $this->db->like('d.nama_dokter', $term);
          $this->db->or_like('p.nama_lengkap', $term);
          if(isset($_REQUEST['order'])) // here order processing
          {
             $this->db->order_by($column[$_REQUEST['order']['0']['column']], $_REQUEST['order']['0']['dir']);
          } 
          else if(isset($this->order))
          {
             $order = $this->order;
             $this->db->order_by(key($order), $order[key($order)]);
          }else{
             $this->db->order_by("a.nomor_antri", "DESC");
          }
          //echo $this->db->last_query();
      }
      function make_datatables(){
        $term = $_REQUEST['search']['value'];   
        $this->make_query($term);
        if($_REQUEST['length'] != -1)
        $this->db->limit($_REQUEST['length'], $_REQUEST['start']);
        $query = $this->db->get();
        return $query->result();
      }
      function get_filtered_data(){
        $term = $_REQUEST['search']['value']; 
        $this->make_query($term);
        $query = $this->db->get();
        return $query->num_rows(); 
      }
      function get_all_data()
      {
        $this->db->from($this->table);
        return $this->db->count_all_results();
      }
  }

?>
