<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tujuan_c extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('tujuan_m','barang');
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
			'title' 	      => 'Master Rute',
			'page'  	      => 'tujuan_v',
			'sub_menu' 	      => 'Master Data',
			'sub_menu1'	      => 'Master Rute',
			'menu' 	   	      => 'master_data',
			'menu2'		      => 'tujuan',
			'lihat_data'      => $this->barang->lihat_data_rute(),
			'url_simpan' 	  => base_url().'tujuan_c/simpan',
			'url_hapus'  	  => base_url().'tujuan_c/hapus',
			'url_ubah'	 	  => base_url().'tujuan_c/ubah',
		);
		
		$this->load->view('home_v',$data);
	}

	function simpan()
	{
		$asal  		 = addslashes($this->input->post('asal'));
		$tujuan_prov   = addslashes($this->input->post('tujuan_prov'));
		$tujuan_kota   = addslashes($this->input->post('tujuan_kota'));
		$biaya      = $this->input->post('biaya');
		$biaya      = str_replace(',', '', $biaya);

		$this->barang->simpan_data_rute($asal,$tujuan_prov,$tujuan_kota,$biaya);

		$this->session->set_flashdata('sukses','1');
		redirect('tujuan_c');
	}

	function ubah()
	{
		$id 		     = $this->input->post('id_rute');
		$e_asal  		 = addslashes($this->input->post('e_asal'));
		$e_tujuan_prov   = addslashes($this->input->post('e_tujuan_prov'));
		$e_tujuan_kota   = addslashes($this->input->post('e_tujuan_kota'));
		$e_biaya      = $this->input->post('e_biaya');
		$e_biaya      = str_replace(',', '', $e_biaya);
		
		$this->barang->ubah_data_rute($id,$e_asal,$e_tujuan_prov,$e_tujuan_kota,$e_biaya);
		
		$this->session->set_flashdata('sukses','1');
		redirect('tujuan_c');
	}

	function hapus()
	{
		$id = $this->input->post('id_hapus');
		$this->barang->hapus_rute($id);
		$this->session->set_flashdata('hapus','1');
		redirect('tujuan_c');
	}

	function data_rute_id()
	{
		$id = $this->input->post('id');
		$data = $this->barang->data_rute_id($id);
		echo json_encode($data);
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */