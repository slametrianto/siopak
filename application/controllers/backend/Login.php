<?php   


    class Login extends CI_Controller {

        function __construct()
        {
            parent::__construct();
            $this->load->model('Login_model','model');
            $this->load->model('Karyawan_model','karyawan');
        }


        function index(){
            $data = [];
            $this->load->view('loginadmin',$data);
        }

        function logout(){
            $this->session->sess_destroy();
            $this->session->set_flashdata('item','<div class="alert alert-info"> Logout Berhasil </div>');
            redirect('backend/login');

        }


        function proses(){

            if($this->input->post()){

                $nip = $this->input->post('nip');
                $password = $this->input->post('password');
                $password = md5($password);

                $cek = $this->model->login_admin($nip,$password);
                if(count($cek) > 0){
                    //jika berhasil
                    if($cek[0]->aktif == 0){
                        $this->session->set_flashdata('item','<div class="alert alert-danger"> User Anda Tidak Aktif </div>');
                        redirect('backend/login');

                    }else{
                        
                        $karyawan = $this->karyawan->detail($cek[0]->nip);
                        $user = $this->model->detail($cek[0]->nip);

                        $data = array(
                            'nip' => $karyawan->nip,
                            'nama_lengkap' => $karyawan->nama_lengkap,
                            'nik' => $karyawan->nama_lengkap,
                             'last_login' => $user->last_login,
                            // 'id_golongan' => $karyawan->id_golongan,
                            // 'id_tipefungsional' => $karyawan->id_tipefungsional,
                            // 'golongan' => $karyawan->golongan,
                            // 'tipe_fungsional' => $karyawan->tipe_fungsional,
                            'login' => TRUE,
                            'is_admin' =>  $user->is_admin,
                            'is_penguji' =>  $user->is_penguji,
                            'is_dupak' =>  $user->is_dupak
                        );
                        $this->session->set_userdata($data);
                        $this->session->set_flashdata('item','<div class="alert alert-info"> Login Berhasil . </div>');

                        redirect('backend/dashboard');


                    }


                }else{
                    //jika gagal
                    $this->session->set_flashdata('item','<div class="alert alert-danger"> Username atau Password anda SALAH !!! </div>');
                    redirect('backend/login');


                }





            }else{
                redirect('backend/login');
            }


        }


    }