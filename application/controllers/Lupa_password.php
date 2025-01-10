<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lupa_password extends CI_Controller {

	public function index()
	{
		$data['page'] = 'berita';
		$this->load->view('layout/header_home', $data);
		$this->load->view('panduan/lupa_password');
		$this->load->view('layout/footer_home');
	}

}