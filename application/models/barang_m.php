<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Barang_m extends CI_Model
{
	function __construct() {
		  parent::__construct();
		  $this->load->database();
	}

	function lihat_data_barang()
	{
		$sql = "SELECT a.*,b.kode_satuan FROM master_barang a LEFT JOIN master_satuan b ON b.id_satuan = a.id_satuan";

		return $this->db->query($sql)->result();
	}

	function data_barang_id($id)
	{
		$sql = "
			SELECT 
				a.*,
				b.kode_satuan
			FROM master_barang a
			LEFT JOIN master_satuan b ON b.id_satuan = a.id_satuan
			WHERE a.id_barang = '$id' 
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

	function simpan_data_barang($nama_barang,$jumlah,$id_satuan,$harga_total)
	{
		$sql = "
			INSERT INTO master_barang (
				nama_barang,
				jumlah,
				id_satuan,
				harga_total
			) VALUES (
				'$nama_barang',
				'$jumlah',
				'$id_satuan',
				'$harga_total'
			)";
		$this->db->query($sql);
	}

	function ubah_data_barang($id,$nama_barang,$id_satuan,$harga_total)
	{
		$sql = "
			UPDATE master_barang SET
				nama_barang    = '$nama_barang',
				id_satuan      = '$id_satuan'
			WHERE id_barang  = '$id'
		";
		$this->db->query($sql);
	}

	function hapus_barang($id)
	{
		$sql = "DELETE FROM  master_barang WHERE id_barang = '$id' " ;
		$this->db->query($sql);
	}

}
