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
		$this->load->model('member_model');
		$this->load->library('upload');
        $this->load->helper('main');

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
                $this->session->set_flashdata('error', 'Terjadi kesalahan saat menyimpan data, silakan coba lagi.');
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
            if (!$this->input->is_ajax_request()) {
                throw new Exception('Invalid request method');
            }
    
            $id_sop = $this->input->post('id_sop');
            $status = $this->input->post('status');
            $pesan = $this->input->post('pesan');
    
            if (empty($id_sop) || empty($status)) {
                throw new Exception('Missing required fields');
            }
    
            $this->db->trans_start();
    
            // Update the main sop_request table
            $update_data = [
                'status' => $status,
                'pesan' => $pesan,
                'updated_at' => date('Y-m-d H:i:s')
            ];
    
            $update_success = $this->menu_model->update_status($id_sop, $update_data);
            if (!$update_success) {
                throw new Exception('Failed to update status');
            }
    
            // Generate unique ID and insert into history
            $unique_id = $this->menu_model->generate_unique_history_id($id_sop);
            
            $history_data = [
                'id' => $unique_id,
                'id_sop' => $id_sop,
                'status' => $status,
                'pesan' => $pesan,
                'created_at' => date('Y-m-d H:i:s')
            ];
    
            if (!$this->db->insert('sop_request_histori', $history_data)) {
                throw new Exception('Failed to insert history record');
            }
    
            // Handle file uploads for both "belum diperbaiki" and "disetujui" status
            if (($status === 'belum diperbaiki' || $status === 'disetujui') && isset($_FILES['files']) && !empty($_FILES['files']['name'][0])) {
                $upload_path = FCPATH . 'uploads/' . ($status === 'disetujui' ? 'disetujui_files/' : 'pesan_files/');
                
                if (!file_exists($upload_path)) {
                    if (!mkdir($upload_path, 0777, true)) {
                        throw new Exception('Failed to create upload directory');
                    }
                }
    
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
                    
                    $file_data = [
                        'id_histori' => $unique_id,
                        'id_sop' => $id_sop,
                        'file_name' => $upload_data['file_name'],
                        'original_name' => $filename,
                        'file_type' => $upload_data['file_type']
                    ];
    
                    // Insert into appropriate table based on status
                    $table = $status === 'disetujui' ? 'disetujui_files' : 'pesan_files';
                    if (!$this->db->insert($table, $file_data)) {
                        throw new Exception('Failed to save file information');
                    }
                }
            }
    
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
        $files = $this->db->order_by('id_pesan_file', 'DESC') 
        ->limit(1)
        ->get_where('pesan_files', ['id_sop' => $id_sop])
        ->result();

		echo json_encode($files);
		exit;
	}

    public function get_disetujui_files($id_sop) {
        header('Content-Type: application/json');
        $files = $this->db->get_where('disetujui_files', ['id_sop' => $id_sop])->result();
        echo json_encode($files);
        exit;
    }
    
    public function get_revision_files($id_sop) {
        header('Content-Type: application/json');
        
        $revision = $this->db->order_by('id', 'DESC') 
        ->limit(1)
        ->get_where('revisi_files', ['id_sop' => $id_sop])
        ->row_array();

        if ($revision) {
            // Format the response to include both system and original filenames
            $files = [];
            $file_types = ['surat_mandiri', 'formulir_etik', 'proposal', 'bukti_pembayaran'];
            
            foreach ($file_types as $type) {
                $revisi_key = 'revisi_' . $type;
                $original_key = 'original_' . $type;
                
                if (!empty($revision[$revisi_key])) {
                    $files[] = [
                        'type' => $type,
                        'file_name' => $revision[$revisi_key],
                        'original_name' => $revision[$original_key],
                        'download_url' => base_url('uploads/revisi_files/' . $revision[$revisi_key])
                    ];
                }
            }
            echo json_encode($files);
        } else {
            echo json_encode([]);
        }
        exit;
    }

    public function update_revisi() {
        header('Content-Type: application/json');
    
        try {
            if (!$this->input->is_ajax_request()) {
                throw new Exception('Invalid request method');
            }
    
            $id_sop = $this->input->post('id_sop');
            $status = $this->input->post('status');
    
            if (empty($id_sop) || empty($status)) {
                throw new Exception('Missing required fields');
            }
    
            $this->db->trans_start();
    
            // Prepare file upload configuration
            $upload_path = FCPATH . 'uploads/revisi_files/';
            if (!file_exists($upload_path)) {
                if (!mkdir($upload_path, 0777, true)) {
                    throw new Exception('Failed to create upload directory');
                }
            }
    
            if (!is_writable($upload_path)) {
                throw new Exception('Upload directory is not writable');
            }
    
            $config = [
                'upload_path' => $upload_path,
                'allowed_types' => 'pdf|doc|docx|xls|xlsx|jpg|jpeg|png',
                'max_size' => 2048,
                'overwrite' => TRUE
            ];
    
            $this->load->library('upload', $config);
    
            $file_fields = [
                'surat_mandiri' => 'revisi_surat_mandiri',
                'formulir_etik' => 'revisi_formulir_etik',
                'proposal' => 'revisi_proposal',
                'bukti_pembayaran' => 'revisi_bukti_pembayaran'
            ];

            $unique_id = $this->menu_model->generate_unique_history_id($id_sop);
    
            $update_data = [
                'id_histori' => $unique_id,
                'uploaded_at' => date('Y-m-d H:i:s')
            ];
    
            foreach ($file_fields as $field => $db_column) {
                if (isset($_FILES[$field]) && !empty($_FILES[$field]['name'])) {
                    $new_filename = uniqid() . '_' . time() . '_' . preg_replace('/\s+/', '_', $_FILES[$field]['name']);
                    $config['file_name'] = $new_filename;
                    $this->upload->initialize($config);
    
                    if (!$this->upload->do_upload($field)) {
                        throw new Exception('Upload error (' . $field . '): ' . $this->upload->display_errors('', ''));
                    }
    
                    $upload_data = $this->upload->data();
                    $update_data[$db_column] = $upload_data['file_name'];
                    $update_data['original_' . $field] = $_FILES[$field]['name'];
                }
            }
    
            $this->db->where('id_sop', $id_sop);
            $exists = $this->db->get('revisi_files')->row_array();
    
            
            $update_data['id_sop'] = $id_sop;
            $this->db->insert('revisi_files', $update_data);

            $this->db->where('id_sop', $id_sop);
            $this->db->update('sop_request', ['status' => 'sudah diperbaiki']);

            $history_data = [
                'id' => $unique_id,
                'id_sop' => $id_sop,
                'status' => 'sudah diperbaiki',
                'created_at' => date('Y-m-d H:i:s')
            ];
        
            if (!$this->db->insert('sop_request_histori', $history_data)) {
                throw new Exception('Failed to insert history record');
            }
    
            $this->db->trans_complete();
    
            if ($this->db->trans_status() === FALSE) {
                throw new Exception('Database transaction failed');
            }

            echo json_encode([
                'success' => true,
                'message' => 'Revisi berhasil diperbarui'
            ]);
    
        } catch (Exception $e) {
            $this->db->trans_rollback();
            log_message('error', 'Update revisi error: ' . $e->getMessage());
            ob_clean(); // Clear buffer before sending JSON
            echo json_encode([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function formulir_detail($id_sop) {
        $sop_details = $this->validasiformulir_model->getSopById($id_sop);
        $member_details = $this->member_model->getMemberById($sop_details['id_members']);
        $history = $this->validasiformulir_model->getHistoriById($id_sop);
        $latest_message = $this->menu_model->get_latest_message($id_sop);
    
        $formatted_history = [];
        foreach ($history as $record) {
            $key = $record['id']; 
            if (!isset($formatted_history[$key])) {
                $formatted_history[$key] = [
                    'date' => date('d M Y, H:i', strtotime($record['created_at'])),
                    'badge_class' => $this->_getBadgeClass($record['status']),
                    'badge_icon' => $this->_getStatusIcon($record['status']),
                    'title' => $this->_getStatusTitle($record['status']),
                    'review_message' => $record['pesan'], 
                    'review_files' => [], 
                    'revision_files' => [], 
                    'approval_files' => [], 
                    'has_revision' => !empty($record['pesan']),
                    'has_submitted_revision' => $record['id_revisi_files'], 
                    'has_approved' => $record['id_persetujuan_files'], 
                ];
            }
        
            // Tambahkan file ke array review_files
            if (!empty($record['file_name_pesan'])) {
                $formatted_history[$key]['review_files'][] = [
                    'name' => $record['file_name_pesan'],
                    'path' => $this->_getFilePath(['file_name_pesan' => $record['file_name_pesan']]),
                ];
            }

            $approvalFilePaths = array_column($formatted_history[$key]['approval_files'], 'path'); // Ambil path file yang sudah ada
            if (!empty($record['file_name_persetujuan']) && !in_array($this->_getFilePath(['file_name_persetujuan' => $record['file_name_persetujuan']]), $approvalFilePaths)) {
                $formatted_history[$key]['approval_files'][] = [
                    'name' => $record['file_name_persetujuan'],
                    'path' => $this->_getFilePath(['file_name_persetujuan' => $record['file_name_persetujuan']]),
                ];
            }
        
            //
            $revisionFilePaths = array_column($formatted_history[$key]['revision_files'], 'path'); // Ambil path file yang sudah ada
            if (!empty($record['revisi_surat_mandiri']) && !in_array($this->_getFilePath(['revisi_surat_mandiri' => $record['revisi_surat_mandiri']]), $revisionFilePaths)) {
                $formatted_history[$key]['revision_files'][] = [
                    'name' => $record['revisi_surat_mandiri'],
                    'path' => $this->_getFilePath(['revisi_surat_mandiri' => $record['revisi_surat_mandiri']]),
                ];
            }
            if (!empty($record['revisi_formulir_etik']) && !in_array($this->_getFilePath(['revisi_formulir_etik' => $record['revisi_formulir_etik']]), $revisionFilePaths)) {
                $formatted_history[$key]['revision_files'][] = [
                    'name' => $record['revisi_formulir_etik'],
                    'path' => $this->_getFilePath(['revisi_formulir_etik' => $record['revisi_formulir_etik']]),
                ];
            }
            if (!empty($record['revisi_proposal']) && !in_array($this->_getFilePath(['revisi_proposal' => $record['revisi_proposal']]), $revisionFilePaths)) {
                $formatted_history[$key]['revision_files'][] = [
                    'name' => $record['revisi_proposal'],
                    'path' => $this->_getFilePath(['revisi_proposal' => $record['revisi_proposal']]),
                ];
            }
            if (!empty($record['revisi_bukti_pembayaran']) && !in_array($this->_getFilePath(['revisi_bukti_pembayaran' => $record['revisi_bukti_pembayaran']]), $revisionFilePaths)) {
                $formatted_history[$key]['revision_files'][] = [
                    'name' => $record['revisi_bukti_pembayaran'],
                    'path' => $this->_getFilePath(['revisi_bukti_pembayaran' => $record['revisi_bukti_pembayaran']]),
                ];
            }
        
            // Periksa apakah ada revision_files untuk mengaktifkan has_revision
            if (!empty($formatted_history[$key]['revision_files'])) {
                $formatted_history[$key]['has_revision'] = true;
            }
        
        }
    
        $data = [
            'page' => 'menu',
            'sop' => $sop_details,
            'member' => $member_details,
            'history' => array_values($formatted_history), // Reset kunci array untuk view
        ];
    
        $this->load->view('layout/header_menu', $data);
        $this->load->view('menu/formulir_detail', $data);
        $this->load->view('layout/footer_menu');
    }

    private function getStatusFromFiles($id_sop) {
        // Ambil semua data dari tabel sop_request_histori berdasarkan id_sop
        $this->db->select('status, pesan, created_at') // Pilih kolom yang diperlukan
                 ->from('sop_request_histori')
                 ->where('id_sop', $id_sop)
                 ->order_by('created_at', 'DESC'); // Urutkan berdasarkan waktu terbaru
        $query = $this->db->get();
    
        if ($query->num_rows() > 0) {
            return $query->result_array(); // Kembalikan semua baris sebagai array
        }
        
        return []; // Kembalikan array kosong jika tidak ada data
    }
    
    private function _getBadgeClass($status) {
        $classes = [
            'belum diperiksa' => 'bg-secondary',
            'sedang diperiksa' => 'bg-info',
            'belum diperbaiki' => 'bg-warning',
            'ditolak' => 'bg-danger',
            'disetujui' => 'bg-success'
        ];
        return $classes[$status] ?? 'bg-primary';
    }
    
    private function _getStatusIcon($status) {
        $icons = [
            'belum diperiksa' => 'file-earmark-text', 
            'sedang diperiksa' => 'eye',           
            'belum diperbaiki' => 'pencil',         
            'sudah diperbaiki' => 'upload',         
            'ditolak' => 'x-circle',             
            'disetujui' => 'check-circle'         
        ];
        return $icons[$status] ?? 'circle'; // Default icon
    }
    
    private function _getStatusTitle($status) {
        $titles = [
            'belum diperiksa' => 'Permohonan Diajukan',
            'sedang diperiksa' => 'Permohonan Direview',
            'belum diperbaiki' => 'Revisi Diperlukan',
            'sudah diperbaiki' => 'Revisi Diajukan',
            'ditolak' => 'Permohonan Ditolak',
            'disetujui' => 'Permohonan Disetujui'
        ];
        return $titles[$status] ?? 'Status Update';
    }
    
    private function _getFilePath($record) {
        if (!empty($record['file_name_persetujuan'])) {
            return 'disetujui/' . $record['file_name_persetujuan'];
        } elseif (!empty($record['file_name_pesan'])) {
            return 'uploads/pesan_files/' . $record['file_name_pesan'];
        } elseif (!empty($record['revisi_surat_mandiri'])) {
            return 'uploads/revisi_files/' . $record['revisi_surat_mandiri'];
        } elseif (!empty($record['revisi_formulir_etik'])) {
            return 'uploads/revisi_files/' . $record['revisi_formulir_etik'];
        } elseif (!empty($record['revisi_proposal'])) {
            return 'uploads/revisi_files/' . $record['revisi_proposal'];
        } elseif (!empty($record['revisi_bukti_pembayaran'])) {
            return 'uploads/revisi_files/' . $record['revisi_bukti_pembayaran'];
        }
        return null;
    }
}