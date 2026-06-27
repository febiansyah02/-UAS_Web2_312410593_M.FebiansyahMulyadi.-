<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class Peminjaman extends ResourceController
{
    protected $modelName = 'App\Models\PeminjamanModel';
    protected $format    = 'json';

    // 1. GET /api/peminjaman -> Melihat semua riwayat peminjaman
    public function index()
    {
        $data = $this->model->getPeminjamanWithBuku();
        return $this->respond([
            'status'  => true,
            'message' => 'Berhasil mengambil data peminjaman',
            'data'    => $data
        ], 200);
    }

    // 2. POST /api/peminjaman -> Input transaksi pinjam baru
    public function create()
    {
        $rules = [
            'id_buku'        => 'required|numeric',
            'nama_anggota'   => 'required',
            'tanggal_pinjam' => 'required|valid_date[Y-m-d]',
        ];

        if (!$this->validate($rules)) {
            return $this->failValidationErrors($this->validator->getErrors());
        }

        $data = [
            'id_buku'        => $this->request->getVar('id_buku'),
            'nama_anggota'   => $this->request->getVar('nama_anggota'),
            'tanggal_pinjam' => $this->request->getVar('tanggal_pinjam'),
            'status'         => 'Dipinjam'
        ];

        $this->model->insert($data);

        return $this->respondCreated([
            'status'  => true,
            'message' => 'Transaksi peminjaman berhasil dicatat!'
        ]);
    }

    // 3. PUT /api/peminjaman/(:num) -> Mengubah status (misal: dari 'Dipinjam' menjadi 'Kembali')
    public function update($id = null)
    {
        $cek = $this->model->find($id);
        if (!$cek) {
            return $this->failNotFound('Data transaksi tidak ditemukan');
        }

        $data = $this->request->getRawInput();
        $this->model->update($id, $data);

        return $this->respond([
            'status'  => true,
            'message' => 'Status transaksi berhasil diperbarui!'
        ], 200);
    }
}