<?php 

    class Golongan_model extends CI_Model {


        function get_golongan($id = 0){
            if($id == 0){
                $a = $this->db->get('master_golongan')->result();
            }else{
                $a = $this->db->get_where('master_golongan',array('id_jenjang' => $id))->result();
            }

            return $a;
        }

        function get_fungsional(){
            $a = $this->db->get('master_tipefungsional')->result();
            return $a;
        }

        function get_jenjang($id = 0){
            if($id == 0){
                $a = $this->db->get('master_jenjang')->result();
            }else{
                $a = $this->db->get_where('master_jenjang',array('id_tipefungsional' => $id))->result();
            }

            return $a;
        }

    }