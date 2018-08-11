<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Kendaraan_c extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('kendaraan_m','model');
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
			'title' 	      => 'Master Kendaraan',
			'page'  	      => 'kendaraan_v',
			'sub_menu' 	      => 'Master Data',
			'sub_menu1'	      => 'Master Kendaraan',
			'menu' 	   	      => 'master_data',
			'menu2'		      => 'kendaraan',
			'lihat_data'      => $this->model->lihat_data(),
			'url_simpan' 	  => base_url().'kendaraan_c/simpan',
			'url_hapus'  	  => base_url().'kendaraan_c/hapus',
			'url_ubah'	 	  => base_url().'kendaraan_c/ubah',
		);
		
		$this->load->view('home_v',$data);
	}

	function data_id()
	{
		$id = $this->input->post('id');
		$data = $this->model->data_id($id);
		echo json_encode($data);
	}

	function get_tujuan(){
		$keyword = $this->input->get('keyword');
		$data = $this->model->get_tujuan($keyword);
		echo json_encode($data);
	}

	function klik_tujuan(){
		$id = $this->input->post('id');
		$data = $this->model->get_tujuan_id($id);
		echo json_encode($data);
	}

	function simpan()
	{
		$nama_kendaraan = addslashes($this->input->post('kendaraan'));
		$id_rute = $this->input->post('id_tujuan');
		$biaya = $this->input->post('biaya');
		$biaya = str_replace(',', '', $biaya);

		$this->model->simpan($nama_kendaraan,$id_rute,$biaya);

		$this->session->set_flashdata('sukses','1');
		redirect('kendaraan_c');
	}

	function ubah()
	{
		$id = $this->input->post('id_ubah');
		$nama_kendaraan  = addslashes($this->input->post('e_kendaraan'));
		$id_rute = addslashes($this->input->post('e_id_tujuan'));
		$biaya = $this->input->post('e_biaya');
		$biaya = str_replace(',', '', $biaya);
		
		$this->model->ubah($id,$nama_kendaraan,$id_rute,$biaya);
		
		$this->session->set_flashdata('sukses','1');
		redirect('kendaraan_c');
	}

	function hapus()
	{
		$id = $this->input->post('id_hapus');
		$this->barang->hapus($id);
		$this->session->set_flashdata('hapus','1');
		redirect('tujuan_c');
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */