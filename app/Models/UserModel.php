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
    public function search($keyword, $perPage = 10,) {
        $builder = $this->table($this->table);
        if ($keyword) {
            $builder->groupStart()
                    -> like('username', $keyword)
                    ->orLike('unit', $keyword)
                    ->groupEnd();
        }
        
        return $builder->paginate($perPage);
    }

    public function getPaginatedData($perPage = 10, $keyword = null)
    {
        $builder = $this;

        if ($keyword) {
            $builder ->groupStart()
                     ->like('username', $keyword)
                     ->orLike('unit', $keyword)
                     ->groupEnd();
        }

        return $builder->paginate($perPage);
    }
     public function getUserUnit($user_id)
    {
        $user = $this->where('id', $user_id)->first();
        if ($user && $user['unit'] !== 'admin') {
            return $user['unit'];
        }
        return null;
    }
     public function getAllUnit()
     {
        return $this->select('unit')
        ->distinct()
        ->where('unit IS NOT NULL')
        ->orderBy('unit', 'ASC')
        ->findAll();
      }


}
