<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Berita_model extends CI_Model {

    public function getAllBerita()
    {
        $this->db->order_by('datetime', 'DESC');
        $query = $this->db->get('berita');
        return $query->result_array();
    }
    

    public function getBeritaBySlug($slug)
    {
        $this->db->where('LOWER(slug)', strtolower($slug));
        $query = $this->db->get('berita');
        return $query->row_array();
    }
    
}