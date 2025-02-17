<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $allowedFields = ['username', 'unit', 'password'];

    public function getUser($username){
        return $this->where('username', $username)->first();
    }
    public function updatePassword($username, $newPassword) {
        return $this->db->table('users')
        ->where('username', $username)
        ->update(['password' => $newPassword]);    
    }
    public function getById($id){
        return $this->where('id', $id)->first();
    }
    public function search($keyword, $unit = null) {
        if ($keyword) {
            return $this->like('username', $keyword)
                        ->orLike('unit', $keyword)
                        ->findAll();
        }
        
        return $this->findAll();
    }

}
