<?php

namespace App\Models;

use CodeIgniter\Model;

class DataModel extends Model
{
    protected $table = 'data_aset';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id','nama', 'kode', 'jenis', 'unit', 'kondisi'];
    
    public function TotalAset($unit = null) {
        if ($unit) {
            return $this->where('unit', $unit)->countAllResults();
        }
        return $this->countAllResults();
        
    }
    public function AsetTersedia($unit = null) {
        $this->where('kondisi', 'tersedia');
        if ($unit) {
            $this->where('unit', $unit);
        }
        return $this->countAllResults();
        // return $this->where('kondisi', 'Tersedia')->countAllResults();
    }

    public function AsetRusak($unit = null) {
        $this->where('kondisi', 'rusak');
        if ($unit) {
            $this->where('unit', $unit);
        }
        return $this->countAllResults();
        // return $this->where('kondisi', 'Rusak')->countAllResults();
    }

    public function AsetHilang($unit = null) {
        $this->where('kondisi', 'hilang');
        if ($unit) {
            $this->where('unit', $unit);
        }
        return $this->countAllResults();
        // return $this->where('kondisi', 'Hilang')->countAllResults();
    }
    public function TotalbyName($unit = null)
    {
        $this->select('nama, unit, kode, jenis, count(nama) as total');
        if ($unit) {
            $this->where('unit', $unit);
        }
        return $this->groupBy('nama')->findAll();
        // return $this->select('nama,unit,kode,jenis, count(nama) as total')
        // ->groupBy('nama')
        // ->findAll();
    }
    public function getDetailByName($nama, $unit = null)
    {
        $this->select('nama, unit, kode, jenis, kondisi');
        $this->where('nama', $nama);
        
        return $this->findAll();
    }

    

    

    public function getDatabyUnit (){
        return $this->select('unit')
                   ->distinct()
                   ->where('unit IS NOT NULL')
                   ->orderBy('unit', 'ASC')
                   ->findAll();
        // $units = $this->select('unit')->distinct()->findAll();
        // return $units;
        

    }

    public function getData($id = null){
        if ($id) {
            return $this->where('id', $id)->first();
        }
        return $this->orderBy('id', 'DESC')->findAll();
    }
    public function getAllData() {
        return $this->findAll();
    }

    public function search($keyword, $perPage = 10, $unit = null) {
        $builder = $this;
    
        if ($keyword) {
            $builder = $builder->groupStart()
                        ->like('nama', $keyword)
                        ->orLike('kode', $keyword)
                        ->orLike('jenis', $keyword)
                        ->orLike('unit', $keyword)
                        ->orLike('kondisi', $keyword)
                        ->groupEnd();
        }
    
        if ($unit) {
            $builder->where('unit', $unit);
        }
        if ($unit && $unit !== 'admin') {
            $builder = $builder->where('unit', $unit);
        }
    
        return $builder->paginate($perPage);
    }
    

    public function getById($id){
        return $this->where('id', $id)->first();
    }

    public function getPaginatedData($perPage = 10, $keyword = null, $unit = null)
    {
        $builder = $this;

        if ($keyword) {
            $builder = $builder->groupStart()
                        ->like('nama', $keyword)
                        ->orLike('kode', $keyword)
                        ->orLike('jenis', $keyword)
                        ->orLike('kondisi', $keyword)
                        ->groupEnd();
        }
        if ($unit && $unit !== 'admin') {
            $builder = $builder->where('unit', $unit);
        }


        return $builder->paginate($perPage);
    }

    public function dashboardPaginate($perPage = 5, $unit = null ){
        $builder = $this->select('nama, unit, kode, jenis, COUNT(nama) as total');

        if ($unit && $unit !== 'admin') {
            $builder->where('unit', $unit);
        }
    
        return $builder->groupBy('nama')->paginate($perPage);
    }
    

    public function homePaginate($perPage = 10, $keyword = null)
    {
        $builder = $this->select('nama, unit, kode, jenis, COUNT(*) as total')
                        ->groupBy('nama, unit'); // Tambahkan GROUP BY
    
        if ($keyword) {
            $builder = $builder->groupStart()
                        ->like('nama', $keyword)
                        ->orLike('jenis', $keyword)
                        ->orLike('kondisi', $keyword)
                        ->orLike('unit', $keyword)
                        ->groupEnd();
        }
    
        return $builder->paginate($perPage);
    }
    
}
