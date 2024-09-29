<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu_model extends CI_Model {

	public function __construct() {
		parent::__construct();
		$this->load->database();
	}
	
	public function insert_penelitian($data = array()) {
		return $this->db->insert('sop-request', $data);
	}
}