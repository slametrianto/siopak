<?php 

    class User extends CI_Controller {


        function __construct()
        {
            parent::__construct();
            $this->load->model('Karyawan_model','model');
            $this->load->model('Register_model', 'register');
            $this->load->model('Management_user_model', 'user_m');
            $this->load->model('Golongan_model','golongan');

        }

        function index(){
            $this->load->library('pagination');
            $config['base_url'] = base_url().'backend/user/index/';
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

            $data['template'] = 'admin/pages/user/index';
            $this->load->view('admin/dashboard',$data);



        }

        public function add()
        {

        // $this->load->library('form_validation');
        // $this->form_validation->set_error_delimiters("<div class='alert alert-dismissable alert-danger'><button type='button' class='close' data-dismiss='alert'>
        //                                                 x
        //                                            </button>", "</button></div>");
        // $this->form_validation->set_rules('nip', 'Nip', 'required|min_length[5]|max_length[20]|numeric');
        // $this->form_validation->set_rules('nik', 'Nik', 'required|min_length[5]|max_length[17]|numeric');
        // $this->form_validation->set_rules('nama_lengkap', 'Nama', 'required');
        // $this->form_validation->set_rules('tempat_lahir', 'Tempat lahir', 'required');
        // $this->form_validation->set_rules('tempat_lahir', 'Tempat lahir', 'required');
        // $this->form_validation->set_rules('tanggal_lahir', 'Tanggal lahir', 'required');
        // $this->form_validation->set_rules('alamat', 'Alamat', 'required');
        // $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        // $this->form_validation->set_rules('no_telepon', 'Nomor telepon', 'required');
        // $this->form_validation->set_rules('golongan', 'Golongan', 'required');
        // $this->form_validation->set_rules('fungsional', 'Fungsional', 'required');

        // if ($this->form_validation->run() == false) {
            //$data['data_fungsional'] = $this->register->tampil_data_fungsional();
            // $data['data_golongan'] = $this->register->tampil_data_golongan("1");
            
                $data['fungsional'] = $this->golongan->get_fungsional();

            $data['template'] = 'admin/pages/user/add_user';
            $this->load->view('admin/dashboard', $data);
        // }else{
        //     $nip   = $this->input->post('nip');
        //     $nik    = $this->input->post('nik');
        //     $nama_lengkap   = $this->input->post('nama_lengkap');
        //     $tempat_lahir   = $this->input->post('tempat_lahir');
        //     $tanggal_lahir  = $this->input->post('tanggal_lahir');
        //     $alamat         = $this->input->post('alamat');
        //     $email          = $this->input->post('email');
        //     $no_telepon     = $this->input->post('no_telepon');
        //     $golongan       = $this->input->post('golongan');
        //     $fungsional     = $this->input->post('fungsional');


        //     $data_arr = array(
        //                 'nip' => $nip,
        //                 'nik' => $nik,
        //                 'nama_lengkap' => $nama_lengkap,
        //                 'tempat_lahir' => $tempat_lahir,
        //                 'tanggal_lahir' => $tanggal_lahir,
        //                 'alamat'        => $alamat,
        //                 'email'         => $email,
        //                 'no_telp'       => $no_telepon,
        //                 'id_golongan'      => $golongan,
        //                 'id_tipefungsional' => $fungsional
        //             );

        //     $this->user_m->add($data_arr, 'karyawan');
        //     $this->session->set_flashdata('message', "<div class='alert alert-dismissable alert-info'><button type='button' class='close' data-dismiss='alert'>
        //                                     <font size ='2' color='black'>
        //                                         <strong>x</strong>
        //                                     </font></button><strong><p align='center'>Data berhasil disimpan</button></p></strong></div>");
        //     redirect('backend/user');    

        // }

           

        }


        function proses(){

            if($this->input->post()){
             $this->load->library('form_validation');
         $this->form_validation->set_error_delimiters("<div class='alert alert-dismissable alert-danger'><button type='button' class='close' data-dismiss='alert'>x</button>", "</button></div>");
        $this->form_validation->set_rules('nip', 'Nip', 'required|min_length[5]|max_length[20]|numeric');
        $this->form_validation->set_rules('nik', 'Nik', 'required|min_length[5]|max_length[17]|numeric');
        $this->form_validation->set_rules('nama_lengkap', 'Nama', 'required');
        $this->form_validation->set_rules('tempat_lahir', 'Tempat lahir', 'required');
        $this->form_validation->set_rules('tempat_lahir', 'Tempat lahir', 'required');
        $this->form_validation->set_rules('tanggal_lahir', 'Tanggal lahir', 'required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('no_telepon', 'Nomor telepon', 'required');
        $this->form_validation->set_rules('id_golongan', 'Golongan', 'required');
        $this->form_validation->set_rules('id_jenjang', 'Jenjang', 'required');
         if ($this->form_validation->run() == false) {

            redirect('backend/user/add');

            }else{

            $nip   = $this->input->post('nip');
            $nik    = $this->input->post('nik');
            $nama_lengkap   = $this->input->post('nama_lengkap');
            $tempat_lahir   = $this->input->post('tempat_lahir');
            $tanggal_lahir  = $this->input->post('tanggal_lahir');
            $alamat         = $this->input->post('alamat');
            $email          = $this->input->post('email');
            $no_telepon     = $this->input->post('no_telepon');
            $id_golongan    = $this->input->post('id_golongan');
            $id_jenjang     = $this->input->post('id_jenjang');
            $id_tipefungsional = $this->input->post('id_tipefungsional');
            $is_user        = $this->input->post('is_user');

           

            $data_arr = array(
                        'nip' => $nip,
                        'nik' => $nik,
                        'id_tipefungsional' => $id_tipefungsional,
                        'nama_lengkap' => $nama_lengkap,
                        'tempat_lahir' => $tempat_lahir,
                        'tanggal_lahir' => $tanggal_lahir,
                        'alamat'        => $alamat,
                        'email'         => $email,
                        'no_telp'       => $no_telepon,
                        'id_golongan'      => $id_golongan
                    );

            $this->user_m->add($data_arr, 'karyawan');
            if(@$is_user == 1){

                $cek_user = $this->db->get_where('users',array('nip' => $nip))->result();
                if(count($cek_user) > 0){
                    

                }else{
                    $dt = array(
                        'nip' => $nip,
                        'password' => md5($nip),
                        'is_dupak' => 1,
                        'aktif' => 1
                    );
                    $this->db->insert('users',$dt);
                }
            }else{
            }
            $this->session->set_flashdata('message', "<div class='alert alert-dismissable alert-info'><button type='button' class='close' data-dismiss='alert'>
                                            <font size ='2' color='black'>
                                                <strong>x</strong>
                                            </font></button><strong><p align='center'>Data berhasil disimpan</button></p></strong></div>");
            redirect('backend/user');    

            }

        }else{
            redirect('404');
        }
    }

        public function edit($nip)
        {
            
            $where = array('nip' => $nip);
            $data['karyawan'] = $this->user_m->edit_data($where, 'karyawan')->result();
//            print_r($data['karyawan']);
  //          exit;
            $data["status_login"] = $this->user_m->get_data_user($nip)->result();
            $data['fungsional'] = $this->golongan->get_fungsional();
            $data['template'] = 'admin/pages/user/edit_user';
            $this->load->view('admin/dashboard', $data);
        }

        public function update()
        {
            $id     = $this->input->post('id_karyawan');
            $nip    = $this->input->post('nip');
            $nik    = $this->input->post('nik');
            $nama_lengkap = $this->input->post('nama_lengkap');
            $tempat_lahir = $this->input->post('tempat_lahir');
            $tanggal_lahir = $this->input->post('tanggal_lahir');
            $alamat         = $this->input->post('alamat');
            $email          = $this->input->post('email');
            $no_telp        = $this->input->post('no_telepon');
            $id_gol         = $this->input->post('id_golongan');
            $id_tipefungsional = $this->input->post('id_tipefungsional');


            $data_arr = array(
                        
                        'nip' => $nip,
                        'nik' => $nik,
                        'id_tipefungsional' => $id_tipefungsional,
                        'nama_lengkap' => $nama_lengkap,
                        'tempat_lahir' => $tempat_lahir,
                        'tanggal_lahir' => $tanggal_lahir,
                        'alamat' => $alamat,
                        'email' => $email,
                        'no_telp' => $no_telp,
                        'id_golongan' => $id_gol);

            $where = array('id_karyawan' => $id);
            $where = array('id_karyawan' => $id);
            $this->user_m->update_data($where, $data_arr, 'karyawan');

            $aktif         = $this->input->post('aktif');
            $is_dupak         = $this->input->post('is_dupak');
            $is_penguji         = $this->input->post('is_penguji');
            $is_admin         = $this->input->post('is_admin');
            $data_user = array(
                        'aktif' => $aktif,
                        'is_dupak' => $is_dupak,
                        'is_penguji' => $is_penguji,
                        'is_admin' => $is_admin);
             $this->db->where("users.nip",$nip);
             $this->db->update("users",$data_user);

             if($is_penguji == 1){
                $cek_data_penguji = $this->db->get_where('penguji',array('nip'  => $nip))->result();
                if(count($cek_data_penguji) == 0){
                $data_penguji = array(
                        'nip' => $nip,
                        'created_date' => date('Y-m-d h:i:s'),
                        'tahun' => date('Y'));
                $this->db->insert("penguji",$data_penguji);
                }else{

                }
             }
            $this->session->set_flashdata('message', "<div class='alert alert-dismissable alert-info'><button type='button' class='close' data-dismiss='alert'>
                                            <font size ='2' color='black'>
                                                <strong>x</strong>
                                            </font></button><strong><p align='center'>Data berhasil diubah</button></p></strong></div>");
            redirect('backend/user');


        }

        public function delete($id)
        {
        $rsKaryawan = $this->db->query("SELECT * FROM karyawan WHERE id_karyawan = ".$id)->result();
        $hapus_user = $this->db->delete('users',array('nip' => $rsKaryawan[0]->nip));
            
        // $rsAngkaLama = $this->db->query("SELECT * FROM ak_lama_pegawai WHERE nip = ".$rsKaryawan[0]->nip)->result();
        // $hapus_AngkaLama = $this->db->delete('ak_lama_pegawai',array('nip' => $rsAngkaLama[0]->nip));
            
        // $rsDupak = $this->db->query("SELECT * FROM dupak WHERE nip = ".$rsKaryawan[0]->nip)->result();
        // $hapus_Dupak = $this->db->delete('dupak',array('nip' => $rsDupak[0]->nip));

            $where = array('id_karyawan' => $id);
            $this->user_m->delete_data($where, 'karyawan');

            $this->session->set_flashdata('message', "<div class='alert alert-dismissable alert-info'><button type='button' class='close' data-dismiss='alert'>
                                            <font size ='2' color='black'>
                                                <strong>x</strong>
                                            </font></button><strong><p align='center'>Data berhasil dihapus</button></p></strong></div>");
            redirect('backend/user');
        }
    }