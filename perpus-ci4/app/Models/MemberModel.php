<?php

namespace App\Models;

use CodeIgniter\Model;

class MemberModel extends Model
{
    protected $table = 'member';
    protected $primaryKey = 'id_member';
    protected $allowedFields = ['id_member', 'member_name', 'email', 'register_date'];

    public function getAllMember()
    {
        return $this->findAll();
    }

    public function getMemberById($id)
    {
        return $this->where('id_member', $id)->first();
    }
}
