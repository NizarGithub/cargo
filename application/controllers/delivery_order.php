<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Delivery_order extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('fpdf/HTML2PDF');
		$data = $this->session->userdata('sign_in');
        $nama = $data['id'];

        if($nama == "" || $nama == null){
        	redirect('login_c');
        }
	}

	public function index()
	{
		$data = array(
				'title'    	=> 'Delivery Order',
				'sub_menu' 	=> 'Transaksi',
				'sub_menu1'	=> 'Delivery Order',
				'page' 	   	=> 'delivery_order_v',
				'menu' 	   	=> 'laporan',
				'menu2'		=> '',
			);

		$this->load->view('home_v',$data);
	}

	function get_barang(){
		$keyword = $this->input->get('keyword');
		$where = "1 = 1";
		if($keyword != ''){
			$where = $where." AND a.nama_barang LIKE '%$keyword%'";
		}else{
			$where = $where;
		}
		$sql = "SELECT a.*,b.kode_satuan FROM master_barang a LEFT JOIN master_satuan b ON b.id_satuan = a.id_satuan WHERE $where";
		$qry = $this->db->query($sql);
		$data = $qry->result();

		echo json_encode($data);
	}

	function klik_barang(){
		$id = $this->input->post('id');
		$sql = "SELECT a.*,b.kode_satuan FROM master_barang a LEFT JOIN master_satuan b ON b.id_satuan = a.id_satuan WHERE a.id_barang = '$id'";
		$qry = $this->db->query($sql);
		$data = $qry->row();

		echo json_encode($data);
	}

	function get_tujuan(){
		$keyword = $this->input->get('keyword');
		$where = "1 = 1";
		if($keyword != ''){
			$where = $where." AND (a.asal LIKE '%$keyword%' OR a.tujuan LIKE '%$keyword%')";
		}else{
			$where = $where;
		}
		$sql = "SELECT a.* FROM master_rute a WHERE $where";
		$qry = $this->db->query($sql);
		$data = $qry->result();

		echo json_encode($data);
	}

	function klik_tujuan(){
		$id = $this->input->post('id');
		$sql = "SELECT a.* FROM master_rute a WHERE a.id_rute = '$id'";
		$qry = $this->db->query($sql);
		$data = $qry->row();

		echo json_encode($data);
	}

	function get_pelanggan(){
		$keyword = $this->input->get('keyword');
		$where = "1 = 1";
		if($keyword != ''){
			$where = $where." AND (a.nama_pelanggan LIKE '%$keyword%' OR a.alamat_pelanggan LIKE '%$keyword%')";
		}else{
			$where = $where;
		}
		$sql = "SELECT a.* FROM master_pelanggan a WHERE $where";
		$qry = $this->db->query($sql);
		$data = $qry->result();

		echo json_encode($data);
	}

	function klik_pelanggan(){
		$id = $this->input->post('id');
		$sql = "SELECT a.* FROM master_pelanggan a WHERE a.id_pelanggan = '$id'";
		$qry = $this->db->query($sql);
		$data = $qry->row();

		echo json_encode($data);
	}

	function add_leading_zero($value, $threshold = 4) {
	    return sprintf('%0' . $threshold . 's', $value);
	}

	function nomor_invoice(){
		$keterangan = 'Invoice';

		$sql = "
			SELECT 
				COUNT(*) AS TOTAL 
			FROM nomor 
			WHERE JENIS = '$keterangan'
		";
		$qry = $this->db->query($sql);
		$total = $qry->row()->TOTAL;
		$kode = "";

		//PA-001/IX/28/2016
		if($total == 0){
			$kode = $this->add_leading_zero(1,3);
		}else{
			$s = "SELECT * FROM nomor WHERE JENIS = '$keterangan'";
			$q = $this->db->query($s)->row();
			$next = $q->NEXT+1;
			$kode = $this->add_leading_zero($next,3);
		}

		return $kode;
	}

	function simpan_nomor(){
		$sql_cek = "SELECT COUNT(*) AS TOTAL FROM nomor WHERE JENIS = 'Invoice'";
		$qry_cek = $this->db->query($sql_cek);
		$total = $qry_cek->row()->TOTAL;

		$sql = "SELECT * FROM nomor WHERE JENIS = 'Invoice'";
		$qry = $this->db->query($sql);
		$row = $qry->row();
		$no = $row->NOMOR;

		if($total != 0){
			$next = $no+1;
			$sql = "UPDATE nomor SET NOMOR = '$next' WHERE JENIS = 'Invoice'";
			$this->db->query($sql);
		}else{
			$sql = "INSERT INTO nomor(NOMOR,JENIS) VALUES ('1','Invoice')";
			$this->db->query($sql);
		}
	}

	function simpan_barang($id_do,$id_barang,$berat,$harga,$jumlah){
		$sql = "
			INSERT INTO do_detail(
				ID_DO,
				ID_BARANG,
				BERAT,
				HARGA,
				JUMLAH
			) VALUES (
				'$id_do',
				'$id_barang',
				'$berat',
				'$harga',
				'$jumlah'
			)
		";
		$this->db->query($sql);
	}

	function simpan_jasa($id_do,$id_jasa){
		$sql = "
			INSERT INTO do_jasa(
				ID_DO,
				ID_JASA
			) VALUES (
				'$id_do',
				'$id_jasa'
			)
		";
		$this->db->query($sql);
	}

	function simpan(){
		$nomor_do = $this->input->post('no_do');
		$id_tujuan = $this->input->post('id_tujuan');
		$tgl_do_msk = $this->input->post('tanggal_do');
		$tgl_pengiriman = $this->input->post('tanggal_kirim');
		$id_pelanggan = $this->input->post('id_pelanggan');
		$nomor_invoice = $this->nomor_invoice();
		$tanggal_invoice = date('d-m-Y');

		$sql = "
			INSERT INTO delivery_order(
				NOMOR_DO,
				ID_TUJUAN,
				TGL_DO_MSK,
				TGL_PENGIRIMAN,
				ID_PELANGGAN,
				NOMOR_INVOICE,
				TANGGAL_INVOICE
			) VALUES (
				'$nomor_do',
				'$id_tujuan',
				'$tgl_do_msk',
				'$tgl_pengiriman',
				'$id_pelanggan',
				'$nomor_invoice',
				'$tanggal_invoice'
			)
		";
		$this->db->query($sql);

		$id_do = $this->db->insert_id();

		$id_barang = $this->input->post('id_barang');
		$berat = str_replace(',', '', $this->input->post('berat'));
		$harga = str_replace(',', '', $this->input->post('harga'));
		$jumlah = str_replace(',', '', $this->input->post('jumlah'));

		foreach ($id_barang as $key => $value) {
			$this->simpan_barang($id_do,$value,$berat[$key],$harga[$key],$jumlah[$key]);
		}

		if($this->input->post('jasa')){
			$jasa = $this->input->post('jasa');
			foreach ($jasa as $key => $value) {
				$this->simpan_jasa($id_do,$value);
			}
		}

		$this->simpan_nomor();

		$this->session->set_flashdata('sukses','1');
		redirect('delivery_order');
	}

	function cetak_do($id){
		$sql = "
			SELECT 
				a.*,
				b.nama_pelanggan,
				b.telp,
				c.tujuan
			FROM delivery_order a
			LEFT JOIN master_pelanggan b ON b.id_pelanggan = a.ID_PELANGGAN
			LEFT JOIN master_rute c ON c.id_rute = a.ID_TUJUAN
			WHERE a.ID = '$id'
		";
		$qry = $this->db->query($sql);
		$res = $qry->row();

		$data = array(
			'data' => $res,
			'title' => 'Cetak Invoice',
			'filename' => date('dmY').'_laporan_do'
		);

		$this->load->view('pdf/laporan_do_pdf',$data);
	}

	function cetak_surat_jalan($id){
		$sql = "
			SELECT 
				a.*,
				b.nama_pelanggan,
				b.telp,
				c.tujuan
			FROM delivery_order a
			LEFT JOIN master_pelanggan b ON b.id_pelanggan = a.ID_PELANGGAN
			LEFT JOIN master_rute c ON c.id_rute = a.ID_TUJUAN
			WHERE a.ID = '$id'
		";
		$qry = $this->db->query($sql);
		$res = $qry->row();

		$data = array(
			'data' => $res,
			'title' => 'Surat Jalan',
			'filename' => date('dmY').'_surat_jalan'
		);

		$this->load->view('pdf/surat_jalan_id_pdf',$data);
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */