<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
Class File_rekam_medis_datatable extends CI_Model
{
      var $table = "detail_data_scan";
      var $select_column = array("*");
      var $order_column = array('pasien_id','dokter_id');
      function make_query($term=''){ //term is value of $_REQUEST['search']['value']
          $column = array('ds.*','d.nama_dokter','p.nama_lengkap');
          $this->db->select('ds.*','d.nama_dokter','p.nama_lengkap');
          $this->db->from('detail_data_scan as ds');
          $this->db->join('pasien as p', 'p.pasien_id = ds.pasien_id','left');
          $this->db->join('dokter as d', 'd.dokter_id = ds.dokter_id','left');
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
             $this->db->order_by("detail_data_scan_id", "DESC");
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
