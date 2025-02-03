<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function index()
	{
		$data['page'] = 'home';
		$this->load->view('layout/header_home', $data);
		$this->load->view('homepage/index');
		$this->load->view('layout/footer_home');
	}

	public function testemail() {
		date_default_timezone_set('Asia/Jakarta');
		$config = [
			'mailtype' => 'html',
			'charset' => 'UTF-8',
			'protocol' => 'smtp',
			'smtp_host' => 'smtp.googlemail.com',
			'smtp_user' => '4lirahmath@gmail.com',
			'smtp_pass' => 'ahdpgnerbqxwxezf',
			'smtp_crypto' => 'ssl',
			'smtp_port' => 465,
			'crlf'    => "\r\n",
            'newline' => "\r\n"
		];
		$this->load->library('email');
		$this->email->initialize($config);
		$this->email->from('komisi_etik_penelitian@upi.edu', 'Komisi Etik Penelitian UPI');
		$this->email->to('ali.rahmat.9b.smpn8@gmail.com');

		$this->email->subject('Email Test');
		$this->email->message('Uji Coba Kirim Email - Pesan <br> Username Anda : <br> Password Anda :');

		if ($this->email->send()) {
            echo "Email Sukses Terkirim";
        } else {
            print_r($this->email->print_debugger());
        }
	}
}