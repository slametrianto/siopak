<?php   

    class Login_model extends CI_Model {

        protected $table = 'users';


        function get_login($nip,$password){

            $query = $this->db->get_where($this->table,array('nip' => $nip,'password' => $password,'is_dupak' => 1));
            $run = $query->result();
            return $run;

        }

        function login_penguji($nip,$password){

            $query = $this->db->get_where($this->table,array('nip' => $nip,'password' => $password,'is_penguji' => 1));
            $run = $query->result();
            return $run;
        }


        function login_admin($nip,$password){

            $query = $this->db->get_where($this->table,array('nip' => $nip,'password' => $password,'is_admin' => 1));
            $run = $query->result();
            return $run;
        }


         function detail($nip){

            $this->db->from($this->table);
                 $this->db->where('nip',$nip);
            $query = $this->db->get();
            $run = $query->row();
            return $run;

        }
    }