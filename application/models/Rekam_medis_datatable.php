<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
Class Rekam_medis_datatable extends CI_Model
{
      var $table = "histori_data_scan";
      var $select_column = array("*");
      var $order_column = array('created_at','biaya');
      function make_query($term=''){ //term is value of $_REQUEST['search']['value']
          $column = array('hds.*','d.nama_dokter','p.nama_lengkap','k.nama_klinik','cp.nama_poli');
          $this->db->select('hds.*','d.nama_dokter','p.nama_lengkap','k.nama_klinik','cp.nama_poli');
          $this->db->from('histori_data_scan as hds');
          $this->db->join('pasien as p', 'p.pasien_id = hds.pasien_id','left');
          $this->db->join('dokter as d', 'd.dokter_id = hds.dokter_id','left');
          $this->db->join('klinik as k', 'k.klinik_id = hds.klinik_id','left');
          $this->db->join('category_poli as cp', 'hds.category_poli_id = cp.category_poli_id','left');
          $this->db->where('hds.is_deleted', "0");
          $this->db->where('d.username', $this->session->userdata('dokter'));
          $this->db->group_start();
          $this->db->like('d.nama_dokter', $term);
          $this->db->or_like('p.nama_lengkap', $term);
          $this->db->or_like('k.nama_klinik', $term);
          $this->db->or_like('cp.nama_poli', $term);
          $this->db->or_like('hds.alasan_kunjungan', $term);
          $this->db->or_like('hds.keluhan_utama', $term);
          $this->db->or_like('hds.riwayat_medis', $term);
          $this->db->or_like('hds.biaya', $term);
          $this->db->or_like('hds.nomor_antri', $term);
          $this->db->group_end();
          if(isset($_REQUEST['order'])) // here order processing
          {
             $this->db->order_by($column[$_REQUEST['order']['0']['column']], $_REQUEST['order']['0']['dir']);
          } 
          else if(isset($this->order))
          {
             $order = $this->order;
             $this->db->order_by(key($order), $order[key($order)]);
          }else{
             $this->db->order_by("histori_data_scan_id", "DESC");
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
