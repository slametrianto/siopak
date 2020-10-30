<?php 

 
class Management_user_model extends CI_Model
{
	
	public function add($data_arr)
	{
		$this->db->insert('karyawan', $data_arr);
	}
	public function get_data_user($nip)
	{

		$this->db->select('a.nip,b.aktif,b.is_dupak,b.is_penguji,b.is_admin')->from('karyawan a');
		// $this->db->join('users','karyawan.nip = users.id_golongan','left');
		$this->db->join('users b','a.nip= b.nip','left');
		$this->db->where("a.nip='".$nip."'");
		$query = $this->db->get();
		return $query;

	}
	public function edit_data($where, $nip)
	{

		$this->db->from('karyawan');
		// $this->db->join('users','karyawan.nip = users.id_golongan','left');
		$this->db->join('master_golongan','karyawan.id_golongan = master_golongan.id_golongan','left');
		$this->db->join('master_jenjang','master_golongan.id_jenjang = master_jenjang.id_jenjang','left');
		$this->db->join('master_tipefungsional','master_jenjang.id_tipefungsional = master_jenjang.id_tipefungsional','left');
		$this->db->where($where);
		$query = $this->db->get();
		return $query;

	}

	public function update_data($where, $data_arr, $table)
	{
		$this->db->where($where);
		$this->db->update($table, $data_arr);
	}

	public function delete_data($where, $table)
	{
		$this->db->where($where);
		$this->db->delete($table);
	}
}

 ?>