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

    public function getHistoriById($id_sop) {
        $this->db->select('
            sop_request_histori.*,
            pesan_files.file_name as file_name_pesan,
            revisi_files.id as id_revisi_files,
            revisi_files.revisi_surat_mandiri,
            revisi_files.revisi_formulir_etik,
            revisi_files.revisi_proposal,
            revisi_files.revisi_bukti_pembayaran,
            disetujui_files.id as id_persetujuan_files,
            disetujui_files.file_name as file_name_persetujuan
        ');
        
        $this->db->from('sop_request_histori');
        
        $this->db->join('pesan_files', 
            'sop_request_histori.id = pesan_files.id_histori', 
            'left'
        );
        
        $this->db->join('revisi_files', 
            'sop_request_histori.id = revisi_files.id_histori', 
            'left'
        );
        
        $this->db->join('disetujui_files', 
            'sop_request_histori.id = disetujui_files.id_histori', 
            'left'
        );
        
        $this->db->where('sop_request_histori.id_sop', $id_sop);

        $this->db->order_by('sop_request_histori.created_at', 'DESC');
        
        return $this->db->get()->result_array();
    }

    public function getSopById($id_sop) {
        return $this->db->get_where('sop_request', ['id_sop' => $id_sop])->row_array();
    }

    public function addHistori($data) {
        return $this->db->insert('sop_request_histori', $data);
    }
}