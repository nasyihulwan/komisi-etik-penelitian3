<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Estimasi_waktu extends CI_Controller {

	public function index()
	{
		$data['page'] = 'berita';
		$this->load->view('layout/header_home', $data);
		$this->load->view('panduan/estimasi_waktu');
		$this->load->view('layout/footer_home');
	}

}