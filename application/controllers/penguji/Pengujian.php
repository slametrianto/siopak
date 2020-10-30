<?php 
    ini_set("display_errors",0);
    class Pengujian extends CI_Controller {
        function __construct()
        {
            parent::__construct();
            $this->load->model('Pengujian_model','model');
            $this->load->model('Dupak_model','dupak');
            $this->load->model('Master_kegiatan_model','kegiatan');
            $this->load->model('Master_unsur_model','unsur');
            $this->load->model('Master_subunsur_model','subunsur');
            is_penguji();
        }

        function hitung($id){
            $this->load->library('hitungdupak',['id'=>$id]);
            if ($this->hitungdupak->Rspegawai->pendidikan_terakhir == "") {
                $this->session->set_flashdata('item','<div class="alert alert-danger">Error ..., Pendidikan belum diisi !!! </div>');
                redirect('penguji/pengujian/detail/'.$this->hitungdupak->Rspegawai->nip);
            }
            $_point_layak = $this->hitungdupak->Kelulusan();

            $data['data'] = $_point_layak;
            $data['template'] = 'penguji/pages/pengujian/hitung';
            $this->load->view('penguji/dashboard',$data);
        }        
        function detail($id){
            $tahun = date('Y');
            $data['data'] = $this->model->detail($id);
            $data['file'] = $this->model->get_file($id);
            $data['dupak'] = $this->dupak->list_dupak($id,$tahun);
            $data['template'] = 'penguji/pages/pengujian/detail';
            $this->load->view('penguji/dashboard',$data);

        }

        function cetak($nip = 0){

           //ini_set('memory_limit', '-1');
            $this->load->library('pdf');
            $data = [];
            $tahun = date('Y');
             $nip = $this->uri->segment(4);
            $data['data'] = $this->model->detail($nip);
            // $data['file'] = $this->model->get_file($id);
            $data['utama'] = $this->dupak->list_dupak_type($nip,$tahun,"UNSUR UTAMA");
            $data['penunjang'] = $this->dupak->list_dupak_type($nip,$tahun,"UNSUR PENUNJANG");
            $data['pejabat'] = get_pejabat();
           
            $layak = $this->input->post('layak');
            $cek_status_pak = $this->db->query("select * from status_layak where nip=$nip and tahun=$tahun order by id_status desc limit 1")->result_array();
                if(count($cek_status_pak) == 0 ){
                        $param = array('nip' =>$nip,
                            'layak' => $layak,
                            'tahun' => $tahun);
            $insert_status = $this->db->insert("status_layak",$param);
             }else{
                $param_status = $cek_status_pak['layak'];
            if($param_status == $layak){
            }else{
            if($this->input->post('layak') ==  ''){
                $layak = $param_status ;
            }
            $update_status_pak= $this->db->query("update status_layak set layak=$layak where nip=$nip"); 
             }
            }
            $data['footer'] = $this->db->select("*")->from("karyawan")->where('nip',$nip)->get()->result();
            $data['status_layak'] = $this->db->query("select * from status_layak where nip=$nip and tahun=$tahun order by id_status desc limit 1")->result_array();
            $this->pdf->setPaper('Legal', 'potrait');
            $this->pdf->filename = "PAK_DUPAK_".$nip.".pdf";
            $this->pdf->load_view('cetakpak', $data);
        }


        function index(){

            $tahun = date('Y');
            $this->load->library('pagination');
            $config['base_url'] = base_url().'penguji/pengujian/index/';
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

            
            $data['template'] = 'penguji/pages/pengujian/index';

            $this->load->view('penguji/dashboard',$data);

        }


        function detaildupak($id){

            $data['data'] = $this->dupak->detaildupak($id);

            // print_r($data['data']);
            // exit;
            $data['file'] = $this->dupak->get_file($id);
            $data['template'] = 'penguji/pages/pengujian/detaildupak';
            $this->load->view('penguji/dashboard',$data);

        }

        function approval(){

                $type = $this->input->post('type');
                $id_dupak  =$this->input->post('id_dupak');
                $nip = $this->input->post('nip');

                if($type == 'approve'){
                    $id_status = 5;
                    $upd = $this->db->update('dupak',array('id_status' => $id_status),array('id_dupak' => $id_dupak));

                }else{
                    $komentar = $this->input->post('komentar');
                    $id_status = 98;
                    $upd = $this->db->update('dupak',array('id_status' => $id_status,'komentar_penguji' => $komentar),array('id_dupak' => $id_dupak));

                }
                $tahun = date('Y');
                $cek = $this->dupak->list_dupak($nip,$tahun);
                $total_blm = 0;
                $total_nilai = 0;
                foreach($cek as $k => $v){
                    if($v->id_status == 4){
                        $total_blm = $total_blm + 1;
                    }else if($v->id_status == 5){
                        $total_nilai = $total_nilai + $v->angka_kredit;
                    }
                }

                $karyawan = $this->db->get_where('karyawan',array('nip' => $nip))->row();
                if($total_blm == 0){
                    
                    // $cek_nilai = $this->db->get_where('ref_kelulusan',array('id_golongan' => $karyawan->id_golongan))->row();
                    // $nilai_min = $cek_nilai->nilai_min;
                    // if($total_nilai >= $nilai_min){
                        $update =$this->db->update('penilaian',array('status' => 5,'total_nilai' => $total_nilai),array('nip' => $nip,'tahun' => $tahun));

                    // }else{
                    //     $update =$this->db->update('penilaian',array('status' => 6),array('nip' => $nip,'tahun' => $tahun));

                    // }

                }


                if($upd){
                    echo json_encode(array("status" => TRUE,"message" => "Data DUPAK Berhasil di ".$type));
                }



        }


        function kirim(){
            
            $nip = $this->input->post('nip');
            // echo $nip;
            $tahun = date('Y');
            $dt = array(
                'id_status' => 4
            );

            $update = $this->db->update('dupak',$dt,array('nip' => $nip,'tahun' => date('Y')));
            if($update){
                // echo $nip;
                $penguji = $this->db->get_where('penguji_jabfung',array('nip_jabfung' => $nip))->row();

                $dt = array(
                    'nip_penguji' => $penguji->nip_penguji,
                    'status' => 2
                );

                $this->db->update('penilaian',$dt,array('nip' => $nip,'tahun' => $tahun));


            }

            echo json_encode(array("status" => TRUE,"message" => "Data DUPAK Berhasil di Kirim"));


        }



        function rekomendasi(){

            
            $id_penilaian = $this->input->post('id_penilaian');
            $rekomendasi = $this->input->post('rekomendasi');
            $nip        = $this->input->post('nip');

            $dt = array(
                'status' => $rekomendasi,
                'tanggal_keputusan' => date('Y-m-d')
            );

            $a = $this->db->update('penilaian',$dt,array('id_penilaian' => $id_penilaian));
            if($a){
                $this->session->set_flashdata('item', "<div class='alert alert-dismissable alert-info'><button type='button' class='close' data-dismiss='alert'>
                <font size ='2' color='black'>
                    <strong>x</strong>
                </font></button><strong><p align='center'>Rekomendasi berhasil dilakukan, Terimakasih </button></p></strong></div>");
                
                redirect("penguji/pengujian/detail/".$nip);
            }


        }

        



    }
