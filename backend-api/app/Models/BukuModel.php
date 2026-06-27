<?php

namespace App\Models;

use CodeIgniter\Model;

class BukuModel extends Model
{
    protected $table            = 'buku';
    protected $primaryKey       = 'id_buku';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = ['id_kategori', 'judul_buku', 'penulis', 'penerbit', 'stok_buku'];

    // Mengaktifkan fitur otomatis pencatatan waktu jika diperlukan
    protected $useTimestamps = false;

    // Fungsi kustom untuk mengambil buku beserta nama genrenya (Relasi Tabel)
    public function getBukuWithKategori()
    {
        return $this->db->table($this->table)
            ->select('buku.*, kategori_buku.nama_genre')
            ->join('kategori_buku', 'kategori_buku.id_kategori = buku.id_kategori', 'left')
            ->get()
            ->getResultArray();
    }
}