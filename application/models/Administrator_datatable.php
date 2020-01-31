<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
Class Administrator_datatable extends CI_Model
{
      var $table = "admin";
      var $select_column = array("*");
      var $order_column = array( "nama_lengkap","notelp","username","privileges");
      function make_query()
      {
           $this->db->select($this->select_column);
           $this->db->from($this->table);
           if(!empty($_POST["search"]["value"]))
           {
                $this->db->like("nama_lengkap", $_POST["search"]["value"]);
                $this->db->or_like("notelp", $_POST["search"]["value"]);
                $this->db->or_like("username", $_POST["search"]["value"]);
                
           }
           if(!empty($_POST["order"]))
           {
                $this->db->order_by($this->order_column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
           }
           else
           {
                $this->db->order_by('id', 'DESC');
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
