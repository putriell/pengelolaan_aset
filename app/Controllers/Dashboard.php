<?php

namespace App\Controllers;
use App\Models\DataModel;
use App\Controllers\BaseController;

class Dashboard extends BaseController {
    public function index() {
        $model = new DataModel();
        
        $data['total_aset'] = $model->TotalAset();
        $data['aset_tesedia'] = $model->AsetTersedia();
        $data['aset_hilang'] = $model->AsetHilang();
        $data['aset_rusak'] = $model->AsetRusak();
        $data['data_aset'] = $model ->TotalbyName();

       
        return view('dashboard', $data);
    
    }
}