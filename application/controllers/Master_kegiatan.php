<?php 

    class Master_kegiatan extends CI_Controller {
        

        function __construct()
        {
            parent::__construct();
            $this->load->model('Master_kegiatan_model','model');
            $this->load->model('Master_unsur_model','unsur');
            $this->load->model('Master_subunsur_model','subunsur');
            
        }

        function create(){
            $data["model"] = [];
            $data["master_unsur"] = $this->unsur->getAll();
            $data["master_subunsur"] = $this->subunsur->getAll();
            $data['template'] = 'master_kegiatan/create';
            $this->load->view('dashboard',$data);
        }

        function process(){
            if($this->input->post()) {
                $data = array(
                    'id_kegiatan' => $this->input->post('id_kegiatan'),
                    'nama_kegiatan' => $this->input->post('nama_kegiatan'),
                    'kode_kegiatan' => $this->input->post('kode_kegiatan'),

                    'angka_kredit' => $this->input->post('angka_kredit'),
                    'satuan_hasil' => $this->input->post('satuan_hasil'),

                    'pelaksanaan' => $this->input->post('pelaksanaan'),
                    'id_subunsur' => $this->input->post('id_subunsur'),
                );
                if ($data['id_kegiatan'] == '') {
                    $this->db->insert('master_kegiatan', $data);    
                } else {
                    $this->db->update('master_kegiatan', $data, array('id_kegiatan' => $data['id_kegiatan']));
                }
            }
            $data['template'] = 'master_kegiatan/create';
            $this->load->view('dashboard',$data);
        }

        function update(){
            // $data['data']     = $this->model->detail($this->input->get('id_kegiatan'));

            $data['template'] = 'master_kegiatan/form';
            $this->load->view('dashboard',$data);
        }

        function index(){
            $data['template'] = 'master_kegiatan/index';
            $this->load->view('dashboard',$data);
        }

    }