<?php 

    class Paklama_model extends CI_Model {

        protected $table = 'ak_lama_pegawai';

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

        function data($limit,$from){

            $this->db->from('ak_lama_file');
            $this->db->join('karyawan',"ak_lama_file.nip = karyawan.nip","left");
             $this->db->limit($limit,$from);
             $query = $this->db->get();
             //print_r($this->db->last_query());
           // exit;
             return $query->result();	
           
         
        }

        function detail($nip){
             $this->db->from('ak_lama_pegawai');
             $this->db->join('v_all_kegiatan','ak_lama_pegawai.kode_kegiatan = v_all_kegiatan.kode_kegiatan','left');
             $this->db->where('ak_lama_pegawai.nip',$nip);
             $query = $this->db->get();
        //     print_r($this->db->last_query());
        //    exit;
             return $query->result();	
        }

        // function get_file($id_dupak){

        //     return $this->db->get_where('dupak_file',array('id_dupak' => $id_dupak))->result();


        // }


        function total(){
            return $this->db->get('ak_lama_file')->num_rows();
        }
        

        function get_file($nip){

            $a = $this->db->get_where('ak_lama_file',array('nip' => $nip))->row();
            return $a;

        }
        
        


    }
