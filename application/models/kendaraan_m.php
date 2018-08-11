<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Kendaraan_m extends CI_Model
{
	function __construct() {
		  parent::__construct();
		  $this->load->database();
	}

	function lihat_data()
	{
		$sql = "
			SELECT 
				a.*,
				b.tujuan
			FROM master_kendaraan a
			LEFT JOIN master_rute b ON b.id_rute = a.id_rute
			ORDER BY a.id DESC
		";

		return $this->db->query($sql)->result();
	}

	function data_id($id)
	{
		$sql = "
			SELECT 
				a.*,
				b.tujuan
			FROM master_kendaraan a
			LEFT JOIN master_rute b ON b.id_rute = a.id_rute
			WHERE a.id = '$id'
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

	function get_tujuan($keyword){
		$where = "1 = 1";
		if($keyword != ''){
			$where = $where." AND (a.asal LIKE '%$keyword%' OR a.tujuan LIKE '%$keyword%')";
		}else{
			$where = $where;
		}
		$sql = "SELECT a.* FROM master_rute a WHERE $where";
		$qry = $this->db->query($sql);
		$data = $qry->result();

		return $data;
	}

	function get_tujuan_id($id){
		$sql = "SELECT a.* FROM master_rute a WHERE a.id_rute = '$id'";
		$qry = $this->db->query($sql);
		$data = $qry->row();

		return $data;
	}

	function simpan($nama_kendaraan,$id_rute,$biaya)
	{
		$sql = "
			INSERT INTO master_kendaraan (
				nama_kendaraan,
				id_rute,
				biaya
			) VALUES (
				'$nama_kendaraan',
				'$id_rute',
				'$biaya'
			)";
		$this->db->query($sql);
	}

	function ubah($id,$nama_kendaraan,$id_rute,$biaya)
	{
		$sql = "
			UPDATE master_kendaraan SET
				nama_kendaraan = '$nama_kendaraan',
				id_rute = '$id_rute',
				biaya  = '$biaya'
			WHERE id_rute  = '$id'
		";
		$this->db->query($sql);
	}

	function hapus($id)
	{
		$sql = "DELETE FROM master_kendaraan WHERE id = '$id' " ;
		$this->db->query($sql);
	}

}
