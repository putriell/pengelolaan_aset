<?php

namespace App\Controllers;
use App\Models\DataModel;
class Home extends BaseController
{
    public function index(): string
    {
        $model = new DataModel();
        $data['data_aset'] =  $model->TotalbyName();

        return view('welcome_message', $data);
    }
}
