<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu_model extends CI_Model {

	public function __construct() {
		parent::__construct();
		$this->load->database();
	}
	
	public function insert_penelitian($data = array()) {
		return $this->db->insert('sop_request', $data);
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
}