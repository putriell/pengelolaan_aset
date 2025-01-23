<?php

namespace App\Controllers;

use App\Models\DataModel;

use App\Controllers\BaseController;

class DataAset extends BaseController 
{
        protected $dataAsetModel;

        public function __construct()
        {
            $this->dataAsetModel = new DataModel(); // Inisialisasi model
        }

        public function index() {
            $model = new DataModel();
            
            $data['data_aset'] = $model ->findAll();
            $data['keyword'] = '';

            return view('data_aset', $data);
        
        }
        public function simpan() {
            $model = new DataModel();
            $data = [
                'nama' => $this->request->getPost('nama'),
                'kode' => $this->request->getPost('kode'),
                'jenis' => $this->request->getPost('jenis'),
                'unit' => $this->request->getPost('unit'),
                'kondisi' => $this->request->getPost('kondisi'),
            ];
            $model->insert($data);
            return redirect() -> to ('data_aset') -> with('success', 'Data berhasil ditambahkan');
        }

        public function hapus($id) {
            $model = new DataModel();
            $model->delete($id);
            return redirect('data_aset') -> with('success', 'Data berhasil dihapus');
        }

        public function edit($id){
            $model = new DataModel();
           
            $item =  $model->find($id);
            if (!$item) {
                return $this->response->setJSON(['error'=> 'Data tidak ditemukan'], 404);
            }
    
            // return view('data_aset/edit', $data);
            // if(!$data) {
            //     return $this ->response->setJSON(['error' => 'Data not found']);
            // return view('data_aset', $data);
            // }
            return $this ->response->setJSON(['item' => $item]);
        }
        public function update(){
            $model = new DataModel();
            
            $data = [
                'nama' => $this->request->getPost('nama'),
                'kode' => $this->request->getPost('kode'),
                'jenis' => $this->request->getPost('jenis'),
                'unit' => $this->request->getPost('unit'),
                'kondisi' => $this->request->getPost('kondisi'),
            ];
            $id = $this->request->getPost('id');
            $model->update($id, $data);
            return redirect('data_aset') -> to('data_aset');
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
            return view('/data_aset', $data);
        }
}