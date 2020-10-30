<?php 

    class Pengajuan_model extends CI_Model {

        protected $table = 'penilaian';

        function insert($dt){

            $a = $this->db->insert($this->table,$dt);
            if($a){
                return TRUE;
            }else{
                return FALSE;
            }
        }

        function pengajuan($nip,$tahun){
            $this->db->from($this->table);
            $this->db->join('master_statuspenilaian',$this->table.'.status = master_statuspenilaian.status');
            $this->db->where('nip',$nip);
            $this->db->where('tahun',$tahun);
            $dt = $this->db->get()->row();

            // $dt = $this->db->get_where('penilaian',array('nip' => $nip,'tahun' => $tahun))->row();
            return $dt;
        }

        function data($limit,$from,$tahun){

            $this->db->from($this->table);
            $this->db->join('master_statuspenilaian',$this->table.'.status = master_statuspenilaian.status');
            $this->db->join('karyawan',$this->table.".nip = karyawan.nip","left");
            $this->db->where('tahun',$tahun);
             $this->db->limit($limit,$from);
            
         return $query = $this->db->get()->result();		
        }
      
        function detail($nip){
             $this->db->from($this->table);
             $this->db->join('master_statuspenilaian',$this->table.'.status = master_statuspenilaian.status');
             $this->db->join('karyawan',$this->table.".nip = karyawan.nip","left");
             $this->db->where($this->table.'.nip',$nip);
            //  $this->db->limit($limit,$from);
            
         return $query = $this->db->get()->row();
        }

        function get_file($id_dupak){

            return $this->db->get_where('dupak_file',array('id_dupak' => $id_dupak))->result();


        }


        function total($tahun){
            return $this->db->get_where($this->table,array('tahun' => $tahun))->num_rows();
        }
        

        function get_files($id_penilaian){

            $a = $this->db->get_where('penilaian_file',array('id_penilaian' => $id_penilaian))->result();
            return $a;

        }
        
        


    }