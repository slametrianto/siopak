<?php   


    class Biodata extends CI_Controller {

        function __construct()
        {
            parent::__construct();
            $this->load->model('Biodata_model','model');
            $this->load->model('Karyawan_model','karyawan');
             $this->load->model('Management_user_model', 'user_m');

        }


        function index(){
            $data['title'] ='Data Diri Jabfung';
            $nip = $this->session->userdata('nip');
            $data['unitkerja'] = $this->db->get('master_instansi')->result();
            $data['fungsional'] = $this->db->get('master_tipefungsional')->result();
            $data['dokumen'] = $this->karyawan->dokumen();
            $data['dokumenjabfung'] = $this->karyawan->dokumen_jabfung($nip);
            $data['pendidikan'] = $this->karyawan->pendidikan();
            $data['data']     = $this->karyawan->detail($nip);
            $data['template'] = 'pages/biodata/index';  
            $data['user'] = $this->db->get_where('users',array('nip' => $nip))->row();

            $this->load->view('dashboard',$data);

        }

        function update()
        {
            $data['template'] = 'pages/biodata/index';  
            $this->load->view('dashboard',$data);

            $id             = $this->input->post('id_karyawan');
            $nip            = $this->input->post('nip');
            $nik            = $this->input->post('nik');
            $nama_lengkap   = $this->input->post('nama_lengkap');
            $tempat_lahir   = $this->input->post('tempat_lahir');
            $tanggal_lahir = $this->input->post('tanggal_lahir');
            $alamat         = $this->input->post('alamat');
            $email          = $this->input->post('email');
            $no_telp        = $this->input->post('no_telp');
            $id_tipe_fungsional     = $this->input->post('fungsional');
            $id_jenjang         = $this->input->post('id_jenjang');
            $id_golongan        = $this->input->post('id_golongan');
            $id_instansi        = $this->input->post('id_instansi');
            $masa_kerja_lama     = $this->input->post('masa_kerja_lama');
            $masa_kerja_baru    = $this->input->post('masa_kerja_baru');
            $tmt_jabatan        = $this->input->post('tmt_jabatan');
            $jenis_kelamin       = $this->input->post('jenis_kelamin');
            $ak_lama0       = $this->input->post('ak_lama0');
            

            $no_seri_karpeg = $this->input->post('no_seri_karpeg');
            $pendidikan_terakhir = $this->input->post('pendidikan_terakhir');


            $nip_session = $this->session->userdata('nip');

            $data_arr = array('nama_lengkap' => $nama_lengkap,
                               'tempat_lahir' => $tempat_lahir,
                               'tanggal_lahir' => $tanggal_lahir,
                               'alamat'        => $alamat,
                               'email'         => $email,
                               'no_telp'       => $no_telp,
                               'id_golongan'   => $id_golongan,
                               'no_seri_karpeg'   => $no_seri_karpeg,
                               'jenis_kelamin' => $jenis_kelamin,
                                'pendidikan_terakhir' => $pendidikan_terakhir,
                                'id_instansi'   => $id_instansi,
                                'masa_kerja_lama'   => $masa_kerja_lama,
                                'masa_kerja_baru'   => $masa_kerja_baru,
                                'tmt_jabatan'   => $tmt_jabatan, 
                                'ak_lama0'   => $ak_lama0
                                );
            $where = array('nip' => $nip_session);

            $this->user_m->update_data($where, $data_arr, 'karyawan');
            $this->session->set_flashdata('message', "<div class='alert alert-dismissable alert-info'><button type='button' class='close' data-dismiss='alert'>
                                            <font size ='2' color='black'>
                                                <strong>x</strong>
                                            </font></button><strong><p align='center'>Data berhasil disimpan</button></p></strong></div>");
            redirect('biodata');

        }

        function upload(){
            $files = $_FILES;

            $config['upload_path']      = './dokumenjabfung/'; 
            $config['allowed_types']    = '*';
            $config['max_size']         = '4096'; // max_size in kb
            $config['file_name']        = strtotime(date('Y-m-d H:i:s')).rand();

            //Load upload library
            $this->load->library('upload',$config); 
        
            foreach($files as $k => $v){
               if($files[$k]['name'] == ''){
                   //echo "gagal";
                  // echo "id ".$k." tidak ada ";
               }else{

                $_FILES[$k]['name']= $files[$k]['name'];
                $_FILES[$k]['type']= $files[$k]['type'];
                $_FILES[$k]['tmp_name']= $files[$k]['tmp_name'];
                $_FILES[$k]['error']= $files[$k]['error'];
                $_FILES[$k]['size']= $files[$k]['size'];    
        
                if($this->upload->do_upload($k)){
                    $this->db->delete('karyawan_dokumen',array('nip' => $_SESSION['nip'],'id_dokumen' => $k));
                    $upl = $this->upload->data();

                    // print_r($upl);
                    // exit;
                    $ins_arr = array(
                        'nip'       => $_SESSION['nip'],
                        'id_dokumen' => $k,
                        'file_dokumen' => $upl['file_name'],
                        'created_by' => $_SESSION['nama_lengkap'],
                        'created_date' => date('Y-m-d H:i:s')
                    );

                    $ins2 = $this->db->insert('karyawan_dokumen',$ins_arr);

                }else{
                    print_r($this->upload->display_errors());
                    exit;
                }
                
                }

              
                

            }

           // exit;

            alert("Aksi berhasil dilakukan","info");
            redirect('biodata');

        }


        public function update_photo()
        {
            if ($this->input->post()) {
            $nip = $this->input->post('nip');
    
            $whereid = array('nip' => $nip);
    
            $config['upload_path'] = './assets/foto_user/';
            $config['allowed_types'] = 'jpg|png|gif|jpeg';
            $config['file_name']        = $nip.'-'.date('dmy');
            $this->load->library('upload', $config);
    
            if (@$_FILES['photo']['name'] != null) {
                $this->upload->do_upload('photo');
    
                $gambar = $this->model->detail_user($nip);
                if ($gambar->photo != null) {
                    $target_file = './assets/foto_user/'.$gambar->photo;
    
                    unlink($target_file);
                }
    
                    $data['photo'] = $this->upload->data('file_name');
                    $_SESSION['photo'] = $data['photo'];
                    $this->model->update_foto($whereid, $data);
                    $this->session->set_flashdata('message', "<div class='alert alert-dismissable alert-info'><button type='button' class='close' data-dismiss='alert'>
                                                <font size ='2' color='black'>
                                                    <strong>x</strong>
                                                </font></button><strong><p align='center'>Photo berhasil disimpan</button></p></strong></div>");
                redirect('biodata'); 
    
                }
            
            }
    
        }
    

    }