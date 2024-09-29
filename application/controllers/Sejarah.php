<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sejarah extends CI_Controller {

	public function index()
	{
		$data['page'] = 'berita';
		$this->load->view('layout/header_home', $data);
		$this->load->view('profile/sejarah');
		$this->load->view('layout/footer_home');
	}
}