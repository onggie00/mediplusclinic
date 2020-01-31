<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
Class Dokter_datatable extends CI_Model
{
      var $table = "dokter";
      var $select_column = array("*");
      var $order_column = array( "nama_dokter","phone","email","username","alamat");
      function make_query($term=''){ //term is value of $_REQUEST['search']['value']
          $column = array('d.*','k.nama_klinik','cp.nama_poli');
          $this->db->select('d.*','k.nama_klinik','cp.nama_poli');
          $this->db->from('dokter as d');
          $this->db->join('klinik as k', 'd.klinik_id = k.klinik_id','left');
          $this->db->join('category_poli as cp', 'd.category_poli_id = cp.category_poli_id','left');
          $this->db->like('d.nama_dokter', $term);
          $this->db->or_like('d.nama_dokter', $term);
          $this->db->or_like('k.nama_klinik', $term);
          $this->db->or_like('cp.nama_poli', $term);
          $this->db->or_like('d.ruangan', $term);
          $this->db->or_like('d.email', $term);
          $this->db->or_like('d.phone', $term);
          $this->db->or_like('d.nomor_sip', $term);
          $this->db->or_like('d.username', $term);
          if(isset($_REQUEST['order'])) // here order processing
          {
             $this->db->order_by($column[$_REQUEST['order']['0']['column']], $_REQUEST['order']['0']['dir']);
          } 
          else if(isset($this->order))
          {
             $order = $this->order;
             $this->db->order_by(key($order), $order[key($order)]);
          }else{
             $this->db->order_by("dokter_id", "DESC");
          }
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
