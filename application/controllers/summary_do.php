<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Summary_do extends CI_Controller {

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
				'title'    	=> 'Summary Delivery Order',
				'sub_menu' 	=> 'Laporan',
				'sub_menu1'	=> 'Summary Delivery Order',
				'page' 	   	=> 'summary_do_v',
				'menu' 	   	=> 'laporan',
				'menu2'		=> 'sum_do',
			);

		$this->load->view('home_v',$data);
	}

	function datetostr($var){
		if($var == "01"){
			$var = "Januari";
		} else if($var == "02"){
			$var = "Februari";
		} else if($var == "03"){
			$var = "Maret";
		} else if($var == "04"){
			$var = "April";
		} else if($var == "05"){
			$var = "Mei";
		} else if($var == "06"){
			$var = "Juni";
		} else if($var == "07"){
			$var = "Juli";
		} else if($var == "08"){
			$var = "Agustus";
		} else if($var == "09"){
			$var = "September";
		} else if($var == "10"){
			$var = "Oktober";
		} else if($var == "11"){
			$var = "November";
		} else if($var == "12"){
			$var = "Desember";
		}

		return $var;
	}

	function cetak(){
		$jenis_laporan = $this->input->post('jenis_laporan');
		if($jenis_laporan == 'pdf'){
			$this->cetak_pdf();
		}else{
			$this->cetak_xls();
		}
	}

	function cetak_pdf(){
		$pilih = $this->input->post('pilih');
		$tanggal_awal = $this->input->post('tanggal_awal');
		$tanggal_akhir = $this->input->post('tanggal_akhir');
		$tgl_minggu = $this->input->post('tgl_minggu');
		$tgl_minggu2 = $this->input->post('tgl_minggu2');
		$bulan = $this->input->post('bulan');
		$tahun = $this->input->post('tahun');
		$dt = '';
		$judul = '';

		if($pilih == "Harian"){
			$sql = "
				SELECT 
					a.*,
					b.tujuan 
				FROM delivery_order a
				LEFT JOIN master_rute b ON b.id_rute = a.ID_TUJUAN
				WHERE STR_TO_DATE(a.TGL_DO_MSK, '%d-%c-%Y') <= STR_TO_DATE('$tanggal_akhir' , '%d-%c-%Y') 
				AND STR_TO_DATE(a.TGL_DO_MSK, '%d-%c-%Y') >= STR_TO_DATE('$tanggal_awal' , '%d-%c-%Y')
			";
			$dt = $this->db->query($sql)->result();
			$judul = "tanggal ".$tanggal_awal." s/d ".$tanggal_akhir;
		}else if($pilih == 'Mingguan'){
			$tgl = date('d-m-Y', strtotime('-7 days', strtotime($tgl_minggu)));

			$sql = "
				SELECT 
					a.*,
					b.tujuan 
				FROM delivery_order a
				LEFT JOIN master_rute b ON b.id_rute = a.ID_TUJUAN
				WHERE STR_TO_DATE(a.TGL_DO_MSK, '%d-%c-%Y') <= STR_TO_DATE('$tgl_minggu' , '%d-%c-%Y') 
				AND STR_TO_DATE(a.TGL_DO_MSK, '%d-%c-%Y') >= STR_TO_DATE('$tgl' , '%d-%c-%Y')
			";
			$dt = $this->db->query($sql)->result();
			$judul = "Mingguan dari tanggal ".$tgl." s/d ".$tgl_minggu;
		}else if($pilih == 'Dua Minggu'){
			$tgl = date('d-m-Y', strtotime('-14 days', strtotime($tgl_minggu2)));

			$sql = "
				SELECT 
					a.*,
					b.tujuan 
				FROM delivery_order a
				LEFT JOIN master_rute b ON b.id_rute = a.ID_TUJUAN
				WHERE STR_TO_DATE(a.TGL_DO_MSK, '%d-%c-%Y') <= STR_TO_DATE('$tgl_minggu2' , '%d-%c-%Y') 
				AND STR_TO_DATE(a.TGL_DO_MSK, '%d-%c-%Y') >= STR_TO_DATE('$tgl' , '%d-%c-%Y')
			";
			$dt = $this->db->query($sql)->result();
			$judul = "Dua minggu dari tanggal ".$tgl." s/d ".$tgl_minggu2;
		}else if($pilih == 'Bulanan'){
			$sql = "
				SELECT 
					a.*,
					b.tujuan 
				FROM delivery_order a
				LEFT JOIN master_rute b ON b.id_rute = a.ID_TUJUAN
				WHERE TGL_DO_MSK LIKE '%-$bulan-$tahun%'
			";
			$dt = $this->db->query($sql)->result();
			$judul = "Bulan ".$this->datetostr($bulan)."&nbsp;".$tahun;
		}

		$data = array(
			'title' 		=> 'LAPORAN SUMMARY DELIVERY ORDER',
			'dt'			=> $dt,
			'filename'		=> date('dmY').'_summary_do',
			'judul'			=> $judul
		);

		$this->load->view('pdf/summary_do_pdf',$data);
	}

	function cetak_xls(){
		$pilih = $this->input->post('pilih');
		$tanggal_awal = $this->input->post('tanggal_awal');
		$tanggal_akhir = $this->input->post('tanggal_akhir');
		$tgl_minggu = $this->input->post('tgl_minggu');
		$tgl_minggu2 = $this->input->post('tgl_minggu2');
		$bulan = $this->input->post('bulan');
		$tahun = $this->input->post('tahun');
		$dt = '';
		$judul = '';

		if($pilih == "Harian"){
			$sql = "
				SELECT 
					a.*,
					b.tujuan 
				FROM delivery_order a
				LEFT JOIN master_rute b ON b.id_rute = a.ID_TUJUAN
				WHERE STR_TO_DATE(a.TGL_DO_MSK, '%d-%c-%Y') <= STR_TO_DATE('$tanggal_akhir' , '%d-%c-%Y') 
				AND STR_TO_DATE(a.TGL_DO_MSK, '%d-%c-%Y') >= STR_TO_DATE('$tanggal_awal' , '%d-%c-%Y')
			";
			$dt = $this->db->query($sql)->result();
			$judul = "tanggal ".$tanggal_awal." s/d ".$tanggal_akhir;
		}else if($pilih == 'Mingguan'){
			$tgl = date('d-m-Y', strtotime('-7 days', strtotime($tgl_minggu)));

			$sql = "
				SELECT 
					a.*,
					b.tujuan 
				FROM delivery_order a
				LEFT JOIN master_rute b ON b.id_rute = a.ID_TUJUAN
				WHERE STR_TO_DATE(a.TGL_DO_MSK, '%d-%c-%Y') <= STR_TO_DATE('$tgl_minggu' , '%d-%c-%Y') 
				AND STR_TO_DATE(a.TGL_DO_MSK, '%d-%c-%Y') >= STR_TO_DATE('$tgl' , '%d-%c-%Y')
			";
			$dt = $this->db->query($sql)->result();
			$judul = "Mingguan dari tanggal ".$tgl." s/d ".$tgl_minggu;
		}else if($pilih == 'Dua Minggu'){
			$tgl = date('d-m-Y', strtotime('-14 days', strtotime($tgl_minggu2)));

			$sql = "
				SELECT 
					a.*,
					b.tujuan 
				FROM delivery_order a
				LEFT JOIN master_rute b ON b.id_rute = a.ID_TUJUAN
				WHERE STR_TO_DATE(a.TGL_DO_MSK, '%d-%c-%Y') <= STR_TO_DATE('$tgl_minggu2' , '%d-%c-%Y') 
				AND STR_TO_DATE(a.TGL_DO_MSK, '%d-%c-%Y') >= STR_TO_DATE('$tgl' , '%d-%c-%Y')
			";
			$dt = $this->db->query($sql)->result();
			$judul = "Dua minggu dari tanggal ".$tgl." s/d ".$tgl_minggu2;
		}else if($pilih == 'Bulanan'){
			$sql = "
				SELECT 
					a.*,
					b.tujuan 
				FROM delivery_order a
				LEFT JOIN master_rute b ON b.id_rute = a.ID_TUJUAN
				WHERE TGL_DO_MSK LIKE '%-$bulan-$tahun%'
			";
			$dt = $this->db->query($sql)->result();
			$judul = "Bulan ".$this->datetostr($bulan)."&nbsp;".$tahun;
		}
		
		$data = array(
			'title' 		=> 'LAPORAN SUMMARY DELIVERY ORDER',
			'dt'			=> $dt,
			'filename'		=> date('dmY').'_summary_do',
			'judul'			=> $judul
		);

		$this->load->view('excel/summary_do_xls',$data);
	}

}