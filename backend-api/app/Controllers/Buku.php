<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class Buku extends ResourceController
{
    protected $modelName = 'App\Models\BukuModel';
    protected $format    = 'json';

    // 1. GET /api/buku -> Mengambil semua data buku
    public function index()
    {
        $data = $this->model->getBukuWithKategori();
        
        return $this->respond([
            'status'   => true,
            'message'  => 'Berhasil mengambil data buku',
            'data'     => $data
        ], 200);
    }

    // 2. GET /api/buku/(:num) -> Mengambil satu detail buku berdasarkan ID
    public function show($id = null)
    {
        $data = $this->model->find($id);
        
        if (!$data) {
            return $this->failNotFound('Data buku tidak ditemukan');
        }

        return $this->respond([
            'status'   => true,
            'message'  => 'Berhasil mengambil detail buku',
            'data'     => $data
        ], 200);
    }

    // 3. POST /api/buku -> Menambah data buku baru (Fitur Admin)
    public function create()
    {
        // Memaksa menangkap data berformat JSON dari Vue
        $json = $this->request->getJSON();

        if ($json) {
            // Kita petakan datanya. Jika Vue mengirim 'id_genre', kita masukkan ke 'id_kategori' database
            $data = [
                'id_kategori' => $json->id_genre ?? $json->id_kategori,
                'judul_buku'  => $json->judul_buku,
                'penulis'     => $json->penulis,
                'penerbit'    => $json->penerbit,
                'stok_buku'   => $json->stok_buku,
            ];

            // Masukkan data ke model database
            $this->model->insert($data);

            return $this->respondCreated([
                'status'  => true,
                'message' => 'Buku baru berhasil ditambahkan!'
            ]);
        }

        return $this->respond([
            'status'  => false,
            'message' => 'Format payload data tidak valid atau kosong.'
        ], 400);
    }

    // 4. PUT /api/buku/(:num) -> Mengubah/Mengedit data buku berdasarkan ID (Fitur Admin)
    public function update($id = null)
    {
        $buku = $this->model->find($id);
        if (!$buku) {
            return $this->failNotFound('Data buku tidak ditemukan');
        }

        $data = $this->request->getRawInput();

        $this->model->update($id, $data);

        return $this->respond([
            'status'  => true,
            'message' => 'Data buku berhasil diperbarui!'
        ], 200);
    }

    // 5. DELETE /api/buku/(:num) -> Menghapus data buku berdasarkan ID (Fitur Admin)
    public function delete($id = null)
    {
        $buku = $this->model->find($id);
        if (!$buku) {
            return $this->failNotFound('Data buku tidak ditemukan');
        }

        $this->model->delete($id);

        return $this->respond([
            'status'  => true,
            'message' => 'Buku berhasil dihapus dari sistem!'
        ], 200);
    }
}