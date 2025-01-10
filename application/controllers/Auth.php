<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->library('session');
	}
	public function index()
	{
		$rules = [
			[
				'field' => 'email',
				'label' => 'email',
				'rules' => 'required|valid_email',
				'errors' => [
					'required' => 'Email tidak boleh kosong!',
					'valid_email' => 'Email tidak valid!'
				]
			],
			[
				'field' => 'password',
				'label' => 'password',
				'rules' => 'required',
				'errors' => [
					'required' => 'Password tidak boleh kosong!'
				]
			],            
		];
		$this->form_validation->set_rules($rules);
		if ($this->form_validation->run() == FALSE)
		{
			// if (validation_errors() != null) {
			// 	# code...
			// 	// var_dump(validation_errors());
			// 	$this->session->set_flashdata('email_invalid', form_error('email'));
			// 	$this->session->set_flashdata('password_invalid', form_error('password'));
			// 	return redirect(base_url('auth'))->withInput();
			// 	// echo form_error('email');
			// 	// die;
			// } else {
			// 	# code...
			// }
			$data['page'] = 'home';
			$this->load->view('layout/header_auth', $data);
			$this->load->view('auth/login_user');
			$this->load->view('layout/footer_auth');
		}
		else {
			$this->_login();
		}
	}

	private function _login(){
		$email = $this->input->post('email', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
		$password = $this->input->post('password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
		$cek_akun = $this->db->get_where('members', ['email' => $email])->row_array();
		if ($cek_akun == NULL) {
			$this->session->set_flashdata('email_invalid', 'Akun tidak ditemukan! Silahkan Registrasi');
			return redirect(base_url('auth'))->withInput();
		} else {
			if (password_verify($password, $cek_akun['password'])) {
				$newdata = [
					'id_members' => $cek_akun['id_members'],
					'email' => $cek_akun['email'],
					'nama' => $cek_akun['nama'],
					'hp' => $cek_akun['hp'],
					'org' => $cek_akun['org'],
					'kota' => $cek_akun['kota'],
					'negara' => $cek_akun['negara'],
					'level' => $cek_akun['level'],
					'logged_in' => 1
				];
				// Jika Berhasil, simpan data ke session
				$this->session->set_userdata($newdata);
				// $this->session->set_userdata('id_members', $cek_akun['id_members']);     
				return redirect(base_url());
			} else {
				$this->session->set_flashdata('password_invalid', 'Password Salah!');
				return redirect(base_url('auth'))->withInput();
			}
		}
	}

	public function user_registration()
	{
		$rules = [
			[
				'field' => 'email',
				'label' => 'email',
				'rules' => 'required|valid_email|is_unique[members.email]',
				'errors' => [
					'required' => 'Email tidak boleh kosong!',
					'is_unique' => 'Akun email sudah ada!',
					'valid_email' => 'Email tidak valid!'
				]
			],
			[
				'field' => 'nama',
				'label' => 'nama',
				'rules' => 'required',
				'errors' => [
                    'required' => 'Nama tidak boleh kosong!',
                ]
			],            
			[
				'field' => 'hp',
				'label' => 'hp',
				'rules' => 'required|numeric',
				'errors' => [
                    'required' => 'Nomor HP tidak boleh kosong!',
                    'numeric' => 'Nomor HP hanya boleh mengandung angka!'
                ]
			],            
			[
				'field' => 'org',
				'label' => 'org',
				'rules' => 'required',
				'errors' => [
                    'required' => 'Organisasi tidak boleh kosong!',
                ]
			],          
			[
				'field' => 'negara',
				'label' => 'negara',
				'rules' => 'required',
				'errors' => [
                    'required' => 'Negara tidak boleh kosong!',
                ]
			],          
			[
				'field' => 'kota',
				'label' => 'kota',
				'rules' => 'required',
				'errors' => [
                    'required' => 'Kota tidak boleh kosong!',
                ]	 
			],          
		];
		$this->form_validation->set_rules($rules);
		if ($this->form_validation->run() == FALSE)
		{
			$data['page'] = 'home';
			$this->load->view('layout/header_auth', $data);
			$this->load->view('auth/reg_user');
			$this->load->view('layout/footer_auth');
		}
		else {
			$this->_registeruser();
			// var_dump($this->input->post());
		}
	}

	private function _registeruser() {
		$nama = $this->input->post('nama', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $email = $this->input->post('email', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $hp = $this->input->post('hp', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $org = $this->input->post('org', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $negara = $this->input->post('negara', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $kota = $this->input->post('kota', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $password = $this->randomPassword();
        
        $subject = "Selamat Datang di Komisi Etik Penelitian UPI";
        $pesan = '<html> 
        <head> 
            <title>Selamat Datang di Komisi Etik Penelitian UPI</title> 
        </head> 
        <body> 
            <h3>Terima Kasih telah bergabung sebagai pengguna Komisi Etik Penelitian UPI</h3> 
            <h5>Silahkan gunakan akun berikut untuk login</h5>
            <table cellspacing="0" style="border: solid 2px #ff0000; width: 100%; border-collapse: collapse"> 
                <tr> 
                    <th>Email/Username:</th><td>'.$email.'</td> 
                </tr> 
                <tr style="background-color: #FFCCCC;"> 
                    <th>Password:</th><td>'.$password.'</td> 
                </tr> 
                <tr> 
                    <th>Nama:</th><td>'.$nama.'</td> 
                </tr> 
                <tr style="background-color: #FFCCCC;"> 
                    <th>No. HP:</th><td>'.$hp.'</td> 
                </tr> 
                <tr> 
                    <th>Organisasi:</th><td>'.$org.'</td> 
                </tr> 
                <tr style="background-color: #FFCCCC;"> 
                    <th>Kota:</th><td>'.$kota.'</td> 
                </tr> 
                <tr> 
                    <th>Negara:</th><td>'.$negara.'</td> 
                </tr> 
                <tr style="background-color: #FFCCCC;"> 
                    <th>Website:</th><td><a href="https://etikpenelitian.upi.edu">Komisi Etik Penelitian UPI</a></td> 
                </tr> 
            </table> 
        </body> 
        </html>';
        $kirimEmail = $this->sendEmail($email, $subject, $pesan);
        // var_dump($kirimEmail);
        // var_dump($password);
        $password_hash = password_hash($password, PASSWORD_DEFAULT);
        if ($kirimEmail == true) {
			$data = array(
				'email' => $email,
				'password' => $password_hash,
				'nama' => $nama,
				'kota' => $kota,
				'negara' => $negara,
				'hp' => $hp,
				'org' => $org
			);
			
			$insert_members = $this->db->insert('members', $data);
            // $insert_members = $this->members->register($email, $password_hash, $nama, $kota, $negara, $org, $hp);
            if ($insert_members == true) {
                $this->session->set_flashdata('success', '<i class="bi bi-check-circle-fill"></i> Akun anda <strong>berhasil</strong> dibuat, silahkan cek email anda untuk login!');
                return redirect(base_url('auth'));
            } else {
                $this->session->set_flashdata('danger', '<i class="bi bi-x-circle-fill"></i></i> Akun anda <strong>GAGAL</strong> dibuat, silahkan coba lagi!');
            }
        } else {
            $this->session->set_flashdata('danger', '<i class="bi bi-x-circle-fill"></i></i> Akun anda <strong>GAGAL</strong> dibuat, silahkan coba lagi!');
        }
        return redirect(base_url('auth/user_registration'));
        die;
	}

	public function logout()
    {
        // Menghapus session
        session_destroy();
        return redirect(base_url());
    }

	function randomPassword() {
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890?!_';
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < 8; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass); //turn the array into a string
    }

	public function sendEmail($email_tujuan, $subject, $pesan) {
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
		$this->email->to($email_tujuan);

		$this->email->subject($subject);
		$this->email->message($pesan);

		if ($this->email->send()) {
			return true;
        } else {
            return false;
        }
	}
}