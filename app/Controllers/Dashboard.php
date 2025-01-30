<?php

namespace App\Controllers;
use App\Models\DataModel;
use App\Controllers\BaseController;

class Dashboard extends BaseController {
    public function index() {
        $model = new DataModel();

        $selectedUnit = $this->request->getGet('unit');
        
        $data['total_aset'] = $model->TotalAset($selectedUnit);
        $data['aset_tesedia'] = $model->AsetTersedia($selectedUnit);
        $data['aset_hilang'] = $model->AsetHilang($selectedUnit);
        $data['aset_rusak'] = $model->AsetRusak($selectedUnit);
        $data['data_aset'] = $model ->TotalbyName($selectedUnit);    
        $data['unit'] = $model->getDatabyUnit();
        $data['selected_unit'] = $selectedUnit;
   

       
        return view('dashboard', $data);
    
    }
}