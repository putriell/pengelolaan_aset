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

    public function ganti_password(){
        $model = new UserModel();
        $validation = [
            'password_lama' => 'required',
            'password_baru' => 'required',
            'konfirmasi_password' => 'required'
        ];
        if (!$this->validate($validation)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        } else {
            $username = session()->get('username'); // Ambil username dari session
     $passwordLama = $this->request->getPost('password_lama');
        $passwordBaru = $this->request->getPost('password_baru');
    
            // Ambil data user berdasarkan username
            $user = $model->where('username', $username)->first();
    
            if ($user && password_verify($passwordLama, $user['password'])) {
                // Update password jika password lama sesuai
                $newPassword = password_hash($passwordBaru, PASSWORD_DEFAULT);
                $model->updatePassword($username, $newPassword);
    
                return redirect()->to('/dashboard')->with('success', 'Password berhasil diubah.');
            } else {
                // Password lama salah
                return redirect()->back()->with('error', 'Password lama tidak sesuai.');
            }
        }
    }
    public function reset_password($id) {
        $model = new UserModel();
        $newPassword = password_hash('admin123', PASSWORD_DEFAULT);
        $model->update($id, ['password' =>$newPassword]);

        session()->setFlashdata('message', 'Password telah direset menjadi admin123.');
        return redirect()->to('/user');
    }

}
