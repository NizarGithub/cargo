<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Jasa_m extends CI_Model
{
	function __construct() {
		  parent::__construct();
		  $this->load->database();
	}

	function lihat_data_jasa()
	{
		$sql = "SELECT * FROM master_jasa ORDER BY id_jasa desc";

		return $this->db->query($sql)->result();
	}

	function data_jasa_id($id)
	{
		$sql = "
			SELECT * FROM master_jasa
			WHERE id_jasa = '$id' 
		";
		$query = $this->db->query($sql);
		return $query->row();
	}

	function lihat_data_satuan()
	{
		$sql = "
			SELECT * FROM master_satuan ";

		return $this->db->query($sql)->result();
	}

	function simpan_data_jasa($nama_jasa,$biaya)
	{
		$sql = "
			INSERT INTO master_jasa (
				nama_jasa,
				biaya
			) VALUES (
				'$nama_jasa',
				'$biaya'
			)";
		$this->db->query($sql);
	}

	function ubah_data_jasa($id,$nama_jasa,$biaya)
	{
		$sql = "
			UPDATE master_jasa SET
				nama_jasa    = '$nama_jasa',
				biaya      = '$biaya'
			WHERE id_jasa  = '$id'
		";
		$this->db->query($sql);
	}

	function hapus_jasa($id)
	{
		$sql = "DELETE FROM master_jasa WHERE id_jasa = '$id' " ;
		$this->db->query($sql);
	}

}
