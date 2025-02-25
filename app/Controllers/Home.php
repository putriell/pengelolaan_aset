<?php

namespace App\Controllers;
use App\Models\DataModel;
class Home extends BaseController
{
    public function index(): string
    {
        $model = new DataModel();
        
        $keyword = $this->request->getVar('search');
        $data['data_aset'] =  $model->TotalbyName();
        $perPage = 10; // Jumlah data per halaman
            

        // Ambil data dengan pagination
        $data = [
            'data_aset'   => $model->homePaginate($perPage, $keyword), // Pass keyword to the model
            'pager'       => $model->pager,
            'page'        => $this->request->getVar('page') ?? 1,
            'totalPages'  => $model->pager->getPageCount(),
            'search'      => $keyword ?? '',
        ];
        $data['keyword'] = '';

        return view('welcome_message', $data);
    }
    public function search() {
        $model = new DataModel();
        $keyword = $this->request->getGet('keyword'); // Ambil keyword dari query string
    
        $perPage = (int) ($this->request->getVar('per_page') ?? 10);
        if ($perPage <= 0) {
            $perPage = 10; // Set nilai default jika nol atau negatif
        }
        // Data tambahan untuk pagination
        $data['data_aset'] = $model->homePaginate($perPage, $keyword);
        $data['pager'] = $model->pager;
        $data['page'] = $this->request->getVar('page') ?? 1;
        $data['totalPages'] = $model->pager->getPageCount();
        $data['keyword'] = $keyword;
    
        return view('welcome_message', $data);
    }
}
