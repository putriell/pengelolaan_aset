<?php

namespace App\Models;

use CodeIgniter\Model;

class DataModel extends Model
{
    protected $table = 'data_aset';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nama', 'kode', 'jenis', 'unit', 'kondisi'];
    
    public function TotalAset() {
        return $this->countAllResults();
    }
    public function AsetTersedia() {
        return $this->where('kondisi', 'Tersedia')->countAllResults();
    }

    public function AsetRusak() {
        return $this->where('kondisi', 'Rusak')->countAllResults();
    }

    public function AsetHilang() {
        return $this->where('kondisi', 'Hilang')->countAllResults();
    }
    public function TotalbyName()
    {
        return $this->select('nama,unit,kode,jenis, count(nama) as total')
        ->groupBy('nama')
        ->findAll();
    }

    public function search($keyword) {
        if ($keyword) {
            return $this->like('nama', $keyword)
                        ->orLike('kode', $keyword)
                        ->orLike('jenis', $keyword)
                        ->orLike('unit', $keyword)
                        ->orLike('kondisi', $keyword)
                        ->findAll();
        }
        return $this->findAll();
    }

    
}
