<?php   


    class Ajax extends CI_Controller {

        function __construct()
        {
            parent::__construct();
            $this->load->model('Golongan_model','golongan');
        }

        function get_jenjang(){

            if (!$this->input->is_ajax_request()) {
                exit('No direct script access allowed');
             }else{

                $id_tipefungsional = $this->input->post('id_tipefungsional');
                $data = $this->golongan->get_jenjang($id_tipefungsional);
               // print_r($this->db->last_query());
                echo json_encode(array("status" => 'TRUE',"data" => $data));

             }
        }



        function get_golongan(){

            if (!$this->input->is_ajax_request()) {
                exit('No direct script access allowed');
             }else{

                $id_golongan = $this->input->post('id_golongan');
                $data = $this->golongan->get_golongan($id_golongan);
                echo json_encode(array("status" => 'TRUE',"data" => $data));

             }
        }


    }