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
            $keyword = $this->request->getVar('search');

            $unit = session()->get('unit');
            if ($unit === 'admin') {
                $data['data_aset'] = $this->dataAsetModel->findAll();
            } 
            else{
                $data['data_aset'] = $this->dataAsetModel->where('unit', $unit)->findAll();
            }
            
            
            $perPage = 10; // Jumlah data per halaman
            

            // Ambil data dengan pagination
            $data = [
                'data_aset'   => $model->getPaginatedData($perPage, $keyword), // Pass keyword to the model
                'pager'       => $model->pager,
                'page'        => $this->request->getVar('page') ?? 1,
                'totalPages'  => $model->pager->getPageCount(),
                'search'      => $keyword ?? '',
            ];
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
            $data['data_aset'] = $model->getById($id);

        // Jika data tidak ditemukan
            if (empty($data['data_aset'])) {
                throw new \CodeIgniter\Exceptions\PageNotFoundException('Data tidak ditemukan');
            }

            return view('edit_data', $data);
        }
        public function update() {
            $model = new DataModel();
            
            // Ambil data dari form
            $id = $this->request->getPost('id');
            if (!$this->validate([
                'nama'    => 'required',
                'kode'    => 'required',
                'jenis'   => 'required',
                'unit'    => 'required',
                'kondisi' => 'required',
            ])) {
                return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
            }
    
            // Data yang akan diupdate
            $data = [
                'nama'    => $this->request->getPost('nama'),
                'kode'    => $this->request->getPost('kode'),
                'jenis'   => $this->request->getPost('jenis'),
                'unit'    => $this->request->getPost('unit'),
                'kondisi' => $this->request->getPost('kondisi'),
            ];
    
            // Update data
            $model->update($id, $data);
    
            // Redirect kembali ke halaman data aset
            return redirect()->to(base_url('data_aset'))->with('success', 'Data berhasil diupdate');
        }

        public function search() {
            $model = new DataModel();
            $keyword = $this->request->getGet('keyword'); // Ambil keyword dari query string
            $unit = session()->get('unit');
        
            $perPage = (int) ($this->request->getVar('per_page') ?? 10);
            if ($perPage <= 0) {
                $perPage = 10; // Set nilai default jika nol atau negatif
            }
        
            // Ambil data dengan pagination berdasarkan keyword
            $data['data_aset'] = $model->getPaginatedData($perPage, $keyword);
        
            // Data tambahan untuk pagination
            $data['pager'] = $model->pager;
            $data['page'] = $this->request->getVar('page') ?? 1;
            $data['totalPages'] = $model->pager->getPageCount();
            $data['keyword'] = $keyword;
        
            return view('data_aset', $data);
        }
        

        public function getDetail($nama){
            $unit = session()->get('unit');
            $model = new DataModel();
            $data['data_aset'] = $model->getDetailByName($nama, $unit);
            $data['nama'] = $nama;
            return view('detail_aset', $data);
        }

        
}