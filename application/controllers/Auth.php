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

	public function lupa_password() {
		$rules = [
			[
				'field' => 'email',
				'label' => 'email',
				'rules' => 'required|valid_email',
				'errors' => [
					'required' => 'Email tidak boleh kosong!',
					'valid_email' => 'Email tidak valid!'
				]
			]           
		];
		$this->form_validation->set_rules($rules);
		if ($this->form_validation->run() == FALSE) {
			$data['page'] = 'home';
			$this->load->view('layout/header_auth', $data);
			$this->load->view('auth/lupa_password');
			$this->load->view('layout/footer_auth');
		} else {
			$this->_handle_lupa_password();
		}
	}
	
	private function _handle_lupa_password() {
		$email = $this->input->post('email', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
		
		// Check if email exists in database
		$user = $this->db->get_where('members', ['email' => $email])->row_array();
		
		if ($user == NULL) {
			$this->session->set_flashdata('email_invalid', 'Email tidak terdaftar dalam sistem!');
			return redirect(base_url('auth/lupa_password'))->withInput();
		}
		
		// Generate reset token
		$token = bin2hex(random_bytes(32)); // Generate secure random token
		$expired_at = date('Y-m-d H:i:s', strtotime('+1 hour')); // Token berlaku 1 jam
		
		// Save token to database
		$data = [
			'email' => $email,
			'token' => $token,
			'expired_at' => $expired_at,
			'is_used' => 0
		];
		
		$this->db->insert('password_resets', $data);
		
		// Prepare email content with reset link
		$reset_link = base_url('auth/reset_password/' . $token);
		$subject = "Reset Password - Komisi Etik Penelitian UPI";
		$pesan = '<html> 
		<head> 
			<title>Reset Password - Komisi Etik Penelitian UPI</title> 
		</head> 
		<body> 
			<h3>Reset Password Akun Komisi Etik Penelitian UPI</h3> 
			<p>Anda telah meminta untuk mereset password akun Anda.</p>
			<p>Silakan klik link di bawah ini untuk mereset password Anda:</p>
			<p><a href="'.$reset_link.'">'.$reset_link.'</a></p>
			<p>Link ini akan kadaluarsa dalam 1 jam.</p>
			<p>Jika Anda tidak meminta reset password, abaikan email ini.</p>
			<br>
			<p>Terima kasih,</p>
			<p>Tim Komisi Etik Penelitian UPI</p>
		</body> 
		</html>';
		
		// Send email
		$kirimEmail = $this->sendEmail($email, $subject, $pesan);
		
		if ($kirimEmail) {
			$this->session->set_flashdata('success', '<i class="bi bi-check-circle-fill"></i> Link reset password telah dikirim ke email Anda!');
			return redirect(base_url('auth'));
		} else {
			$this->session->set_flashdata('danger', '<i class="bi bi-x-circle-fill"></i> Gagal mengirim email reset password. Silahkan coba lagi!');
			return redirect(base_url('auth/lupa_password'))->withInput();
		}
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
	
	public function reset_password($token) {
		// Check if token exists and still valid
		$reset_data = $this->db->get_where('password_resets', [
			'token' => $token,
			'is_used' => 0
		])->row_array();
		
		if (!$reset_data) {
			$this->session->set_flashdata('danger', '<i class="bi bi-x-circle-fill"></i> Link reset password tidak valid!');
			return redirect(base_url('auth'));
		}
		
		// Check if token is expired
		if (strtotime($reset_data['expired_at']) < time()) {
			$this->session->set_flashdata('danger', '<i class="bi bi-x-circle-fill"></i> Link reset password sudah kadaluarsa!');
			return redirect(base_url('auth'));
		}
		
		$data['token'] = $token;
		$data['page'] = 'Reset Password';
		
		$this->load->view('layout/header_auth', $data);
		$this->load->view('auth/reset_password', $data);
		$this->load->view('layout/footer_auth');
	}
	
	public function do_reset_password() {
		$token = $this->input->post('token');
		$password = $this->input->post('password');
		$confirm_password = $this->input->post('confirm_password');
		
		// Validate password
		if (strlen($password) < 6) {
			$this->session->set_flashdata('danger', '<i class="bi bi-x-circle-fill"></i> Password minimal 6 karakter!');
			return redirect(base_url('auth/reset_password/' . $token));
		}
		
		if ($password !== $confirm_password) {
			$this->session->set_flashdata('danger', '<i class="bi bi-x-circle-fill"></i> Konfirmasi password tidak sesuai!');
			return redirect(base_url('auth/reset_password/' . $token));
		}
		
		// Get reset data
		$reset_data = $this->db->get_where('password_resets', [
			'token' => $token,
			'is_used' => 0
		])->row_array();
		
		if (!$reset_data || strtotime($reset_data['expired_at']) < time()) {
			$this->session->set_flashdata('danger', '<i class="bi bi-x-circle-fill"></i> Link reset password tidak valid atau sudah kadaluarsa!');
			return redirect(base_url('auth'));
		}
		
		// Update password
		$password_hash = password_hash($password, PASSWORD_DEFAULT);
		$this->db->where('email', $reset_data['email']);
		$update = $this->db->update('members', ['password' => $password_hash]);
		
		if ($update) {
			// Mark token as used
			$this->db->where('token', $token);
			$this->db->update('password_resets', ['is_used' => 1]);
			
			$this->session->set_flashdata('success', '<i class="bi bi-check-circle-fill"></i> Password berhasil direset. Silakan login dengan password baru Anda!');
			return redirect(base_url('auth'));
		} else {
			$this->session->set_flashdata('danger', '<i class="bi bi-x-circle-fill"></i> Gagal mereset password. Silakan coba lagi!');
			return redirect(base_url('auth/reset_password/' . $token));
		}
	}
}