<?php 

    class Paklama extends CI_Controller {
        

        function __construct()
        {
            parent::__construct();
            $this->load->model('Paklama_model','model');
            $this->load->model('Dupak_model','dupak');
            $this->load->model('Master_kegiatan_model','kegiatan');
            $this->load->model('Master_unsur_model','unsur');
            $this->load->model('Master_subunsur_model','subunsur');

        }


        function index(){

             $tahun = date('Y');
            $this->load->library('pagination');
            $config['base_url'] = base_url().'backend/paklama/index/';
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
            $data['title'] = 'Data PAK Tahun Sebelumnya '.$tahun;

            
            $data['template'] = 'admin/pages/paklama/index';

            $this->load->view('admin/dashboard',$data);

        }


        function detail($id){
            $data['kegiatan'] = $this->model->detail($id);
            $data['title'] = 'Detail PAK Sebelumnya NIP ';
            $data['files'] = $this->model->get_file($id);
            // print_r($data['file']);
            // exit;
            $data['template'] = 'admin/pages/paklama/detail';
            $this->load->view('admin/dashboard',$data);

        }

        function detaildupak($id){

            $data['data'] = $this->dupak->detaildupak($id);

            // print_r($data['data']);
            // exit;
            $data['file'] = $this->dupak->get_file($id);
            $data['template'] = 'admin/pages/pengajuan/detaildupak';
            $this->load->view('admin/dashboard',$data);

        }

        function proses(){

            $nip        =   $this->input->post('nip');
            $ak_periode_sebelumnya  =   $this->input->post('ak_periode_sebelumnya');
            $ak_lama_admin  =   $this->input->post('ak_lama_admin');
            $kode_kegiatan          =   $this->input->post('kode_kegiatan');
            foreach($ak_periode_sebelumnya as $k => $v){

                $update = array(
                    'ak_lama_admin' => $ak_lama_admin[$k]
                );
               $a =  $this->db->update('ak_lama_pegawai',$update,array('kode_kegiatan' => $kode_kegiatan[$k],'nip' => $nip));
                // print_r($this->db->last_query());
                // exit;
            }

            alert('Berhasil Admin Validasi','success');
            redirect('backend/paklama/detail/'.$nip);
        }

        



    }
