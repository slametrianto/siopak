<?php   
    class Master_kegiatan_model extends CI_Model {
        protected $table = 'master_kegiatan';

        function detail($id_kegiatan) {
            $this->db->from("v_all_kegiatan");
            // $this->db->join('master_golongan',$this->table.'.id_golongan = master_golongan.id_golongan','left');
            $this->db->where('id_kegiatan',$id_kegiatan);
            $query = $this->db->get();
            $run = $query->row();
            return $run;
        }

        function get_by_subunsur($id_subunsur){
            $this->db->from($this->table);
            $this->db->where('id_subunsur',$id_subunsur);
            $query = $this->db->get()->result();
            return $query;
        }


        function getAll(){

                $this->db->from('v_all_kegiatan');
                $this->db->order_by('kode_kegiatan','ASC');
                $data = $this->db->get();
                return $data->result();
        }

        function getAllDupak(){
                $this->db->from('v_all_kegiatan');
                $this->db->where('is_pilih',1);
                $this->db->order_by('kode_kegiatan','ASC');
                $data = $this->db->get();
                return $data->result();
        }


      //   function data($limit,$from){
		    // $this->db->from($this->table);
      //       $this->db->join('master_golongan',$this->table.'.id_golongan = master_golongan.id_golongan','left');
      //       $this->db->join('master_tipefungsional',$this->table.'.id_tipefungsional = master_tipefungsional.id_tipefungsional','left');
      //       // $this->db->where('nip',$nip);
      //           $this->db->limit($limit,$from);
            
      //    	return $query = $this->db->get()->result();		
      //   }

        // function total(){
        //     return $this->db->get($this->table)->num_rows();
        // }
    }