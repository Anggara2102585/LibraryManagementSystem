<?php

namespace App\Models;

use CodeIgniter\Model;

class AuthorModel extends Model
{
    protected $table = 'author';
    protected $primaryKey = 'id_author';
    protected $allowedFields = ['id_author', 'name'];

    public function getAllAuthor()
    {
        return $this->findAll();
    }

    public function getAuthorById($id)
    {
        return $this->where('id_author', $id)->first();
    }
}
