<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('createFileLink')) {
    function createFileLink($label, $fileName) {
        return '
            <li class="mb-2">
                <a href="' . base_url('uploads/revisi_files/') . $fileName . '" 
                   target="_blank" 
                   class="btn btn-sm btn-outline-primary">
                   ' . htmlspecialchars($label, ENT_QUOTES, 'UTF-8') . ' - ' . htmlspecialchars($fileName, ENT_QUOTES, 'UTF-8') . '
                </a>
            </li>';
    }
}