<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Barang_c extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('barang_m','barang');
		$this->load->helper(array('form', 'url'));
		$data = $this->session->userdata('sign_in');
        $nama = $data['id'];

        if($nama == "" || $nama == null){
        	redirect('login_c','refresh');
        }
	}

	public function index()
	{
		$data = array(
			'title' 	      => 'Master Barang',
			'page'  	      => 'barang_v',
			'sub_menu' 	      => 'Master Data',
			'sub_menu1'	      => 'Master Barang',
			'menu' 	   	      => 'master_data',
			'menu2'		      => 'Master Barang',
			'lihat_data'      => $this->barang->lihat_data_barang(),
			'lihat_satuan'    => $this->barang->lihat_data_satuan(),
			'url_simpan' 	  => base_url().'barang_c/simpan',
			'url_hapus'  	  => base_url().'barang_c/hapus',
			'url_ubah'	 	  => base_url().'barang_c/ubah',
		);
		
		$this->load->view('home_v',$data);
	}

	function simpan()
	{
		$nama_barang 	= $this->input->post('nama_barang');
		$jumlah 		= '0';
		$id_satuan   	= $this->input->post('id_satuan');
		$harga_total  	= '0';

		$this->barang->simpan_data_barang($nama_barang,$jumlah,$id_satuan,$harga_total);

		$this->session->set_flashdata('sukses','1');
		redirect('barang_c');
	}

	function ubah()
	{
		$id 		  = $this->input->post('id_barang_modal');
		$nama_barang  = $this->input->post('nama_barang_ubah');
		// $jumlah  	  = str_replace(',', '', $this->input->post('jumlah_ubah'));
		$id_satuan 	  = '';
		// $harga_total  = str_replace(',', '', $this->input->post('harga_total_ubah'));

		if($this->input->post('ubah_satuan')){
			$id_satuan = $this->input->post('pilih_satuan');
		}else{
			$id_satuan = $this->input->post('id_satuan_ubah');
		}
		
		$this->barang->ubah_data_barang($id,$nama_barang,$id_satuan);
		
		$this->session->set_flashdata('sukses','1');
		redirect('barang_c');
	}

	function hapus()
	{
		$id = $this->input->post('id_hapus');
		$this->barang->hapus_barang($id);
		$this->session->set_flashdata('hapus','1');
		redirect('barang_c');
	}

	function data_barang_id()
	{
		$id = $this->input->post('id');
		$data = $this->barang->data_barang_id($id);
		echo json_encode($data);
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */