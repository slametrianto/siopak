<?php   

    class Struktural_model extends CI_Model {

        protected $table = 'master_tipefungsional';
        function dokumen(){
            return $this->db->get('master_tipefungsional')->result();
        }
        function data($limit,$from){
         $this->db->limit($limit,$from);
         return $query = $this->db->get($this->table)->result();		
        }

        function total(){
            return $this->db->get($this->table)->num_rows();
        }
        function update_data($where,$data,$table){
        $this->db->where($where);
        $this->db->update($table,$data);
    }   
    }
