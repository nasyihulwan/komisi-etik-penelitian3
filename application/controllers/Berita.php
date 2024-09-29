<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Berita extends CI_Controller {

	public function index()
	{
		$data['page'] = 'berita';
		$this->load->view('layout/header_home', $data);
		$this->load->view('berita/index');
		$this->load->view('layout/footer_home');
	}
}