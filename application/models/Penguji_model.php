<?php   

    class Penguji_model extends CI_Model {

        protected $table = 'penguji';


        function detail($nip){

            $this->db->from($this->table);
            $this->db->join('karyawan',$this->table.'.nip = karyawan.nip','left');
            $this->db->join('master_golongan','karyawan.id_golongan = master_golongan.id_golongan','left');
            $this->db->join('master_jenjang','master_golongan.id_jenjang = master_jenjang.id_jenjang','left');
            $this->db->join('master_tipefungsional','master_jenjang.id_tipefungsional = master_jenjang.id_tipefungsional','left');
           $this->db->where('penguji.nip',$nip);
            $query = $this->db->get();
            $run = $query->row();
            return $run;

        }


        function data($limit,$from,$tahun){


            $this->db->from($this->table);
            $this->db->join('karyawan',$this->table.'.nip = karyawan.nip','left');
            $this->db->join('master_golongan','karyawan.id_golongan = master_golongan.id_golongan','left');
            $this->db->join('master_jenjang','master_golongan.id_jenjang = master_jenjang.id_jenjang','left');
            $this->db->join('master_tipefungsional','master_jenjang.id_tipefungsional = master_jenjang.id_tipefungsional','left');
          // $this->db->where('nip',$nip);
             $this->db->limit($limit,$from);
            
         return $query = $this->db->get()->result();		
        }

        function total($tahun){
            return $this->db->get_where($this->table,array('tahun' => $tahun))->num_rows();
        }
        
        

        function getpenguji($searchTerm=""){

            // Fetch users
           // $this->db->select('*');
           // $this->db->where("nama_lengkap like '%".$searchTerm."%'  OR nip LIKE '%".$searchTerm."%'");
            
            
           //$fetched_records = $this->db->get('karyawan');
           $tahun = date('Y');
           $query = "SELECT * FROM karyawan LEFT JOIN master_golongan ON karyawan.id_golongan = master_golongan.id_golongan WHERE (nama_lengkap LIKE '%".$searchTerm."%' OR nip LIKE '%".$searchTerm."%') AND nip NOT IN (SELECT nip FROM penguji where tahun = $tahun) AND nip != 'admin'";
         //   echo $query;
           $fetched_records = $this->db->query($query);
           
           $users = $fetched_records->result_array();
       
            // Initialize Array with fetched data
            $data = array();
            foreach($users as $user){
               $data[] = array("id"=>$user['nip'], "text"=>$user['nama_lengkap']." - ".$user['golongan']." ".$user['nama_golongan']);
            }
            return $data;
         }

         function getkaryawan($searchTerm="",$nip){

            // Fetch users
           // $this->db->select('*');
           // $this->db->where("nama_lengkap like '%".$searchTerm."%'  OR nip LIKE '%".$searchTerm."%'");
            
            
           //$fetched_records = $this->db->get('karyawan');
           $tahun = date('Y');
           $query = "SELECT * FROM karyawan WHERE (nama_lengkap LIKE '%".$searchTerm."%' OR nip LIKE '%".$searchTerm."%') AND nip NOT IN (SELECT nip_jabfung FROM penguji_jabfung where tahun = $tahun) AND nip != '$nip' AND nip != 'admin'";
         //   echo $query;
           $fetched_records = $this->db->query($query);
           
           $users = $fetched_records->result_array();
       
            // Initialize Array with fetched data
            $data = array();
            foreach($users as $user){
               $data[] = array("id"=>$user['nip'], "text"=>$user['nama_lengkap']);
            }
            return $data;
         }

         function get_jabfung($nip){
            $tahun = date('Y');
            $this->db->from('penguji_jabfung');
            $this->db->join('karyawan','penguji_jabfung.nip_jabfung = karyawan.nip','left');
            $this->db->join('master_golongan','karyawan.id_golongan = master_golongan.id_golongan','left');
		$this->db->join('master_jenjang','master_golongan.id_jenjang = master_jenjang.id_jenjang','left');
		$this->db->join('master_tipefungsional','master_jenjang.id_tipefungsional = master_jenjang.id_tipefungsional','left');
            $this->db->where('penguji_jabfung.nip_penguji',$nip);
            $this->db->where('tahun',$tahun);

            $get = $this->db->get();
            return $get->result();

         }



    }