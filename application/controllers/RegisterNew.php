<?php 

    class Registrasi extends CI_Controller {

        function __construct()
        {
            parent::__construct();  
            $this->load->model('Karyawan_model','karyawan');
             $this->load->model('register_model','register');
        }
        function index(){
            $this->load->helper('string');
            $data['data_fungsional'] = $this->register->tampil_data_fungsional();
            $data['data_golongan'] = $this->register->data_golongan();
            $this->load->view('register', $data);

        }


        function cek_karyawan(){

            $nip = $this->input->post('nip');
            $nik = $this->input->post('nik');

            
            $cek = $this->karyawan->cek_ada($nip,$nik);

            // $cek = $this->db->get_where('karyawan',array('nip' => $nip, 'nik' => $nik))->result();
            if(count($cek) == 0){
                echo json_encode(array("status" => "FALSE","error" => 1,"message" => "Maaf, Karyawan dengan NIP ".$nip." dan NIK ".$nik."  Tidak Ditemukan,Silahkan Menghubungi Admin"));
            }else{

                $cek_user = $this->db->get_where('users',array('nip' => $nip))->result();
                if(count($cek_user) == 0){
                    echo json_encode(array("status" => "TRUE","message" => "Karyawan Bisa Registrasi","data" => $cek[0]));

                }else{
                    echo json_encode(array("status" => "FALSE","error" => 2,"message" => "Karyawan Sudah Terdaftar,Silahkan Login Ke Aplikasi"));

                }

            }


        }

        function get_golongan()
        {
            $modul = $this->input->post('modul', true);
            $id     = $this->input->post('id', true);
            if ($modul == "golongan") {
                echo $this->register->tampil_data_golongan($id);
            }
           

        }

        

        function prosesregister(){
            $this->load->library('form_validation');
            $this->form_validation->set_error_delimiters("<div class='alert alert-dismissable alert-danger'><button type='button' class='close' data-dismiss='alert'>x</button>", "</button></div>");
            $this->form_validation->set_rules('nip', 'Nip', 'required|min_length[9]|max_length[9]|numeric|is_unique[users.nip]');
            $this->form_validation->set_rules('nik', 'Nik', 'required|min_length[16]|max_length[16]|numeric');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
            $this->form_validation->set_rules('nama_lengkap', 'Nama', 'required');
            $this->form_validation->set_rules('tempat_lahir', 'Tempat lahir', 'required');
            $this->form_validation->set_rules('tanggal_lahir', 'Tanggal lahir', 'required');
            if($this->form_validation->run() == FALSE){
            $this->session->set_flashdata('item','<div class="alert alert-danger">'.validation_errors().'</div>');
            redirect('registrasi');
            }else{
                $nip = $this->input->post("nip");
                $nik = $this->input->post("nik");
                $nama_lengkap = $this->input->post('nama_lengkap');
                $tempat_lahir = @$this->input->post('tempat_lahir');
                $tanggal_lahir = @$this->input->post('tanggal_lahir');
                $alamat         = @$this->input->post('alamat');
                $email = @$this->input->post("email");
                $golongan = @$this->input->post('golongan');
                $fungsional = @$this->input->post('fungsional');
                $pass   = md5($nip);

                $cek_email = $this->db->query("SELECT * FROM karyawan WHERE nip != '$nip' AND email = '$email'")->result();
                if(count($cek_email) > 0){
                    $this->session->set_flashdata('item', "<div class='alert alert-dismissable alert-danger'><button type='button' class='close' data-dismiss='alert'>
                    <font size ='2' color='black'>
                        <strong>x</strong>
                    </font></button><strong><p align='center'>Email Telah Digunakan</button></p></strong></div>");
                    redirect("registrasi");
                }else{

                    $update = array(
                        'nama_lengkap' => $nama_lengkap,
                        'tempat_lahir' => $tempat_lahir,
                        'tanggal_lahir' => $tanggal_lahir,
                        'alamat' => $alamat,
                        'email' => $email
                    );
                    $update_awal = $this->db->update('karyawan',$update,array('nip' => $nip));
                    if($update_awal){
                        $dt = array(
                            'nip' => $nip,
                            'password' => $pass,
                            'is_dupak' => 1,
                            'aktif' => 0,
                            'token' => md5(strtotime(date('Y-m-d H:i:s')))
                        );
                        $this->db->insert('users',$dt);
                        $id_user = $this->db->insert_id();
    
                        $email_arr = array(
                            'to' => $email,
                            'from' => 'admin@siopak.bpsdm.kemendagri.go.id',
                            'view' => 'email_validasi',
                            'title' => 'Validasi akun anda',
                            'data' => array(
                            'data' => $this->db->get_where('users',array('id_user' =>  $id_user))->row(),
                            'karyawan' => $this->karyawan->detail($nip)
                            )
                        );
    
                        sendmail($email_arr);
    
    
                        $this->session->set_flashdata('item', "<div class='alert alert-dismissable alert-info'><button type='button' class='close' data-dismiss='alert'>
                        <font size ='2' color='black'>
                            <strong>x</strong>
                        </font></button><strong><p align='center'>Akun berhasil dibuat ,silahkan cek email untuk validasi akun anda</button></p></strong></div>");
                        redirect("login");
    
                    }

                }
             


            }
        }

        function prosesregisterajax(){
            $this->load->library('form_validation');
            $this->form_validation->set_error_delimiters("<div class='alert alert-dismissable alert-danger'><button type='button' class='close' data-dismiss='alert'>x</button>", "</button></div>");
            // $this->form_validation->set_rules('nip', 'Nip', 'required|min_length[9]|max_length[9]|numeric|is_unique[users.nip]');
            $this->form_validation->set_rules('nik', 'Nik', 'required|min_length[16]|max_length[16]|numeric');
            // // $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[karyawan.email]');
            // $this->form_validation->set_rules('nama_lengkap', 'Nama', 'required');
            if($this->form_validation->run() == FALSE){
                $array = array(
                    'error'   => true
                   );
                echo json_encode($array);

            }else{
                $nip = $this->input->post("nip");
                $nik = $this->input->post("nik");
                $nama_lengkap = $this->input->post('nama_lengkap');
                $tempat_lahir = @$this->input->post('tempat_lahir');
                $tanggal_lahir = @$this->input->post('tanggal_lahir');
                $alamat         = @$this->input->post('alamat');
                $email = @$this->input->post("email");
                $golongan = @$this->input->post('golongan');
                $fungsional = @$this->input->post('fungsional');
                $pass   = md5($nip);
$qq ="SELECT * FROM karyawan WHERE nip != '$nip' AND email = '$email'";
// echo $qq;
// exit;
                $cek_email = $this->db->query($qq)->num_rows();
                if($cek_email > 0){
                    $array = array(
                        'error'   => true,
                        'email_error' => 'Email Telah Digunakan'
                       );
                    echo json_encode($array);
                }else{

                    $update = array(
                        'nama_lengkap' => $nama_lengkap,
                        'tempat_lahir' => $tempat_lahir,
                        'tanggal_lahir' => $tanggal_lahir,
                        'alamat' => $alamat,
                        'email' => $email
                    );
                    $update_awal = $this->db->update('karyawan',$update,array('nip' => $nip));
                    if($update_awal){
                        $dt = array(
                            'nip' => $nip,
                            'password' => $pass,
                            'is_dupak' => 1,
                            'aktif' => 0,
                            'token' => md5(strtotime(date('Y-m-d H:i:s')))
                        );
                        $this->db->insert('users',$dt);
                        $id_user = $this->db->insert_id();
    
                        $email_arr = array(
                            'to' => $email,
                            'from' => 'admin@siopak.bpsdm.kemendagri.go.id',
                            'view' => 'email_validasi',
                            'title' => 'Validasi akun anda',
                            'data' => array(
                            'data' => $this->db->get_where('users',array('id_user' =>  $id_user))->row(),
                            'karyawan' => $this->karyawan->detail($nip)
                            )
                        );
                        sendmail($email_arr);
                        $this->session->set_flashdata('item', "<div class='alert alert-dismissable alert-info'><button type='button' class='close' data-dismiss='alert'>
                        <font size ='2' color='black'>
                            <strong>x</strong>
                        </font></button><strong><p align='center'>Akun berhasil dibuat ,silahkan cek email untuk validasi akun anda</button></p></strong></div>");
                        $dataa = array('success' => true, 'msg'=> 'Form has been submitted successfully');
                        echo json_encode($dataa);
                    }

                }
             


            }
        }

       

function sendimel($id){
    $data['data'] = $this->db->get_where('users',array('id_user' =>  $id))->row();
    $data['karyawan'] = $this->karyawan->detail($data['data']->nip);
    $this->load->view('email_validasi',$data);
}



    }//end class