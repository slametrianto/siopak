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
            $this->load->view('login',$data);
        }

        function logout(){
            $this->session->sess_destroy();
            $this->session->set_flashdata('item','<div class="alert alert-info"> Logout Berhasil </div>');
            redirect('login');

        }


        function proses(){

            if($this->input->post()){

                $nip = $this->input->post('nip');
                $password = $this->input->post('password');
                $password = md5($password);

                $cek = $this->model->get_login($nip,$password);
                if(count($cek) > 0){
                    //jika berhasil
                    if($cek[0]->aktif == 0){
                        $this->session->set_flashdata('item','<div class="alert alert-danger"> User Anda Tidak Aktif, Silahkan  Validasi Email </div>');
                        redirect('login');

                    }else{
                        
                        $karyawan = $this->karyawan->detail($cek[0]->nip);
                         $user = $this->model->detail($cek[0]->nip);
                         
                      
                        $data = array(
                            'nip' => $karyawan->nip,
                            'nama_lengkap' => $karyawan->nama_lengkap,
                            'nik' => $karyawan->nama_lengkap,
                            'id_golongan' => $karyawan->id_golongan,
                            'last_login' => $user->last_login,
                            'id_tipefungsional' => $karyawan->id_tipefungsional,
                            'golongan' => $karyawan->golongan,
                            'tipe_fungsional' => $karyawan->tipe_fungsional,
                            'login' => TRUE,
                             'is_admin' =>  $user->is_admin,
                            'is_penguji' =>  $user->is_penguji,
                            'is_dupak' =>  $user->is_dupak,
                            'photo' => $cek[0]->photo
                        );
                        $this->session->set_userdata($data);
                        $this->session->set_flashdata('item','<div class="alert alert-info"> User Berhasil ditemukam </div>');
                        $this->db->update('users',array('last_login' => date('Y-m-d H:i:s')),array('nip' => $karyawan->nip));

                        $_SESSION['last_login'] = date('Y-m-d H:i:s');
                        redirect('dashboard');


                    }


                }else{
                    //jika gagal
                    $this->session->set_flashdata('item','<div class="alert alert-danger"> Username atau Password anda SALAH !!! </div>');
                    redirect('login');


                }





            }else{
                redirect('login');
            }


        }

        function validasi(){

            $nip = $_GET['nip'];
            $token = $_GET['token'];
            if(@$token =='' OR @$nip == ''){
                redirect('404');
            }else{
            $cek = $this->db->get_where('users',array('nip' => $nip,'token' => $token))->result();
            if(count($cek) > 0){
                $update = $this->db->update('users',array('aktif' => 1),array('nip' => $nip));
                $this->session->set_flashdata('item','<div class="alert alert-info"> Akun anda telah divalidasi, Silahkan Login</div>');
                redirect('login');
            }else{
                redirect('404');
            }
        }
        }

        function reset(){
            $this->db->truncate('penilaian');
            $this->db->truncate('dupak_file');
            $this->db->truncate('dupak');
            $this->db->truncate('penguji_jabfung');
            $this->db->truncate('penguji');
        }


    }