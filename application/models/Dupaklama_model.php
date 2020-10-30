<?php 

    class Dupaklama_model extends CI_Model {

        protected $table = 'dupak';

        function insert($dt){

            $a = $this->db->insert($this->table,$dt);
            if($a){
                return TRUE;
            }else{
                return FALSE;
            }
        }

        function update($data,$id){

            $a = $this->db->update($this->table,$data,array('id_dupak' => $id));
            if($a){
                return TRUE;
            }else{
                return FALSE;
            }
        }

        function pengajuan($nip,$tahun){
            $this->db->from("penilaian");
            $this->db->join('master_statuspenilaian','penilaian.status = master_statuspenilaian.status','left');
            $this->db->where('nip',$nip);
            $this->db->where('tahun',$tahun);
            $dt = $this->db->get()->row();

            // $dt = $this->db->get_where('penilaian',array('nip' => $nip,'tahun' => $tahun))->row();
            return $dt;
        }

        function data($limit,$from,$tahun){

            $nip = $_SESSION['nip'];
            $this->db->from($this->table);
            $this->db->select("*, ".$this->table.".angka_kredit as dupak_ak");
            $this->db->join('master_kegiatan',$this->table.".kode_kegiatan = master_kegiatan.kode_kegiatan","left");
            $this->db->join('master_subunsur',"master_kegiatan.id_subunsur = master_subunsur.id_subunsur","left");
            $this->db->join('master_unsur',"master_subunsur.id_unsur = master_unsur.id_unsur","left");
            $this->db->join('master_status',$this->table.".id_status = master_status.id_status","left");
            $this->db->where('nip',$nip);
            $this->db->order_by($this->table.'.id_dupak','DESC');

             $this->db->limit($limit,$from);
         return $query = $this->db->get()->result();		
        }

        function list_dupak($nip,$tahun){

            $this->db->from($this->table);
            $this->db->join('v_all_kegiatan',$this->table.".kode_kegiatan = v_all_kegiatan.kode_kegiatan","left");
            $this->db->join('master_status',$this->table.".id_status = master_status.id_status","left");
            $this->db->where('nip',$nip);
            $this->db->where('tahun',$tahun);   
            $this->db->order_by('v_all_kegiatan.kode_kegiatan','ASC');         
         return $query = $this->db->get()->result();		
        }

        function list_dupak_type($nip,$tahun,$type){

            $this->db->from($this->table);
            $this->db->join('v_all_kegiatan',$this->table.".kode_kegiatan = v_all_kegiatan.kode_kegiatan","left");
            $this->db->join('master_status',$this->table.".id_status = master_status.id_status","left");
            $this->db->where('nip',$nip);
            $this->db->where('tahun',$tahun);   
            $this->db->where('v_all_kegiatan.nama_utama',$type);   
            $this->db->order_by('v_all_kegiatan.kode_kegiatan','ASC');         
         return $query = $this->db->get()->result();		
        }

        function detail($id_dupak){
             $nip = $_SESSION['nip'];
             $this->db->from($this->table);
             $this->db->join('master_kegiatan',$this->table.".kode_kegiatan = master_kegiatan.kode_kegiatan","left");
             $this->db->join('master_subunsur',"master_kegiatan.id_subunsur = master_subunsur.id_subunsur","left");
             $this->db->join('master_unsur',"master_subunsur.id_unsur = master_unsur.id_unsur","left");
             $this->db->join('master_status',$this->table.".id_status = master_status.id_status","left");
             $this->db->where('nip',$nip);
            $this->db->where('id_dupak',$id_dupak);
            //  $this->db->limit($limit,$from);
            
         $query = $this->db->get()->row();
            return $query;
        }


        function detaildupak($id_dupak){
            $this->db->from($this->table);
            $this->db->join('master_kegiatan',$this->table.".kode_kegiatan = master_kegiatan.kode_kegiatan","left");
            $this->db->join('master_subunsur',"master_kegiatan.id_subunsur = master_subunsur.id_subunsur","left");
            $this->db->join('master_unsur',"master_subunsur.id_unsur = master_unsur.id_unsur","left");
            $this->db->join('master_status',$this->table.".id_status = master_status.id_status","left");
           $this->db->where('id_dupak',$id_dupak);
           //  $this->db->limit($limit,$from);
           
        return $query = $this->db->get()->row();
       }

        function get_file($id_dupak){

            return $this->db->get_where('dupak_file',array('id_dupak' => $id_dupak))->result();


        }


        function total($tahun){
            return $this->db->get_where($this->table,array('tahun' => $tahun,'nip' => $_SESSION['nip']))->num_rows();
        }
        

        function get_files(){

            $a = $this->db->get_where('ak_lama_file',array('nip' => $_SESSION['nip']))->row();
            return $a;

        }
        

        function getAllDupak(){
            $this->db->from('v_all_kegiatan');
         //   $this->db->join('ak_lama_pegawai','v_all_kegiatan.kode_kegiatan = ak_lama_pegawai.kode_kegiatan','left');
         //   $this->db->where('ak_lama_pegawai.nip',$_SESSION['nip']);
            $this->db->order_by('v_all_kegiatan.kode_kegiatan','ASC');
            $data = $this->db->get();
            // print_r($this->db->last_query());
            // exit;
            return $data->result();
    }

    function nilai(){
        $this->db->from('v_all_kegiatan');
          $this->db->join('ak_lama_pegawai','v_all_kegiatan.kode_kegiatan = ak_lama_pegawai.kode_kegiatan','left');
          $this->db->where('ak_lama_pegawai.nip',$_SESSION['nip']);
           $this->db->order_by('v_all_kegiatan.kode_kegiatan','ASC');
           $data = $this->db->get();
           // print_r($this->db->last_query());
           // exit;
           return $data->result();
        
        }
        


    }