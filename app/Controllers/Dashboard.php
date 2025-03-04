<?php

namespace App\Controllers;
use App\Models\DataModel;
use App\Models\UserModel;
use App\Controllers\BaseController;

class Dashboard extends BaseController {
    protected $dataAsetModel;
    protected $userModel;
    public function __construct()
    {
        $this->dataAsetModel = new DataModel();
        $this->userModel = new UserModel();
    }
    public function index() {
        $model = new DataModel();
        $userModel = new UserModel();
        $unit = session()->get('unit');
        $userId = session()->get('user_id');
        // dd($unit, $userId);
        $perPage = 5;  
        // $selectedUnit = $userModel->getUserUnit($userId);
        
        if($unit === 'admin'){
            $selectedUnit = $this->request->getGet('unit') ?? $userModel->getUserUnit($userId);
            $data['unit'] = $userModel->getAllUnit();
            $data['total_aset'] = $model->TotalAset($selectedUnit);
            $data['aset_tesedia'] = $model->AsetTersedia($selectedUnit);
            $data['aset_hilang'] = $model->AsetHilang($selectedUnit);
            $data['aset_rusak'] = $model->AsetRusak($selectedUnit);
            $data['data_aset'] = $model ->TotalbyName($selectedUnit); 
            
            $data['selected_unit'] = $selectedUnit;
            $data ['data_aset'] = $model->dashboardPaginate($perPage, $selectedUnit);
            // dd($userModel->getAllUnit());

        } else{
            $data['total_aset'] = $model->TotalAset($unit);
            $data['aset_tesedia'] = $model->AsetTersedia($unit);
            $data['aset_hilang'] = $model->AsetHilang($unit);
            $data['aset_rusak'] = $model->AsetRusak($unit);
            $data['data_aset'] = $model ->TotalbyName($unit); 
            $data ['data_aset'] = $model->dashboardPaginate($perPage, $unit);
            
        }
        // Jumlah data per halaman
        $data['pager'] = $model->pager;
        $data['page'] = $this->request->getVar('page') ?? 1;
        $data['totalPages'] = $model->pager->getPageCount();

        return view('dashboard', $data);
    
    }

    



}