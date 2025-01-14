<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu_model extends CI_Model {

	public function __construct() {
		parent::__construct();
		$this->load->database();
	}
	
	// In menu_model.php
	public function insert_penelitian($data = array()) {
		// Begin transaction
		$this->db->trans_begin();
		
		// Insert into sop_request table
		$this->db->insert('sop_request', $data);
		$id_sop = $this->db->insert_id(); // Get the ID of inserted sop_request
		
		// Generate unique ID for history
		$unique_id = $this->generate_unique_history_id($id_sop);
		
		// Prepare history data
		$history_data = array(
			'id' => $unique_id,
			'id_sop' => $id_sop,
			'status' => 'belum diperiksa',
			'pesan' => NULL,
			'created_at' => date('Y-m-d H:i:s')
		);
		
		// Insert into history table
		$this->db->insert('sop_request_histori', $history_data);
		
		// Check if transaction succeeded
		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			return false;
		} else {
			$this->db->trans_commit();
			return true;
		}
	}
	
	public function generate_unique_history_id($id_sop) {
		// Append '1' to the id_sop to create the unique ID
		$base_id = $id_sop . '1';
		
		// Check if ID exists and increment until finding unique one
		while (true) {
			$this->db->where('id', $base_id);
			$query = $this->db->get('sop_request_histori');
			
			if ($query->num_rows() == 0) {
				break;
			}
			$base_id++; // Increment if ID exists
		}
		
		return $base_id; // Return the unique ID
	}
	

	public function update_status($id_sop, $data) {
		$this->db->where('id_sop', $id_sop);
		return $this->db->update('sop_request', $data);
	}
	
	public function get_pesan_files($id_sop) {
		return $this->db->get_where('pesan_files', ['id_sop' => $id_sop])->result();
	}

	public function get_by_sop($id_sop) {
        return $this->db->get_where('sop_request', ['id_sop' => $id_sop])->row_array();
    }
    public function save_revision($data) {
        // Check if a revision record already exists
        $existing = $this->get_by_sop($data['id_sop']);
        
        if ($existing) {
            // Update existing record
            $this->db->where('id_sop', $data['id_sop']);
            return $this->db->update($this->table, $data);
        } else {
            // Insert new record
            return $this->db->insert($this->table, $data);
        }
    }

	// cek apakah ada pesan revisi terbaru 
	public function get_latest_message($id_sop) {
		$this->db->select('pesan');
		$this->db->from('sop_request_histori');
		$this->db->where('id_sop', $id_sop);
		$this->db->order_by('created_at', 'DESC');
		$this->db->limit(1);
		
		$query = $this->db->get();
		
		if ($query->num_rows() > 0) {
			return $query->row()->pesan;
		}
		
		return null;
	}
}