<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tarif extends CI_Controller {

	public function index()
	{
		$data['page'] = 'struktur_organisasi';
		$this->load->view('layout/header_home', $data);
		$this->load->view('instruction/tarif');
		$this->load->view('layout/footer_home');
	}
}