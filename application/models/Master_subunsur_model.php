<?php   
    class Master_subunsur_model extends CI_Model {
        protected $table = 'master_subunsur';

        function getAll(){
		      $this->db->from($this->table);
          $this->db->order_by('nama_subunsur');
         	return $query = $this->db->get()->result_array();		
        }

        function get_by_unsur($id_unsur){
            $this->db->from($this->table);
            $this->db->where('id_unsur',$id_unsur);
            $query = $this->db->get()->result();
            return $query;
        }
    }