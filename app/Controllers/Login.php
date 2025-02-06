<?php

namespace App\Controllers;

use App\Models\UserModel;

class Login extends BaseController
{
    public function index()
    {
        
        if ($this->session->get('logged_in')) {
            return redirect()->to('dashboard');
        }
        return view('login');
        
    }

    public function auth(){
        $validation = \Config\Services::validation();

        // Aturan validasi
        $rules = [
            'username' => [
                'label' => 'Username',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],
            'password' => [
                'label' => 'Password',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],
        ];

        if (!$this->validate($rules)) {
            // Jika validasi gagal, kembalikan ke form login dengan pesan error
            return redirect()->back()->withInput()->with('validation', $this->validator);
        }

        $model = new UserModel();
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $user = $model->where('username', $username) -> first();

        // Ambil data pengguna dari database berdasarkan username
        $user = $model->getUser($username);

        if ($user && password_verify($password, $user['password'])) {
            // Jika berhasil login, buat session dan redirect ke dashboard
            session()->set([
                'user_id' => $user['id'],
                'username' => $user['username'], // Simpan nama user
                'unit'      => $user['unit'],
                'logged_in' => true
            ]);
            return redirect()->to('/dashboard');
        } else {
            // Jika gagal login, kembali ke form login dengan pesan error
            session()->setFlashdata('error', 'Username atau password salah');
            return redirect()->to('login');
        }
        
        

    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('login')->with('success', 'Berhasil logout.');
    }
    
        
        
}
