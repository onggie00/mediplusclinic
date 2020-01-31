<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
Class Jadwal_dokter_datatable extends CI_Model
{
      var $table = "jadwal_dokter";
      var $select_column = array("*");
      var $order_column = array( "dokter_id","senin","selasa","rabu","kamis","jumat","sabtu","minggu");
      function make_query()
      {
           $this->db->select($this->select_column);
           $this->db->from($this->table);
           if(!empty($_POST["search"]["value"]))
           {
                $this->db->like("senin", $_POST["search"]["value"]);
                $this->db->or_like("selasa", $_POST["search"]["value"]);
                $this->db->or_like("rabu", $_POST["search"]["value"]);
                $this->db->or_like("kamis", $_POST["search"]["value"]);
                $this->db->or_like("jumat", $_POST["search"]["value"]);
                $this->db->or_like("sabtu", $_POST["search"]["value"]);
                $this->db->or_like("minggu", $_POST["search"]["value"]);
           }
           if(!empty($_POST["order"]))
           {
                $this->db->order_by($this->order_column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
           }
           else
           {
                $this->db->order_by('jadwal_dokter_id', 'DESC');
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
