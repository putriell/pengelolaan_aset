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
        $unit = session()-> get('unit');
        
        
        if (empty($keyword)) {
            if ($unit === 'admin') {
                $data['data_aset'] = $model->getAllData();
            } else{
                $data['data_aset'] = $model->searchDetail(null, $unit);
            }    
        } else {
            $data['data_aset'] = $model->searchDetail($keyword, $unit);
        }
        
        
        // $data['data_aset'] = $model->search($keyword, $unit);
        
        $data['keyword'] = $keyword;
        return view('detail_aset', $data);
        
    }

}