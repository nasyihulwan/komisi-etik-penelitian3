<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Struktur_organisasi extends CI_Controller {

	public function index()
	{
		$data['page'] = 'struktur_organisasi';
		$this->load->view('layout/header_home', $data);
		$this->load->view('profile/struktur_organisasi');
		$this->load->view('layout/footer_home');
	}
}