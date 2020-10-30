<?php 
  
 class Register_model extends CI_Model
 {
 	
 	
 	public function tampil_data_fungsional()
 	{
 		return $this->db->select("*")->from('master_tipefungsional')->get()->result_array();
 	}

 	public function data_golongan()
 	{
 		return $this->db->select("*")->from('master_golongan')->get()->result_array();
 	}

 	public function tampil_data_golongan($id_tipefungsional)
 	{
 		$gol = $this->db->get_where('master_golongan', array('id_tipefungsional' => $id_tipefungsional));

 		foreach ($gol->result_array() as $row) {
 			$tampilkan .= "<option value='".$row['id_golongan']."'>".$row['golongan'].'<span> - </span>'.$row['pangkat']."</option>";
 		}
 		return $tampilkan;
 	}

 	function tambah_user_login($data_user)
 	{
 		$this->db->insert('users', $data_user);
 	}

 	function check_user_exist($nip)
 	{
 		$this->db->get_where('users', array('nip' => $nip))->num_rows();
 	}

 }