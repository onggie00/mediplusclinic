<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
Class Transaksi_pasien_datatable extends CI_Model
{
      var $table = "trans_pasien";
      var $select_column = array("*");
      var $order_column = array('tanggal_pembayaran','expired');
      function make_query($term=''){ //term is value of $_REQUEST['search']['value']
          $column = array('tp.*','p.nama_lengkap');
          $this->db->select('tp.*','p.nama_lengkap');
          $this->db->from('trans_pasien as tp');
          $this->db->join('pasien as p', 'p.pasien_id = tp.pasien_id','left');
          $this->db->like('p.nama_lengkap', $term);
          $this->db->or_like('p.username', $term);
          $this->db->or_like('p.phone', $term);
          $this->db->or_like('tp.tanggal_pembayaran', $term);
          $this->db->or_like('tp.expired', $term);
          if(isset($_REQUEST['order'])) // here order processing
          {
             $this->db->order_by($column[$_REQUEST['order']['0']['column']], $_REQUEST['order']['0']['dir']);
          } 
          else if(isset($this->order))
          {
             $order = $this->order;
             $this->db->order_by(key($order), $order[key($order)]);
          }else{
             $this->db->order_by("trans_pasien_id", "DESC");
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
