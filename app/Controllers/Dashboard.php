<?php

namespace App\Controllers;
use App\Models\DataModel;
use App\Controllers\BaseController;

class Dashboard extends BaseController {
    protected $dataAsetModel;
    public function __construct()
    {
        $this->dataAsetModel = new DataModel(); // Inisialisasi model
    }
    public function index() {
        $model = new DataModel();
        $unit = session()->get('unit');
        if($unit === 'admin'){
            $selectedUnit = $this->request->getGet('unit');
            
            $data['total_aset'] = $model->TotalAset($selectedUnit);
            $data['aset_tesedia'] = $model->AsetTersedia($selectedUnit);
            $data['aset_hilang'] = $model->AsetHilang($selectedUnit);
            $data['aset_rusak'] = $model->AsetRusak($selectedUnit);
            $data['data_aset'] = $model ->TotalbyName($selectedUnit);    
            $data['unit'] = $model->getDatabyUnit();
            $data['selected_unit'] = $selectedUnit;
            
        } else{
            $data['total_aset'] = $model->TotalAset($unit);
            $data['aset_tesedia'] = $model->AsetTersedia($unit);
            $data['aset_hilang'] = $model->AsetHilang($unit);
            $data['aset_rusak'] = $model->AsetRusak($unit);
            $data['data_aset'] = $model ->TotalbyName($unit); 

        }
        return view('dashboard', $data);
    
    }
}