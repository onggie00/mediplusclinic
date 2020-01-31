<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
Class Transaksi_klinik_datatable extends CI_Model
{
      var $table = "trans_klinik";
      var $select_column = array("*");
      var $order_column = array('tanggal_pembayaran','status_pembayaran','tanggal_expired');
      function make_query($term=''){ //term is value of $_REQUEST['search']['value']
          $column = array('k.nama_klinik','tk.status_pembayaran','tk.tanggal_pembayaran','tk.biaya');
          $this->db->select('tk.*','k.nama_klinik');
          $this->db->from('trans_klinik as tk');
          $this->db->join('klinik as k', 'k.klinik_id = tk.klinik_id','left');
          $this->db->like('k.nama_klinik', $term);
          $this->db->or_like('k.phone', $term);
          $this->db->or_like('k.email', $term);
          $this->db->or_like('k.alamat', $term);
          $this->db->or_like('tk.tanggal_pembayaran', $term);
          $this->db->or_like('tk.tanggal_expired', $term);
          $this->db->or_like('tk.status_pembayaran', $term);
          if(isset($_REQUEST['order'])) // here order processing
          {
             $this->db->order_by($column[$_REQUEST['order']['0']['column']], $_REQUEST['order']['0']['dir']);
          } 
          else if(isset($this->order))
          {
             $order = $this->order;
             $this->db->order_by(key($order), $order[key($order)]);
          }else{
             $this->db->order_by("trans_klinik_id", "DESC");
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
