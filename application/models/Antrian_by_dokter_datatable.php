<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
Class Antrian_by_dokter_datatable extends CI_Model
{
      var $table = "antrian";
      var $select_column = array("*");
      //var $get_dokter = $this->mymodel->getbywhere('dokter','username',$this->session->userdata('dokter'),'row');
      var $order_column = array( "pasien_id","dokter_id","nomor_antri");
      function make_query()
      {
          //$this->db->where('dokter_id', $get_dokter->dokter_id);
           $this->db->select($this->select_column);
           $this->db->from($this->table);
           if(!empty($_POST["search"]["value"]))
           {
                $this->db->like("nomor_antri", $_POST["search"]["value"]);
           }
           if(!empty($_POST["order"]))
           {
                $this->db->order_by($this->order_column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
           }
           else
           {
                $this->db->order_by('nomor_antri', 'DESC');
           }
      }
      function make_datatables(){
           $this->make_query();
           if($_POST["length"] != -1)
           {
                $this->db->limit($_POST['length'], $_POST['start']);
           }
           $query = $this->db->get();
           return $query->result();
      }
      function get_filtered_data(){
           $this->make_query();
           $query = $this->db->get();
           return $query->num_rows();
      }
      function get_all_data()
      {
           $this->db->select("*");
           $this->db->from($this->table);
           return $this->db->count_all_results();
      }
  }

?>
