<?php 

    class Dupaklama extends CI_Controller {
        

        function __construct()
        {
            parent::__construct();
            $this->load->model('Dupaklama_model','model');
            $this->load->model('Karyawan_model','karyawan');
            $this->load->model('Master_kegiatan_model','kegiatan');
            $this->load->model('Master_unsur_model','unsur');
            $this->load->model('Master_subunsur_model','subunsur');
            
        }

        


        function index(){
            $data["kegiatan"] = $this->model->nilai();
            if(count($data['kegiatan']) == 0){
            $data["kegiatan"] = $this->model->getAllDupak();
            $data['tahun'] = '';
            $data['file'] = '';
            }else{
                $data['tahun'] = $data['kegiatan'][0]->tahun;
                $data['file'] = $this->model->get_files();
            }

            // print_r($data['file']);
            // exit;
            // echo $data['tahun'];
            // exit;

            $tahun = date('Y');
            $data['title'] = 'Form Pengisian PAK  Sebelumnya ';

            
            $data['template'] = 'pages/dupaklama/index';

            $this->load->view('dashboard',$data);

        }

        function add(){

            // print_r($_SESSION);
            // exit;

            $data['template'] = 'pages/dupaklama/add';
            $data['title'] = 'Form Tambah SPT Sebelumnya';
            $data["kegiatan"] = $this->kegiatan->getAllDupak();
           // print_r($this->db->last_query())
            $this->load->view('dashboard',$data);
        }


        function edit($id){
            $data['data'] = $this->model->detail($id);
            $data['file'] = $this->model->get_file($id);
            $data['template'] = 'pages/dupaklama/edit';
            $data['title'] = 'Form Edit SPT Sebelumnya';
            $data["kegiatan"] = $this->kegiatan->getAllDupak();
           // print_r($this->db->last_query())
            $this->load->view('dashboard',$data);
        }

        function detail($id){
            $data['title'] = 'Detail SPT';

            $data['data'] = $this->model->detail($id);
            $data['file'] = $this->model->get_file($id);
            $data['template'] = 'pages/dupak/detail';
            $this->load->view('dashboard',$data);

        }


        function getsubunsur(){

            $id_unsur = $this->input->post('id_unsur');
            $subunsur = $this->subunsur->get_by_unsur($id_unsur);
            echo "<option value=''>Pilih Sub Unsur </option>";
            foreach($subunsur as $k => $v){
                echo "<option value='".$v->id_subunsur."'>".$v->nama_subunsur."</option>";
            }

        }

        function getkegiatan(){

            $id_subunsur = $this->input->post('id_subunsur');
            $kegiatan = $this->kegiatan->get_by_subunsur($id_subunsur);
            // echo "<option value=''>Pilih Kegiatan </option>";
            foreach($kegiatan as $k => $v){
                if($v->parent_id == NULL OR $v->parent_id == 0){

                    if($v->kode_kegiatan == ''){
                    echo '<optgroup label="'.$v->nama_kegiatan.'">';
                    $parent_id = $v->id_kegiatan;
                    }else{
                        echo "<option value='".$v->id_kegiatan."'>".$v->nama_kegiatan."</option>";

                    }
                }

                if($v->parent_id == $parent_id){
                    echo "<option value='".$v->id_kegiatan."'>".$v->nama_kegiatan."</option>";
                }else{
                    echo "</optgroup>";
                }

            }

        }

        function proses(){
            // echo "<pre>";
           // print_r($_POST);
            
            if($this->input->post()){
                $nip    = $_SESSION['nip'];
                $tahun = $this->input->post('tahun');
                $ak_periode_sebelumnya = $this->input->post('ak_periode_sebelumnya');
                $kegiatan = $this->input->post('kode_kegiatan');
                $data = [];
                foreach($ak_periode_sebelumnya as $k => $v){

                    // if($v != ''){
                        $data[] = array(
                            'tahun' => $tahun,
                            'ak_lama_jafung' => $v,
                            'ak_lama_admin' => $v,
                            'nip'   => $_SESSION['nip'],
                            'kode_kegiatan' => $kegiatan[$k]
                        );
                        
                 //   }

                }
                //     echo "<pre>";
                // print_r($data);
                // echo "</pre>";
                $delete = $this->db->delete('ak_lama_pegawai',array('nip' => $nip));
                $insert = $this->db->insert_batch('ak_lama_pegawai',$data);
                if($insert){

                    if(!empty($_FILES['file_pak']['name'])){
                        // Set preference
                        $config['upload_path']      = './file_pak/'; 
                        $config['allowed_types']    = '*';
                        $config['max_size']         = '4096'; // max_size in kb
                        $config['file_name']        = "PAK_PEGAWAI_SEBELUMNYA_".$tahun."_".$_SESSION['nip'];
        
                        //Load upload library
                        $this->load->library('upload',$config); 
                        if($this->upload->do_upload('file_pak')){
                        $dt = $this->upload->data();
                        $file_pak =  $dt['file_name'];  
                        $uploadfile['file_bukti	'] = $file_pak;          
                        }else{
                        }
                      }

                      $uploadfile['nip'] = $_SESSION['nip'];
                      $uploadfile['tahun'] = $tahun;
                      $this->db->delete('ak_lama_file',array('nip' =>$nip));
                      $this->db->insert('ak_lama_file',$uploadfile);

                     alert("Data PAK Lama berhasil di masukan, menunggu verifikasi admin","success");
                    redirect('dupaklama');
                }

            

            }else{

                redirect('https://google.com');
            }

        }

        



    }