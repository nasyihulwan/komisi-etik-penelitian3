<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Berita extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data['page'] = 'berita';
        $this->load->helper('text');
        $this->load->model('Berita_model');
        
        $data['berita'] = $this->Berita_model->getAllBerita();
        
        $data['arsip'] = $this->Berita_model->getArsipBerita();
        
        if (empty($data['berita'])) {
            $data['berita'] = [];
        }
        
        $this->load->view('layout/header_home', $data);
        $this->load->view('berita/index', $data);
        $this->load->view('layout/footer_home');
    }

    public function detail($slug)
    {
        $data['page'] = 'berita';
        $this->load->helper('text');
        $this->load->model('Berita_model');

        $data['berita'] = $this->Berita_model->getBeritaBySlug($slug);

        $this->load->view('layout/header_home', $data);
        $this->load->view('berita/detail', $data);
        $this->load->view('layout/footer_home');
    }
}