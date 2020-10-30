<?php   

    class Biodata_model extends CI_Model {

       


        function detail($nip){

            $this->db->from('karyawan');
            $this->db->join('master_golongan','karyawan.id_golongan = master_golongan.id_golongan','left');
            $this->db->join('master_tipefungsional','karyawan.id_tipefungsional = master_tipefungsional.id_tipefungsional','left');
            $this->db->where('nip',$nip);
            $query = $this->db->get();
            $run = $query->row();
            return $run;

        }

        function detail_user($nip)
        {

            $this->db->from('users');
           
            $this->db->where('nip',$nip);
            $query = $this->db->get();
            $run = $query->row();
            return $run;

        }
        function update_pegawai($whereid, $data, $table)
        {
            $this->db->where($whereid);
            $this->db->update($table, $data);
        }

        function update_foto($whereid, $data)
        {
            $this->db->where($whereid);
            $this->db->update('users', $data);
        }

        public function tampil_data_fungsional()
    {
        return $this->db->select("*")->from('master_tipefungsional')->get()->result_array();
    }
    public function data_golongan()
    {
        return $this->db->select("*")->from('master_golongan')->get()->result_array();
    }

}
