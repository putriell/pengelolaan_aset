<?php

namespace App\Controllers;
use App\Models\UserModel;

class User extends BaseController
{
    public function index(): string
    {
        $model = new UserModel();
            
        $data['users'] = $model ->findAll();

        return view('user', $data);
    }
    public function simpan() {
        $model = new UserModel();
        $data = [
            'username' => $this->request->getPost('username'),
            'unit' => $this->request->getPost('unit'),
            'password' => password_hash('admin123', PASSWORD_DEFAULT)
        ];
        $model->insert($data);
        return redirect() -> to ('user') -> with('success', 'Data berhasil ditambahkan');
    }
    public function hapus($id) {
        $model = new UserModel();
        $model->delete($id);
        return redirect('user') -> with('success', 'Data berhasil dihapus');
    }

    public function edit($id){
        $model = new UserModel();
        $data['user'] = $model->find($id);
        return view('user/edit', $data);
    }
    public function update($id){
        $model = new UserModel();
        $id = $this->request->getPost('id'); // Get ID from POST data

        if (!$this->validate([
            'username' => 'required',
            'unit' => 'required'
        ])) {
            return redirect()->to('/user/edit/' . $id)->withInput()->with('validation', $this->validator);
        }

        $data = [
            'username' => $this->request->getPost('username'),
            'unit' => $this->request->getPost('unit')
        ];

        $model->update($id, $data);
        session()->setFlashData('pesan', 'Data berhasil diubah');
        return redirect()->to('/user');
    }

}
