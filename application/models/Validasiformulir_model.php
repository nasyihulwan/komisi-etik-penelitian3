<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Validasiformulir_model extends CI_Model {

	public function __construct() {
		parent::__construct();
		$this->load->database();
	}
	
    public function queryAll()
    {
        $this->db->select('*');
        $this->db->from('sop_request');
        $this->db->join('members', 'sop_request.id_members = members.id_members');
        return $this->db->get()->result();
    }

    public function querySelf()
    {
        $this->db->select('*');
        $this->db->from('sop_request');
        $this->db->join('members', 'sop_request.id_members = members.id_members');
        $this->db->where('sop_request.id_members', $this->session->userdata('id_members'));
        return $this->db->get()->result();
    }
}