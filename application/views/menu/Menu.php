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
		$this->load->model('validasiformulir_model');
		$this->load->library('upload');

		if ($this->input->is_ajax_request()) {
            set_error_handler(function($severity, $message, $file, $line) {
                throw new ErrorException($message, 0, $severity, $file, $line);
            });
        }

        if (!$this->session->userdata('logged_in') == 1) {
            if ($this->input->is_ajax_request()) {
                $this->output
                    ->set_status_header(401)
                    ->set_content_type('application/json')
                    ->set_output(json_encode([
                        'success' => false,
                        'message' => 'Session expired or not logged in'
                    ]));
                exit;
            }
            redirect('auth');
        }// Pastikan pengguna sudah login
		if (!$this->session->userdata('logged_in') == 1) {
			redirect('auth');
		}

		if ($this->input->is_ajax_request()) {
            set_error_handler(function($severity, $message, $file, $line) {
                throw new ErrorException($message, 0, $severity, $file, $line);
            });
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
			$this->_sop_process();
		}
	}

	private function _sop_process() {
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

	public function validasi_formulir()
	{
		$data['page'] = 'validasi_formulir';
		if($this->session->userdata('level') == 'superadmin' || $this->session->userdata('level') == 'petugas')
		{	
			$data['query'] = $this->validasiformulir_model->queryAll();
		} else if ($this->session->userdata('level') == 'member') {
			$data['query'] = $this->validasiformulir_model->querySelf();
		}
		$this->load->view('layout/header_menu', $data);
		$this->load->view('menu/validasi_formulir');
		$this->load->view('layout/footer_menu');
	}

	public function update_status() {
        header('Content-Type: application/json');
        
        try {
            // Verify AJAX request
            if (!$this->input->is_ajax_request()) {
                throw new Exception('Invalid request method');
            }

            // Get and validate input
            $id_sop = $this->input->post('id_sop');
            $status = $this->input->post('status');
            $pesan = $this->input->post('pesan');

            if (empty($id_sop) || empty($status)) {
                throw new Exception('Missing required fields');
            }

            // Start transaction
            $this->db->trans_start();

            // Update status
            $update_data = [
                'status' => $status,
                'pesan' => $pesan,
                'updated_at' => date('Y-m-d H:i:s')
            ];

            $update_success = $this->menu_model->update_status($id_sop, $update_data);
            if (!$update_success) {
                throw new Exception('Failed to update status');
            }

            // Handle file uploads
            if ($status === 'diperbaiki' && isset($_FILES['files']) && !empty($_FILES['files']['name'][0])) {
                $upload_path = FCPATH . 'uploads/pesan_files/';
                
                // Create directory if it doesn't exist
                if (!file_exists($upload_path)) {
                    if (!mkdir($upload_path, 0777, true)) {
                        throw new Exception('Failed to create upload directory');
                    }
                }

                // Check directory permissions
                if (!is_writable($upload_path)) {
                    throw new Exception('Upload directory is not writable');
                }

                $config = [
                    'upload_path' => $upload_path,
                    'allowed_types' => 'pdf|doc|docx|xls|xlsx|jpg|jpeg|png',
                    'max_size' => 2048,
                    'overwrite' => TRUE
                ];

                $this->upload->initialize($config);

                foreach ($_FILES['files']['name'] as $i => $filename) {
                    if (empty($filename)) continue;

                    $_FILES['file']['name'] = $_FILES['files']['name'][$i];
                    $_FILES['file']['type'] = $_FILES['files']['type'][$i];
                    $_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'][$i];
                    $_FILES['file']['error'] = $_FILES['files']['error'][$i];
                    $_FILES['file']['size'] = $_FILES['files']['size'][$i];

                    $new_filename = uniqid() . '_' . time() . '_' . preg_replace('/\s+/', '_', $filename);
                    $config['file_name'] = $new_filename;
                    
                    $this->upload->initialize($config);

                    if (!$this->upload->do_upload('file')) {
                        throw new Exception('Upload error: ' . $this->upload->display_errors('', ''));
                    }

                    $upload_data = $this->upload->data();
                    
                    // Remove created_at from the insert data if the column doesn't exist
                    $file_data = [
                        'id_sop' => $id_sop,
                        'file_name' => $upload_data['file_name'],
                        'original_name' => $filename,
                        'file_type' => $upload_data['file_type']
                    ];

                    if (!$this->db->insert('pesan_files', $file_data)) {
                        throw new Exception('Failed to save file information');
                    }
                }
            }

            // Complete transaction
            $this->db->trans_complete();

            if ($this->db->trans_status() === FALSE) {
                throw new Exception('Database transaction failed');
            }

            echo json_encode([
                'success' => true,
                'message' => 'Status berhasil diperbarui'
            ]);

        } catch (Exception $e) {
            $this->db->trans_rollback();
            
            log_message('error', 'Update status error: ' . $e->getMessage());
            
            echo json_encode([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }
	

	public function get_pesan_files($id_sop) {
		header('Content-Type: application/json');
		$files = $this->db->get_where('pesan_files', ['id_sop' => $id_sop])->result();
		echo json_encode($files);
		exit;
	}
}