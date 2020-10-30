<?php   


    class Login extends CI_Controller {

        function __construct()
        {
            parent::__construct();
            $this->load->model('Login_model','model');
            $this->load->model('Karyawan_model','karyawan');
        }

        function proses(){


            if(!$this->input->is_ajax_request()) {

                redirect('login');

            }else{
                $tahun = date('Y');
                $nip = $this->input->post('nip');
                $password = $this->input->post('password');

                $password = md5($password);
                
                $cek = $this->model->login_penguji($nip,$password);
                if(count($cek) > 0){

                        $cek_tabel = $this->db->get_where('penguji',array('nip'  => $nip,'tahun' => $tahun))->result();
                        if(count($cek_tabel) == 0){
                            echo "gagal";
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
                            'is_dupak' =>  $user->is_dupak
                        );
                        $this->session->set_userdata($data);

                       // print_r($data);

                        // $this->session->set_flashdata('item','<div class="alert alert-info"> User Berhasil ditemukam </div>');
                       echo "sukses";
                    }


                }else{
                    echo "gagal";
                }

            }

        }


        
    }