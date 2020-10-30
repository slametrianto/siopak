<?php   

    class Error_page extends CI_Controller {

        function __construct(){
            parent::__construct();
        }

        function index(){
            $this->load->view('error_page');
        }

    }