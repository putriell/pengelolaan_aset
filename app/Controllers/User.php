<?php

namespace App\Controllers;
use App\Models\UserModel;

class User extends BaseController
{
    public function index(): string
    {
        $model = new UserModel();
        
        $keyword = $this->request->getVar('search');
            
        $data['users'] = $model ->findAll();
        $perPage = 10;
        $data = [
            'users'        => $model->getPaginatedData($perPage, $keyword), // Pass keyword to the model
            'pager'       => $model->pager,
            'page'        => $this->request->getVar('page') ?? 1,
            'totalPages'  => $model->pager->getPageCount(),
            'search'      => $keyword ?? '',
        ];
        $data['keyword'] = '';

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

    public function edit($id) {
        $model = new UserModel();
        $data['users'] = $model->getById($id);

    // Jika data tidak ditemukan
        if (empty($data['users'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data tidak ditemukan');
        }

        return view('edit_user', $data);
    }

    public function update() {
        $model = new UserModel();
        
        // Ambil data dari form
        $id = $this->request->getPost('id');
        if (!$id || !$model->find($id)) {
            return redirect()->back()->with('errors', ['ID tidak ditemukan']);
        }
        if (!$this->validate([
            'username'    => 'required',
            'unit'        => 'required',
        ])) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Data yang akan diupdate
        $data = [
            'username'    => $this->request->getPost('username'),
            'unit'    => $this->request->getPost('unit')
        ];

        // Update data
        $model->update($id, $data);

        // Redirect kembali ke halaman data aset
        return redirect()->to(base_url('user'))->with('success', 'Data berhasil diupdate');
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
    public function search() {
        $model = new UserModel();
        $keyword = $this->request->getGet('keyword');
        $perPage = (int) ($this->request->getVar('per_page') ?? 10);
        if ($perPage <= 0) {
            $perPage = 10; // Set nilai default jika nol atau negatif
        }
        if ($keyword) {
            $data['users'] = $model->search($keyword);
        } else {
            $data['users'] = $model->findAll(); // Jika tidak ada keyword, ambil semua
        }

        $data['users'] = $model->getPaginatedData($perPage, $keyword);
        $data['pager'] = $model->pager;
        $data['page'] = $this->request->getVar('page') ?? 1;
        $data['totalPages'] = $model->pager->getPageCount();
        $data['keyword'] = $keyword;
        return view('user', $data);
    }


}
