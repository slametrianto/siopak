<?php 

/**
 * 
 */
class Repassword extends CI_Controller
{
	 function __construct()
        {
            parent::__construct();
            $this->load->model('Karyawan_model','karyawan');

        }

	
	function index()
	{

		 $nip = $this->session->userdata('nip');
		 $data['template'] = 'pages/repass';

         $this->load->view('dashboard',$data);
	}

	function ganti_pass()
	{
		//$this->load->library('form_validation');
        
        //$this->form_validation->set_rules('passL', 'Password Lama', 'required');
       // $this->form_validation->set_rules('passB', 'Password Baru', 'required');
        
        //if ($this->form_validation->run() == false) {


        	//$nip = $this->session->userdata('nip');
			//$data['template'] = 'pages/repass';
        	//$this->load->view('dashboard',$data);
        //}else{

		$nip = $this->session->userdata('nip');
		$passL 	= $this->input->post('passL');
		$passB 	= $this->input->post('passB');
		$passB1 	= md5($passB);
		$passL1 	= md5($passL);

		$data_arr  = array('password' => $passB1);
		$where 	 = array('nip' => $nip );

		
		$data = $this->db->get_where('users', array('nip' => $nip));
		

		 foreach ($data->result_array() as $d) {
		 	echo $d['nip']."-".$d['password'];
		 }

		 if ($passL1 != $d['password']) {
		 	 $this->session->set_flashdata('message', "<div class='alert alert-dismissable alert-danger'><button type='button' class='close' data-dismiss='alert'>
                                            <font size ='2' color='black'>
                                                <strong>x</strong>
                                            </font></button><strong><p align='center'>Password  anda salah</button></p></strong></div>");
		 	  redirect('repassword/index');
		 }else{
		 	$this->db->where($where);
		 	$update = $this->db->update('users',$data_arr);
		 	if($update){
		 	 $this->session->set_flashdata('message', "<div class='alert alert-dismissable alert-info'><button type='button' class='close' data-dismiss='alert'>
                                            <font size ='2' color='black'>
                                                <strong>x</strong>
                                            </font></button><strong><p align='center'>Password berhasil diubah</button></p></strong></div>");
		 	}
            redirect('repassword');
        }

		 
		
		

	}

}

 ?>