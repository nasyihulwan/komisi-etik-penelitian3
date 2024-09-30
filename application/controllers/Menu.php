<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->helper(array('form', 'url'));
		$this->load->model('menu_model');
		$this->load->library('upload');

		// Pastikan pengguna sudah login
		if (!$this->session->userdata('logged_in') == 1) {
			redirect('auth');
		} else {
			redirect('');
		}
	}

	public function sop_request()
	{
		
		$rules = [
			[
				'field' => 'judul',
				'label' => 'judul',
				'rules' => 'required',
				'errors' => [
					'required' => 'Judul tidak boleh kosong!',
				]
			],          
		];
		$this->form_validation->set_rules($rules);
		if ($this->form_validation->run() == FALSE)
		{
			$data['page'] = 'sop';
			$this->load->view('layout/header_menu', $data);
			$this->load->view('menu/sop_request');
			$this->load->view('layout/footer_menu');
		} else {
			$this->sop_process();
		}
	}

	private function sop_process() {
		$judul = $this->input->post('judul');
		$kategori = $this->input->post('kategori');
		$sumber_dana = $this->input->post('sumber_dana');
		$pemberi_hibah = $this->input->post('pemberi_hibah');
		$id_members = $this->session->userdata('id_members'); 
		// echo "id member = $id_members";

		// die();

		// Nama input file yang ada di form
		$files = array('surat_pernyataan_mandiri', 'formulir_etik', 'proposal', 'bukti_pembayaran');
		$uploadData = array();

		foreach ($files as $file) {
			if (!empty($_FILES[$file]['name'])) {
				$config['upload_path'] = FCPATH.'/uploads/';
				$config['allowed_types'] = 'pdf|gif|jpg|jpeg|png|webp|bmp';
				$config['max_size'] = 2048;
				$config['file_name'] = time() . '_' . $_FILES[$file]['name'];
				$config['overwrite'] = true;

				$this->upload->initialize($config);

				if ($this->upload->do_upload($file)) {
					$fileData = $this->upload->data();
					$uploadData[$file] = $fileData['file_name'];
				} else {
					$this->session->set_flashdata($file.'_invalid', $this->upload->display_errors());
					redirect('menu/sop_request');
				}
			}
		}

		if (!empty($uploadData)) {
			$data = array(
				'judul' => $judul,
				'kategori' => $kategori,
				'sumber_dana' => $sumber_dana,
				'pemberi_hibah' => $pemberi_hibah,
				'surat_pernyataan_mandiri' => isset($uploadData['surat_pernyataan_mandiri']) ? $uploadData['surat_pernyataan_mandiri'] : null,
				'formulir_etik' => isset($uploadData['formulir_etik']) ? $uploadData['formulir_etik'] : null,
				'proposal' => isset($uploadData['proposal']) ? $uploadData['proposal'] : null,
				'bukti_pembayaran' => isset($uploadData['bukti_pembayaran']) ? $uploadData['bukti_pembayaran'] : null,
				'id_members' => $this->session->userdata('id_members')
			);

			$insert = $this->menu_model->insert_penelitian($data);
			if ($insert) {
				$this->session->set_flashdata('success', 'Penelitian berhasil disubmit.');
			} else {
				$this->session->set_flashdata('error', 'Terjadi kesalahan, silakan coba lagi.');
			}
		}

		redirect('menu/sop_request');

	}
}