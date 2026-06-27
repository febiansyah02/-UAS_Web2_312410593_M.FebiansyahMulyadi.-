<?php

namespace App\Models;

use CodeIgniter\Model;

class PeminjamanModel extends Model
{
    protected $table            = 'peminjaman';
    protected $primaryKey       = 'id_pinjam';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = ['id_buku', 'nama_anggota', 'tanggal_pinjam', 'status'];

    // Fungsi untuk mengambil data pinjam beserta judul bukunya (Relasi Tabel)
    public function getPeminjamanWithBuku()
    {
        return $this->db->table($this->table)
            ->select('peminjaman.*, buku.judul_buku')
            ->join('buku', 'buku.id_buku = peminjaman.id_buku', 'left')
            ->get()
            ->getResultArray();
    }
}