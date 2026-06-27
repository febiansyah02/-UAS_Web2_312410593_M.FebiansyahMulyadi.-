<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class Auth extends ResourceController
{
    protected $format = 'json';

    // POST /api/login
    public function login()
    {
        // Izinkan CORS langsung di dalam Controller agar tidak diblokir filter sistem
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
        header("Access-Control-Allow-Methods: POST, OPTIONS");

        if ($this->request->getMethod() === 'options') {
            return $this->respond(null, 200);
        }

        // Ambil input dari Vue (baik format JSON maupun Form-Urlencoded)
        $json = $this->request->getJSON();
        $username = isset($json->username) ? trim((string)$json->username) : trim((string)$this->request->getVar('username'));
        $password = isset($json->password) ? trim((string)$json->password) : trim((string)$this->request->getVar('password'));

        // PROTEKSI BYPASS LANGSUNG (COCOKAN TEKS ASLI)
        if ($username === 'admin' && $password === 'admin123') {
            return $this->respond([
                'status'   => true,
                'message'  => 'Login Berhasil!',
                'token'    => base64_encode('admin_token_uas_web2_' . time()),
                'user'     => [
                    'username'     => 'admin',
                    'nama_lengkap' => 'Administrator E-Library'
                ]
            ], 200);
        }

        // Jika salah
        return $this->respond([
            'status'  => false,
            'message' => 'Username atau Password salah!'
        ], 401);
    }
}