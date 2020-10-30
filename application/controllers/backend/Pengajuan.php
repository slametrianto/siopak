<?php 

    class Pengajuan extends CI_Controller {
        

        function __construct()
        {
            parent::__construct();
            $this->load->model('Pengajuan_model','model');
            $this->load->model('Dupak_model','dupak');
            $this->load->model('Master_kegiatan_model','kegiatan');
            $this->load->model('Master_unsur_model','unsur');
            $this->load->model('Master_subunsur_model','subunsur');

        }


        function index(){

            $tahun = date('Y');
            $this->load->library('pagination');
            $config['base_url'] = base_url().'backend/pengajuan/index/';
            $config['total_rows'] = $this->model->total($tahun);
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
            $data['data'] = $this->model->data($config['per_page'],$from,$tahun);
            $data['title'] = 'Data Pengajuan DUPAK Tahun '.$tahun;

            
            $data['template'] = 'admin/pages/pengajuan/index';

            $this->load->view('admin/dashboard',$data);

        }


        function detail($id){
            $tahun = date('Y');
            $data['title'] = 'Detail Pengajuan Dupak ';
            $data['data'] = $this->model->detail($id);
            $data['file'] = $this->model->get_file($id);
            $data['dupak'] = $this->dupak->list_dupak($id,$tahun);
            $data['template'] = 'admin/pages/pengajuan/detail';
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

        function approval(){
            $id_dupak  =$this->input->post('id_dupak');

            $tahun = date('Y');
            $get = $this->db->get_where('dupak',array('id_dupak' => $id_dupak))->row();
            $penilaian = $this->db->get_where('penilaian',array('nip' => $get->nip))->row();
            if($penilaian->status == 1){
                $this->db->update('penilaian',array('status' => 2),array('nip' => $get->nip,'tahun' => $tahun));
            }

                $type = $this->input->post('type');

                if($type == 'approve'){
                    $id_status = 3;
                    $upd = $this->db->update('dupak',array('id_status' => $id_status),array('id_dupak' => $id_dupak));

                }else{
                    $komentar = $this->input->post('komentar');
                    $id_status = 99;
                    $upd = $this->db->update('dupak',array('id_status' => $id_status,'komentar' => $komentar),array('id_dupak' => $id_dupak));

                }


                if($upd){
                    echo json_encode(array("status" => TRUE,"message" => "Data DUPAK Berhasil di ".$type));
                }



        }


        function kirim(){
            
            $nip = $this->input->post('nip');
            // echo $nip;
            $tahun = date('Y');
                // echo $nip;
                $penguji = $this->db->get_where('penguji_jabfung',array('nip_jabfung' => $nip,'tahun' => $tahun))->result();
            //print_r($this->db->last_query());
                if(count($penguji) == 0){
                    //echo count($penguji);
                    echo json_encode(array("status" => "FALSE","message" => "Assing Tim Penilai dahulu di menu penguji"));
                   // exit;

                }else{
                $dt = array(
                    'nip_penguji' => $penguji[0]->nip_penguji,
                    'status' => 3
                );


                    $dt2 = array(
                        'id_status' => 4
                    );
                 $update = $this->db->update('dupak',$dt2,array('nip' => $nip,'tahun' => date('Y')));
                $this->db->update('penilaian',$dt,array('nip' => $nip,'tahun' => $tahun));
                    echo json_encode(array("status" => 'TRUE',"message" => "Data DUPAK Berhasil di Kirim"));

            }





        }


        



    }
