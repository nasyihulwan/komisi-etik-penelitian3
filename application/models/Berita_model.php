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
    
    public function getArsipBerita($bulan) {
        $this->db->select("DATE_FORMAT(datetime, '%M %Y') AS bulan_tahun, 
                           DATE_FORMAT(datetime, '%Y-%m') AS periode, 
                           COUNT(*) AS jumlah_berita");
        $this->db->from('berita');
        $this->db->where('bulan_tahun', $bulan);
        $this->db->group_by('bulan_tahun, periode');
        $this->db->order_by('periode', 'DESC');
        
        $query = $this->db->get();
        return $query->result();
    }

    public function getBerita($limit, $start)
    {
        $this->db->limit($limit, $start);
        $query = $this->db->get('berita');
        return $query->result_array();
    }
    
    public function countBerita()
    {
        return $this->db->count_all('berita');
    }
}