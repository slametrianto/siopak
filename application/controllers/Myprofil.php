<?php 

/**
 * 
 */
class Myprofil extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('Myprofil_model', 'my_profil');
		
	}
	
	public function index()
	{

		$nip = $this->session->userdata('nip');

		$data['data'] = $this->my_profil->detail($nip);
		$data['user'] = $this->my_profil->detail_user($nip);
		$data['data_fungsional'] = $this->my_profil->tampil_data_fungsional();
        $data['data_golongan'] = $this->my_profil->data_golongan();
		$data['template'] = 'pages/myprofil';
		$this->load->view('dashboard', $data);


	}

	public function update()
	{
		if ($this->input->post()) {
		$nip = $this->input->post('nip');

		$whereid = array('nip' => $nip);

		$config['upload_path'] = './assets/foto_user/';
		$config['allowed_types'] = 'jpg|png|gif|jpeg';
		$config['file_name'] 		= 'User-'.date('dmy').'-'.substr(md5(rand()), 0,10);
		$this->load->library('upload', $config);

		if (@$_FILES['photo']['name'] != null) {
			$this->upload->do_upload('photo');
				$data['photo'] = $this->upload->data('file_name');
				$this->my_profil->update_data($whereid, $data);
				$this->session->set_flashdata('message', "<div class='alert alert-dismissable alert-info'><button type='button' class='close' data-dismiss='alert'>
                                            <font size ='2' color='black'>
                                                <strong>x</strong>
                                            </font></button><strong><p align='center'>Data berhasil disimpan</button></p></strong></div>");
            redirect('myprofil'); 

			}
		
		}

	}
}

 ?>