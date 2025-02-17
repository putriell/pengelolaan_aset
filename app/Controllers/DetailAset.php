<?php

namespace App\Controllers;
use App\Models\DataModel;
class DetailAset extends BaseController
{
    public function index($nama)
    {
        $unit = session()->get('unit');
        $model = new DataModel();
        $data['data_aset'] = $model->getDetailByName($nama, $unit);
        $data['nama'] = $nama;
        return view('detail_aset', $data);
    }
    public function search() {
        $model = new DataModel();
        $keyword = $this->request->getGet('keyword');
        if ($keyword) {
            $data['data_aset'] = $model->search($keyword);
        } else {
            $data['data_aset'] = $model->findAll(); // Jika tidak ada keyword, ambil semua
        }
        $data['keyword'] = $keyword;
        return view('/detail_aset', $data);
    }
}