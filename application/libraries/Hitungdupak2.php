<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class hitungdupak2 {
	private $CI;
	public $Rspenilaian;
	public $Rspegawai;
	public $Rsrefkelulusangol;
	public $Rsakdupakprev;
	public $Rsakdupaknew;

	public function __construct($Param){
		$this->CI =& get_instance();
	   	$this->CI->load->database();
		$this->Rspenilaian = $this->Table_Penilaian($Param);
		$this->Rspegawai = $this->Karyawan_Info();
		$this->Rsrefkelulusangol = $this->Ref_Kelulusan_Gol();
		$this->Rsakdupakprev = $this->Ak_Dupak_Previous();
		$this->Rsakdupaknew = $this->Ak_Dupak_Baru();
	}

	private function Table_Penilaian($Param) {
		$sql = "select * from penilaian where id_penilaian = '".$Param['id']."'";
		return $this->CI->db->query($sql)->row();
	}

	private function Karyawan_Info() {
		// cari info ttg karyawan : golongan, jafung
		$sql = "select k.nip, k.id_karyawan, k.nama_lengkap, mg.id_golongan, mg.golongan, mg.nama_golongan, 
				mj.id_jenjang, mj.nama_jenjang, mj.id_tipefungsional, k.pendidikan_terakhir, mf.tipe_fungsional, 
				mi.nama_instansi, k.masa_kerja_lama, k.masa_kerja_baru, k.no_seri_karpeg, k.tempat_lahir, k.tanggal_lahir 
				from karyawan k 
				join master_golongan mg on mg.id_golongan = k.id_golongan 
				join master_jenjang mj on mj.id_jenjang = mg.id_jenjang 
				join master_tipefungsional mf on mf.id_tipefungsional = mj.id_tipefungsional 
				join master_instansi mi on mi.id_instansi = k.id_instansi 
				where k.nip = '".$this->Rspenilaian->nip."'";
		return $this->CI->db->query($sql)->row();
	}

	public function Ref_Kelulusan_Gol() {
		$sql = "select angka_min, angka_d_min from ref_kelulusan_golongan where id_golongan1 = '".$this->Rspegawai->id_golongan."' 
				and id_tipefungsional = '".$this->Rspegawai->id_tipefungsional."' and nama_pendidikan = '".$this->Rspegawai->pendidikan_terakhir."' 
				order by angka_min asc limit 1";
		return $this->CI->db->query($sql)->row();
	}

	public function Ak_Dupak_Previous() {
		$sql = "select s.id_subunsur, d.kode_kegiatan, ak_lama_admin as jumlah_ak, 
				u.id_unsur, u.nama_unsur, u.id_utama, s.nama_subunsur 
				from ak_lama_pegawai d 
				join master_kegiatan k on k.kode_kegiatan = d.kode_kegiatan 
				join master_subunsur s on s.id_subunsur = k.id_subunsur 
				join master_unsur u on u.id_unsur = s.id_unsur 
				where d.nip = '".$this->Rspenilaian->nip."' and ak_lama_admin > 0 
				order by s.id_subunsur";
				// echo $sql."<hr>";
		$rsDupakLama = $this->CI->db->query($sql)->result();
		foreach ($rsDupakLama as $_keyd => $_vald) {
			$DupakOld['id0_subunsur_pak'][$_vald->id_subunsur] 	+= $_vald->jumlah_ak;
			$DupakOld['id0_subunsur_unsur_id'][$_vald->id_subunsur] 	= $_vald->id_unsur;
			$DupakOld['id0_unsur_pak'][$_vald->id_unsur] 			+= $_vald->jumlah_ak;
			$DupakOld['id0_utama_pak'][$_vald->id_utama] 			+= $_vald->jumlah_ak;
			$DupakOld['ttl0_pak'] 								+= $_vald->jumlah_ak;
		}
		// print_r($DupakOld);
		return $DupakOld;
	}

	public function Ak_Dupak_Baru() {
		$sql = "select s.id_subunsur, d.kode_kegiatan, (d.angka_kredit * d.bobot_kredit) as jumlah_ak, d.id_dupak, 
				d.nomor_spt, u.id_unsur, u.nama_unsur, u.id_utama, s.nama_subunsur, d.id_status 
				from dupak d 
				join master_kegiatan k on k.kode_kegiatan = d.kode_kegiatan 
				join master_subunsur s on s.id_subunsur = k.id_subunsur 
				join master_unsur u on u.id_unsur = s.id_unsur 
				where d.nip = '".$this->Rspenilaian->nip."'  
				order by s.id_subunsur";
				// echo $sql;
		$rsDupakBaru = $this->CI->db->query($sql)->result();
		foreach ($rsDupakBaru as $_keyd => $_vald) {
			if ($_vald->id_status == 5) {
				//diapprove penguji
				$DupakNew['id5_subunsur_pak'][$_vald->id_subunsur] 	+= $_vald->jumlah_ak;

				$DupakNew['id5_subunsur_unsur_id'][$_vald->id_subunsur] = $_vald->id_unsur;
				// echo $_vald->id_unsur.", ";

				$DupakNew['id5_unsur_pak'][$_vald->id_unsur] 			+= $_vald->jumlah_ak;
				$DupakNew['id5_utama_pak'][$_vald->id_utama] 			+= $_vald->jumlah_ak;
				$DupakNew['ttl5_pak'] 								+= $_vald->jumlah_ak;
			} 
			//diajukan penguji
			$DupakNew['id2_subunsur_pak'][$_vald->id_subunsur] 	+= $_vald->jumlah_ak;
			$DupakNew['id2_unsur_pak'][$_vald->id_unsur] 			+= $_vald->jumlah_ak;
			$DupakNew['id2_utama_pak'][$_vald->id_utama] 			+= $_vald->jumlah_ak;
			$DupakNew['ttl2_pak'] 								+= $_vald->jumlah_ak;
		}
		return $DupakNew;
	}

	private function Lulus_Unsur_Penunjang_20() {
		$_pak_nunjang_20_prev = 0; $_pak_nunjang_20_new = 0;
		$sql = "select * from master_perhitungan 
				where id_tipefungsional = '".$this->Rspegawai->id_tipefungsional."' and id2 = 2";
		$_Master_20 = $this->CI->db->query($sql)->row();
		$_id_unsur_20 = explode(",", $_Master_20->id_subunsur);

		$_Ak_dupak_prev = $this->Rsakdupakprev;	//dupak lama
		foreach ($_Ak_dupak_prev['id0_subunsur_pak'] as $_id_subunsur => $_nilai_pak) {
			if (in_array($_id_subunsur, $_id_unsur_20))	{
				$_pak_nunjang_20_prev += $_nilai_pak;
			}
		}

		$_Ak_dupak_new = $this->Rsakdupaknew;	//dupak baru
		foreach ($_Ak_dupak_new['id5_subunsur_pak'] as $_id_subunsur => $_nilai_pak) {
			if (in_array($_id_subunsur, $_id_unsur_20))	{
				$_pak_nunjang_20_new += $_nilai_pak;
				// echo $_nilai_pak."<hr>";
			}
		}
		$_pak_utama_20_ttl = $_pak_nunjang_20_prev + $_pak_nunjang_20_new;

		$_Ak_min_lulus = $this->Rsrefkelulusangol->angka_min;
		$_Ak_dupak_old = $this->Rspenilaian->ak_lama0;
		$_Ak_diperlukan = ($_Ak_min_lulus - $_Ak_dupak_old) * $_Master_20->persentase / 100;

		if ($_pak_utama_20_ttl >= $_Ak_diperlukan) {
			$_lulus20 = 1;
		} else {
			$_lulus20 = 1;
		}
		return array('status_lulus'=>$_lulus20, 'ak_diperlukan' => $_Ak_diperlukan,
			'pak_nunjang_prev'=>$_pak_nunjang_20_prev, 'pak_nunjang_new'=>$_pak_nunjang_20_new);
	}

	private function Lulus_Unsur_Utama_80() {
		$_pak_utama_80_prev = 0; $_pak_utama_80_new = 0;
		$_pak_ab_80_prev = []; $_pak_ab_80_new = []; 
		$sql = "select * from master_perhitungan 
				where id_tipefungsional = '".$this->Rspegawai->id_tipefungsional."' and id2 = 1";
		$_Master_80 = $this->CI->db->query($sql)->row();
		$_id_unsur_80 = explode(",", $_Master_80->id_subunsur);

		$_Ak_dupak_prev = $this->Rsakdupakprev;	//dupak lama
		foreach ($_Ak_dupak_prev['id0_subunsur_pak'] as $_id_subunsur => $_nilai_pak) {
			if (in_array($_id_subunsur, $_id_unsur_80))	{
				$_pak_utama_80_prev += $_nilai_pak;
				$_pak_ab_80_prev[$_id_subunsur] += $_nilai_pak;
			}
		}

		$_Ak_dupak_new = $this->Rsakdupaknew;	//dupak baru
		foreach ($_Ak_dupak_new['id5_subunsur_pak'] as $_id_subunsur => $_nilai_pak) {
			if (in_array($_id_subunsur, $_id_unsur_80))	{
				$_pak_utama_80_new += $_nilai_pak;
				$_pak_ab_80_new[$_id_subunsur] += $_nilai_pak;
			}
		}
		$_pak_utama_80_ttl = $_pak_utama_80_prev + $_pak_utama_80_new;

		$_Ak_min_lulus = $this->Rsrefkelulusangol->angka_min;
		$_Ak_dupak_old = $this->Rspenilaian->ak_lama0;
		$_Ak_diperlukan = ($_Ak_min_lulus - $_Ak_dupak_old) * $_Master_80->persentase / 100;

		if ($_pak_utama_80_ttl >= $_Ak_diperlukan) {
			$_lulus80 = 1;
		} else {
			$_lulus80 = 0;
		}
		return array('status_lulus'=>$_lulus80, 'pak_min' => $_Ak_min_lulus, 
			'pak_lama' => $_Ak_dupak_old, 'ak_diperlukan' => $_Ak_diperlukan,
			'pak_utama_prev'=>$_pak_utama_80_prev, 'pak_utama_new'=>$_pak_utama_80_new, 
			'pak_ab_80_prev'=>$_pak_ab_80_prev, 'pak_ab_80_new'=>$_pak_ab_80_new, );
	}

	private function Lulus_Unsur_Utama_30() {
		$_pak_utama_30_prev = 0; $_pak_utama_30_new = 0;
		$_pak_cd_30_prev = []; $_pak_cd_30_new = []; 
		$sql = "select * from master_perhitungan 
				where id_tipefungsional = '".$this->Rspegawai->id_tipefungsional."' and id2 = 3";
		$_Master_30 = $this->CI->db->query($sql)->row();
		$_id_unsur_30 = explode(",", $_Master_30->id_subunsur);

		$_Ak_dupak_prev = $this->Rsakdupakprev;	//dupak lama
		foreach ($_Ak_dupak_prev['id0_subunsur_pak'] as $_id_subunsur => $_nilai_pak) {
			if (in_array($_id_subunsur, $_id_unsur_30))	{
				$_id_unsur = $_Ak_dupak_prev['id0_subunsur_unsur_id'][$_id_subunsur];
				$_pak_utama_30_prev += $_nilai_pak;
				$_pak_cd_30_prev[$_id_unsur] += $_nilai_pak;
			}
		}

		$_Ak_dupak_new = $this->Rsakdupaknew;	//dupak baru
		foreach ($_Ak_dupak_new['id5_subunsur_pak'] as $_id_subunsur => $_nilai_pak) {
			if (in_array($_id_subunsur, $_id_unsur_30))	{
				$_id_unsur = $_Ak_dupak_new['id5_subunsur_unsur_id'][$_id_subunsur];
				$_pak_utama_30_new += $_nilai_pak;
				$_pak_cd_30_new[$_id_unsur] += $_nilai_pak;
			}
		}
		$_pak_utama_30_ttl = $_pak_utama_30_prev + $_pak_utama_30_new;

		$_Ak_min_lulus = $this->Rsrefkelulusangol->angka_min;
		$_Ak_dupak_old = $this->Rspenilaian->ak_lama0;
		$_Ak_diperlukan = ($_Ak_min_lulus - $_Ak_dupak_old) * $_Master_30->persentase / 100;

		if ($_pak_utama_30_ttl >= $_Ak_diperlukan) {
			$_lulus30 = 1;
		} else {
			$_lulus30 = 0;
		}
		return array('status_lulus'=>$_lulus30, 'pak_min' => $_Ak_min_lulus, 
			'pak_lama' => $_Ak_dupak_old, 'ak_diperlukan' => $_Ak_diperlukan,
			'pak_utama_prev'=>$_pak_utama_30_prev, 'pak_utama_new'=>$_pak_utama_30_new, 
			'pak_cd_30_prev'=>$_pak_cd_30_prev, 'pak_cd_30_new'=>$_pak_cd_30_new, 
		);
	}

	private function Lulus_Jumlah_AK() {		
		$_Ak_min_lulus = $this->Rsrefkelulusangol->angka_min * 1;
		$_Ak_dupak_old = $this->Rspenilaian->ak_lama0 * 1;
		$_Ak_diperlukan = $_Ak_min_lulus - $_Ak_dupak_old;
		$_Ak_dupak_prev = $this->Rsakdupakprev['ttl0_pak'] * 1;
		$_Ak_dupak_new = $this->Rsakdupaknew['ttl5_pak'] * 1;
		// echo $_Ak_min_lulus. ' <= '. $_Ak_dupak_old. ' + '.$_Ak_dupak_prev. ' + '.$_Ak_dupak_new;
		if (($_Ak_dupak_prev + $_Ak_dupak_new) >= $_Ak_diperlukan) {
			$_lulus_jml_ak = 1;	// cek minimal total AK
		} else {
			$_lulus_jml_ak = 0;
		}
		return array('status_lulus'=>$_lulus_jml_ak, 'pak_min' => $_Ak_min_lulus, 
			'pak_lama' => $_Ak_dupak_old, 'ak_diperlukan' => $_Ak_diperlukan,
			'pak_prev'=>$_Ak_dupak_prev, 'pak_new'=>$_Ak_dupak_new);
	}



	private function Lulus_Pengembangan_Profesi() {
		$_pak_utama_pp_prev = 0; $_pak_utama_pp_new = 0;
		$sql = "select * from master_perhitungan 
				where id_tipefungsional = '".$this->Rspegawai->id_tipefungsional."' and id2 = 4";
		$_Master_Pp = $this->CI->db->query($sql)->row();
		$_id_unsur_pp = explode(",", $_Master_Pp->id_subunsur);

		$_Ak_dupak_prev = $this->Rsakdupakprev;	//dupak lama
		foreach ($_Ak_dupak_prev['id0_subunsur_pak'] as $_id_subunsur => $_nilai_pak) {
			if (in_array($_id_subunsur, $_id_unsur_pp))	{
				$_pak_utama_pp_prev += $_nilai_pak;
			}
		}

		$_Ak_dupak_new = $this->Rsakdupaknew;	//dupak baru
		foreach ($_Ak_dupak_new['id5_subunsur_pak'] as $_id_subunsur => $_nilai_pak) {
			if (in_array($_id_subunsur, $_id_unsur_pp))	{
				$_pak_utama_pp_new += $_nilai_pak;
			}
		}
		$_pak_utama_pp_ttl = $_pak_utama_pp_prev + $_pak_utama_pp_new;

		$_Ak_min_lulus = $this->Rsrefkelulusangol->angka_d_min;

		if ($_pak_utama_pp_ttl >= $_Ak_min_lulus) {
			$_luluspp = 1;
		} else {
			$_luluspp = 0;
		}
		return array('status_lulus'=>$_luluspp, 'pak_min' => $_Ak_min_lulus, 
			'pak_lama' => 0, 'ak_diperlukan' => $_Ak_min_lulus,
			'pak_utama_prev'=>$_pak_utama_pp_prev, 'pak_utama_new'=>$_pak_utama_pp_new);
	}
	
	public function Kelulusan() {
		$point1 = $this->Lulus_Jumlah_AK();
		$point80 = $this->Lulus_Unsur_Utama_80();
		$point30 = $this->Lulus_Unsur_Utama_30();
		$point20 = $this->Lulus_Unsur_Penunjang_20();
		$point4 = $this->Lulus_Pengembangan_Profesi();
		
		$_ArrLayak['tahapan']['min_pak'] = $point1;
		$_ArrLayak['tahapan']['min_80'] = $point80;
		$_ArrLayak['tahapan']['max_20'] = $point20;
		$_ArrLayak['tahapan']['min_30'] = $point30;
		$_ArrLayak['tahapan']['min_pp'] = $point4;
		$_ArrLayak['pegawai'] = $this->Rspegawai;
		$_ArrLayak['penilaian'] = $this->Rspenilaian;

		if ($point1['status_lulus'] == 0 || $point4['status_lulus'] == 0 || $point30['status_lulus'] == 0 || $point80['status_lulus'] == 0) {
			$_ArrLayak['penilaian']->status_lulus =  0;
		} else {
			$_ArrLayak['penilaian']->status_lulus =  1;
		}
		return $_ArrLayak;
	}
}
?>