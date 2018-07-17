<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Jasa_c extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('jasa_m','barang');
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
			'title' 	      => 'Master Jasa',
			'page'  	      => 'jasa_v',
			'sub_menu' 	      => 'Master Data',
			'sub_menu1'	      => 'Master Jasa',
			'menu' 	   	      => 'master_data',
			'menu2'		      => 'jasa',
			'lihat_data'      => $this->barang->lihat_data_jasa(),
			'url_simpan' 	  => base_url().'jasa_c/simpan',
			'url_hapus'  	  => base_url().'jasa_c/hapus',
			'url_ubah'	 	  => base_url().'jasa_c/ubah',
		);
		
		$this->load->view('home_v',$data);
	}

	function simpan()
	{
		$nama_jasa 	= $this->input->post('nama_jasa');
		$biaya_jasa = $this->input->post('biaya_jasa');
		$biaya_jasa = str_replace(',', '', $biaya_jasa);

		$this->barang->simpan_data_jasa($nama_jasa,$biaya_jasa);

		$this->session->set_flashdata('sukses','1');
		redirect('jasa_c');
	}

	function ubah()
	{
		$id 		     = $this->input->post('id_jasa_modal');
		$nama_jasa_ubah  = $this->input->post('nama_jasa_ubah');
		$biaya_ubah      = $this->input->post('biaya_ubah');
		$biaya_ubah      = str_replace(',', '', $biaya_ubah);
		
		$this->barang->ubah_data_jasa($id,$nama_jasa_ubah,$biaya_ubah);
		
		$this->session->set_flashdata('sukses','1');
		redirect('jasa_c');
	}

	function hapus()
	{
		$id = $this->input->post('id_hapus');
		$this->barang->hapus_jasa($id);
		$this->session->set_flashdata('hapus','1');
		redirect('jasa_c');
	}

	function data_jasa_id()
	{
		$id = $this->input->post('id');
		$data = $this->barang->data_jasa_id($id);
		echo json_encode($data);
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */