<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
Class Rumah_sakit_datatable extends CI_Model
{
      var $table = "klinik";
      var $select_column = array("*");
      var $order_column = array( "nama_klinik","alamat","phone","jam_buka_tutup","hari_buka_tutup");
      function make_query()
      {
           $this->db->select($this->select_column);
           $this->db->from($this->table);
           if(!empty($_POST["search"]["value"]))
           {
            $this->db->like("nama_klinik", $_POST["search"]["value"]);
            $this->db->or_like('phone', $_POST["search"]["value"]);
            $this->db->or_like('alamat', $_POST["search"]["value"]);
            $this->db->or_like('hari_buka_tutup', $_POST["search"]["value"]);
            $this->db->or_like('jam_buka_tutup', $_POST["search"]["value"]);
           }
           if(!empty($_POST["order"]))
           {
                $this->db->order_by($this->order_column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
           }
           else
           {
                $this->db->order_by('klinik_id', 'DESC');
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
