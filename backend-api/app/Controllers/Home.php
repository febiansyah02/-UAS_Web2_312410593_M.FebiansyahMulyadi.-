<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        return $this->response->setJSON([
            'status'  => true,
            'message' => 'Halo Febiansyah! CodeIgniter 4 kamu sudah BERJALAN dengan lancar 100%!',
            'info'    => 'Langkah selanjutnya kita tinggal membuat database di phpMyAdmin.'
        ]);
    }
}