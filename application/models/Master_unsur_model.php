<?php   
    class Master_unsur_model extends CI_Model {
        protected $table = 'master_unsur';

        function detail($id_kegiatan_) {
            $this->db->from($this->table);
            // $this->db->join('master_golongan',$this->table.'.id_golongan = master_golongan.id_golongan','left');
            $this->db->where('id_kegiatan',$id_kegiatan);
            $query = $this->db->get();
            $run = $query->row();
            return $run;
        }


        function getAll(){
		      $this->db->from($this->table);
          $this->db->order_by('nama_unsur');
         	return $query = $this->db->get()->result_array();		
        }

              //   function data($limit,$from){
        // $this->db->from($this->table);
      //       $this->db->join('master_golongan',$this->table.'.id_golongan = master_golongan.id_golongan','left');
      //       $this->db->join('master_tipefungsional',$this->table.'.id_tipefungsional = master_tipefungsional.id_tipefungsional','left');
      //       // $this->db->where('nip',$nip);
      //           $this->db->limit($limit,$from);
            
      //      return $query = $this->db->get()->result();   
      //   }

        // function total(){
        //     return $this->db->get($this->table)->num_rows();
        // }
    }