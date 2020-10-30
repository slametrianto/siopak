<?php 

    class Pengujian_model extends CI_Model {

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
            $this->db->join('master_golongan','karyawan.id_golongan = master_golongan.id_golongan','left');
            $this->db->join('master_jenjang','master_golongan.id_jenjang = master_jenjang.id_jenjang','left');
            $this->db->join('master_tipefungsional','master_jenjang.id_tipefungsional = master_jenjang.id_tipefungsional','left');
            $this->db->where('tahun',$tahun);
             $this->db->limit($limit,$from);
             $this->db->where('nip_penguji',$_SESSION['nip']);
            
         return $query = $this->db->get()->result();		
        }

        function detail($nip){
             $this->db->from($this->table);
             $this->db->join('master_statuspenilaian',$this->table.'.status = master_statuspenilaian.status');
             $this->db->join('karyawan',$this->table.".nip = karyawan.nip","left");

            $this->db->join('master_golongan','karyawan.id_golongan = master_golongan.id_golongan','left');
            $this->db->join('master_jenjang','master_golongan.id_jenjang = master_jenjang.id_jenjang','left');
            $this->db->join('master_tipefungsional','master_jenjang.id_tipefungsional = master_jenjang.id_tipefungsional','left');
            $this->db->join('master_instansi','karyawan.id_instansi = master_instansi.id_instansi','left');            
             $this->db->where($this->table.'.nip',$nip);
                          $this->db->where('nip_penguji',$_SESSION['nip']);

            //  $this->db->limit($limit,$from);
            
         return $query = $this->db->get()->row();
        }

        function get_file($id_dupak){

            return $this->db->get_where('dupak_file',array('id_dupak' => $id_dupak))->result();


        }


        function total($tahun){
            $nip = $_SESSION['nip'];
            return $this->db->get_where($this->table,array('tahun' => $tahun,'nip_penguji' => $nip))->num_rows();
        }
        

        function get_files($id_penilaian){

            $a = $this->db->get_where('penilaian_file',array('id_penilaian' => $id_penilaian))->result();
            return $a;

        }
        
        


    }