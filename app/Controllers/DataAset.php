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
            
            $unit = session()->get('unit');
            if ($unit === 'admin') {
                $data['data_aset'] = $this->dataAsetModel->findAll();
            } 
            else{
                $data['data_aset'] = $this->dataAsetModel->where('unit', $unit)->findAll();
            }
            

            
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

        public function edit($id) {
            $model = new DataModel();
            $data = $model->getData($id);

            // return view('data_aset/edit', ); 
            return $this->response->setJSON(['data' => $data]); // Mengirimkan data dalam format JSON
        }
        public function update() {
            $model = new DataModel();
            
            // Ambil data dari form
            $id = $this->request->getPost('id');
            $data = [
                'nama' => $this->request->getPost('nama'),
                'kode' => $this->request->getPost('kode'),
                'jenis' => $this->request->getPost('jenis'),
                'unit' => $this->request->getPost('unit'),
                'kondisi' => $this->request->getPost('kondisi')
            ];
    
            if (!$id || !$model->find($id)) {
                return redirect()->back()->with('error', 'Data tidak valid.');
            }
        
            // Update data di database
            $model->update($id, $data);
    
            session()->setFlashdata('message', 'Data aset berhasil diperbarui.');
            return redirect()->to('/data_aset'); // Ganti dengan URL yang sesuai
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