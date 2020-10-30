<?php 

    class Struktural extends CI_Controller {
        function __construct()
        {
            parent::__construct();
            $this->load->model('Management_user_model', 'user_m');
            $this->load->model('Struktural_model','model');
        }
        function index(){
            $this->load->library('pagination');
            $config['base_url'] = base_url().'backend/struktural/index/';
            $config['total_rows'] = $this->model->total();
            $config['per_page'] = 10;
            $choice = $config["total_rows"] / $config["per_page"];
            $config["num_links"] = floor($choice);
            // Membuat Style pagination untuk BootStrap v4
             $config['first_link']       = 'First';
            $config['last_link']        = 'Last';
            $config['next_link']        = 'Next';
            $config['prev_link']        = 'Prev';
            $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
            $config['full_tag_close']   = '</ul></nav></div>';
            $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
            $config['num_tag_close']    = '</span></li>';
            $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
            $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
            $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
            $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
            $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
            $config['prev_tagl_close']  = '</span>Next</li>';
            $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
            $config['first_tagl_close'] = '</span></li>';
            $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
            $config['last_tagl_close']  = '</span></li>';
            $from = $this->uri->segment(4);
            $this->pagination->initialize($config);
            $data['pagination'] = $this->pagination->create_links();
            $data['data'] = $this->model->data($config['per_page'],$from);
            $data['template'] = 'admin/pages/stuktural/index';
            $this->load->view('admin/dashboard',$data);
        }

        public function add()
        {
            $data['template'] = 'admin/pages/stuktural/add_stuktural';
            $this->load->view('admin/dashboard', $data);
        }
        public function edit()
        {
            $id_tipefungsional = $this->uri->segment(4);
            $data["param"] = $this->db->select("*")->from("master_tipefungsional")->where("id_tipefungsional",$id_tipefungsional)->get()->result_array();
            $data['template'] = 'admin/pages/stuktural/edit_struktural';
            $this->load->view('admin/dashboard', $data);
        }
        public function update_struktural()
        {
            $id_tipefungsional = $this->uri->segment(4);
             $tipe_fungsional = $this->input->post('tipe_fungsional');
                $data = array(
                'tipe_fungsional' => $tipe_fungsional);
            $where = array(
                'id_tipefungsional' => $id_tipefungsional
            );
            $update_struktural =  $this->model->update_data($where,$data,'master_tipefungsional');
            if($update_struktural){
                    $this->session->set_flashdata('message', "<div class='alert alert-dismissable alert-info'><button type='button' class='close' data-dismiss='alert'>
                                            <font size ='2' color='black'>
                                                <strong>x</strong>
                                            </font></button><strong><p align='center'>Data berhasil diubah</button></p></strong></div>");
            redirect('backend/struktural');    
                }else{
            $this->session->set_flashdata('message', "<div class='alert alert-dismissable alert-info'><button type='button' class='close' data-dismiss='alert'>
                                            <font size ='2' color='black'>
                                                <strong>x</strong>
                                            </font></button><strong><p align='center'>Data gagal diubah</button></p></strong></div>");
            redirect('backend/struktural');    
            }
        }
        function proses(){
            if($this->input->post()){
             $this->load->library('form_validation');
         $this->form_validation->set_error_delimiters("<div class='alert alert-dismissable alert-danger'><button type='button' class='close' data-dismiss='alert'>x</button>", "</button></div>");
        $this->form_validation->set_rules('tipe_fungsional', 'Fungsional', 'required');

         if ($this->form_validation->run() == false) {
            redirect('backend/struktural/add');

            }else{
            $tipe_fungsional     = $this->input->post('tipe_fungsional');
            $data_arr = array(
                        'tipe_fungsional' => $tipe_fungsional
                    );
            $insert_struktural = $this->db->insert('master_tipefungsional', $data_arr);
            if($insert_struktural){
                    $this->session->set_flashdata('message', "<div class='alert alert-dismissable alert-info'><button type='button' class='close' data-dismiss='alert'>
                                            <font size ='2' color='black'>
                                                <strong>x</strong>
                                            </font></button><strong><p align='center'>Data berhasil disimpan</button></p></strong></div>");
            redirect('backend/struktural');    
                }else{
            $this->session->set_flashdata('message', "<div class='alert alert-dismissable alert-info'><button type='button' class='close' data-dismiss='alert'>
                                            <font size ='2' color='black'>
                                                <strong>x</strong>
                                            </font></button><strong><p align='center'>Data gagal disimpan</button></p></strong></div>");
            redirect('backend/struktural');    

            }
        }
    }}
        public function delete($id_tipefungsional)
        {
      
          $hapus_struktural = $this->db->delete('master_tipefungsional',array('id_tipefungsional' => $id_tipefungsional));
             $this->session->set_flashdata('message', "<div class='alert alert-dismissable alert-info'><button type='button' class='close' data-dismiss='alert'>
                                            <font size ='2' color='black'>
                                                <strong>x</strong>
                                            </font></button><strong><p align='center'>Data berhasil dihapus</button></p></strong></div>");
            redirect('backend/struktural');
        }
    }