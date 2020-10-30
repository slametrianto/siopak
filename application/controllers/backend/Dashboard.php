<?php 


    class Dashboard extends CI_Controller {

        function __construct()
        {
            parent::__construct();
            header("Last-Modified: " . gmdate( "D, j M Y H:i:s" ) . " GMT"); // Date in the past
            header("Expires: " . gmdate( "D, j M Y H:i:s", time() ) . " GMT"); // always modified
            header("Cache-Control: no-store, no-cache, must-revalidate"); // HTTP/1.1
            header("Cache-Control: post-check=0, pre-check=0", FALSE);
            header("Pragma: no-cache");
            $this->load->library(array('session'));
            is_admin();
        }
        function index(){
           if($this->session->userdata('is_admin') !=1)
        {
            redirect('backend/login');
            }
                else
           {

             $data['title'] = 'Dashboard Admin';
            $data['template'] = 'admin/partial/index';
            $this->load->view('admin/dashboard',$data);
        }

        }

    }