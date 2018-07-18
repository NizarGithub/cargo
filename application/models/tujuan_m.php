<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tujuan_m extends CI_Model
{
	function __construct() {
		  parent::__construct();
		  $this->load->database();
	}

	function lihat_data_rute()
	{
		$sql = "SELECT * FROM master_rute ORDER BY id_rute desc";

		return $this->db->query($sql)->result();
	}

	function data_rute_id($id)
	{
		$sql = "
			SELECT * FROM master_rute
			WHERE id_rute = '$id' 
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

	function simpan_data_rute($asal,$tujuan_prov,$tujuan_kota,$biaya)
	{
		$sql = "
			INSERT INTO master_rute (
				asal,
				tujuan_provinsi,
				tujuan,
				biaya
			) VALUES (
				'$asal',
				'$tujuan_prov',
				'$tujuan_kota',
				'$biaya'
			)";
		$this->db->query($sql);
	}

	function ubah_data_rute($id,$e_asal,$e_tujuan_prov,$e_tujuan_kota,$e_biaya)
	{
		$sql = "
			UPDATE master_rute SET
				asal = '$e_asal',
				tujuan_provinsi = '$e_tujuan_prov',
				tujuan  = '$e_tujuan_kota',
				biaya  = '$e_biaya'
			WHERE id_rute  = '$id'
		";
		$this->db->query($sql);
	}

	function hapus_rute($id)
	{
		$sql = "DELETE FROM master_rute WHERE id_rute = '$id' " ;
		$this->db->query($sql);
	}

}
