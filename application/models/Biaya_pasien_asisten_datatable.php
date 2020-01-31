<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
Class Biaya_pasien_asisten_datatable extends CI_Model
{
      var $table = "expired_payment";
      var $select_column = array("*");
      var $order_column = array('biaya');
      function make_query($term=''){ //term is value of $_REQUEST['search']['value']
          $column = array('e.*','p.nama_lengkap','d.nama_dokter');
          $this->db->select('e.*','p.nama_lengkap','d_nama_dokter');
          $this->db->from('expired_payment as e');
          $this->db->join('dokter as d', 'd.dokter_id = e.dokter_id','left');
          $this->db->join('pasien as p', 'e.pasien_id = p.pasien_id','left');
          $this->db->like('d.nama_dokter', $term);
          $this->db->or_like('p.nama_lengkap', $term);
          $this->db->or_like('e.biaya', $term);
          $this->db->or_like('e.date_payment', $term);
          $this->db->or_like('e.date_expired', $term);
          if(isset($_REQUEST['order'])) // here order processing
          {
             $this->db->order_by($column[$_REQUEST['order']['0']['column']], $_REQUEST['order']['0']['dir']);
          } 
          else if(isset($this->order))
          {
             $order = $this->order;
             $this->db->order_by(key($order), $order[key($order)]);
          }else{
             $this->db->order_by("e.expired_payment_id", "DESC");
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
