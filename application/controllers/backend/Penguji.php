<?php 

    class Penguji extends CI_Controller {


        function __construct()
        {
            parent::__construct();
            $this->load->model('Penguji_model','model');
        }

        function index(){
            $data['css'] = 'admin/pages/penguji/css_add';
            $tahun = date('Y');

            $this->load->library('pagination');
            $config['base_url'] = base_url().'backend/user/index/';
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
            $data['title'] = 'Data Penguji Tahun '.$tahun;
            $data['template'] = 'admin/pages/penguji/index';
            $this->load->view('admin/dashboard',$data);



        }

        function add(){
            $data['title'] = 'Tambah Data Penguji';
            $data['template'] = 'admin/pages/penguji/index';
            $this->load->view('admin/dashboard',$data);


        }

        function getpenguji(){
            $searchTerm = $this->input->post('searchTerm');

            // Get users
            $response = $this->model->getpenguji($searchTerm);
      
            echo json_encode($response);
        }

        function getkaryawan(){
            $searchTerm = $this->input->post('searchTerm');
            $nip        = $this->input->post('nip');
            // Get users
            $response = $this->model->getkaryawan($searchTerm,$nip);
      
            echo json_encode($response);
        }

        function prosestambah(){
            // print_r($_POST);
            if($this->input->is_ajax_request()) {

                $nip = $this->input->post('nip');
                $data = explode(",",$nip);
                foreach($data as $k => $v){
                    $dt = array(
                        'nip' => $v,
                        'tahun' => date('Y'),
                        'created_by' => $_SESSION['nama_lengkap'],
                        'created_date' => date('Y-m-d H:i:s')
                    );
                    $this->db->insert('penguji',$dt);
                    $cek = $this->db->get_where('users',array('nip' => $v))->result();
                    if(count($cek) > 0){
                        $updat2 = $this->db->update('users',array('is_penguji' => 1),array('nip' => $nip));
                    }else{
                        $dt2 = array(
                            'nip' => $v,
                            'password' => md5($v),
                            'is_penguji' => 1,
                            'is_dupak'  =>  1,
                            'aktif' => 1
                        );

                        $this->db->insert('users',$dt2);
                    }
                    
                
                }
                echo 'berhasil';


            }else{
                echo 'gaada';
            }

        }



        function prosestambahjabfung(){
            // print_r($_POST);
            if($this->input->is_ajax_request()) {

                $nip = $this->input->post('nip');
                $nip_penguji = $this->input->post('nip_penguji');
                $data = explode(",",$nip);
                $tahun = date('Y');
                foreach($data as $k => $v){
                    $dt = array(
                        'nip_jabfung' => $v,
                        'nip_penguji' => $nip_penguji,
                        'tahun' => $tahun,
                        'created_by' => $_SESSION['nama_lengkap'],
                        'created_date' => date('Y-m-d H:i:s')
                    );
                    $this->db->insert('penguji_jabfung',$dt);
                
                
                }
                echo 'berhasil';


            }else{
                echo 'gaada';
            }

        }

        function hapus($nip){

            $tahun = date('Y');
            
//            $this->db->update('penilaian',array('nip_penguji' => '','status'=> 2),array('nip_penguji' => $nip));
            
            
            $delete = $this->db->delete('penguji',array('nip' => $nip, 'tahun' => date('Y')));
            $this->db->update('users',array('is_penguji' => 0),array('nip' => $nip));

            alert("Penguji berhasil dihapus","info");
            redirect('backend/penguji');

        }


        function tambahjabfung($nip){
            $tahun = date('Y');
            $data['title'] = 'Data Penguji Tahun '.$tahun;
            $data['template'] = 'admin/pages/penguji/tambahjabfung';
            $data['data'] = $this->model->get_jabfung($nip);
            $data['penguji'] = $this->model->detail($nip);
            $this->load->view('admin/dashboard',$data);
        }

        
        function hapusjabfung($nip,$nip_penguji){
            $tahun = date('Y');
            $cek = $this->db->get_where('penilaian',array('nip' => $nip,'tahun' => $tahun))->result();
            if(count($cek) == 0){
                
                $delete = $this->db->delete('penguji_jabfung',array('nip_jabfung' => $nip,'tahun' => $tahun));
                
            }else{
                $update = $this->db->update('penilaian',array('status' => 2,'nip_penguji' => ''),array('nip' => $nip,'tahun' => $tahun));
                $update = $this->db->update('dupak',array('id_status' => 3),array('nip' => $nip,'tahun' => $tahun));
                    $delete = $this->db->delete('penguji_jabfung',array('nip_jabfung' => $nip,'tahun' => $tahun));
            }
            
            alert("Penguji berhasil dihapus","info");
            redirect('backend/penguji/tambahjabfung/'.$nip_penguji);
            
        }

    

    }
