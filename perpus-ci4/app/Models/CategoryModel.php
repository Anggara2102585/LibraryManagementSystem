<?php

namespace App\Models;

use CodeIgniter\Model;

class CategoryModel extends Model
{
    protected $table = 'category';
    protected $primaryKey = 'id_category';
    protected $allowedFields = ['id_category', 'name'];

    public function getAllCategory()
    {
        return $this->findAll();
    }

    public function getCategoryById($id)
    {
        return $this->where('id_category', $id)->first();
    }
}
