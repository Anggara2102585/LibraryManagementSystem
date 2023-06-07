<?php

namespace App\Models;

use CodeIgniter\Model;

class BookDetailModel extends Model
{
    protected $table = 'book_detail';
    protected $primaryKey = 'id_book_detail';
    protected $allowedFields = ['id_book_detail', 'id_book', 'status', 'book_condition'];

    public function getAllDetail()
    {
        return $this->findAll();
    }

    public function getDetailById($id)
    {
        return $this->where('id_book_detail', $id)->first();
    }

    public function getDetailByBook($id)
    {
        $builder = $this;
        $builder->select('*');
        $builder->where('id_book', $id, FALSE);
        $query = $builder->get();
        return $query->getResultArray();
    }

    public function count_total()
    {
        $builder = $this;
        $builder->selectCount('id_book_detail');
        $query = $builder->get();
        return $query->getResultArray()[0];
    }

    public function countBorrowed()
    {
        $builder = $this;
        $builder->selectCount('id_book_detail');
        $builder->where('status =', 'BORROWED');
        $query = $builder->get();
        return $query->getResultArray()[0];
    }

    public function countAvailable()
    {
        $builder = $this;
        $builder->selectCount('id_book_detail');
        $builder->where('status =', 'AVAILABLE');
        $query = $builder->get();
        return $query->getResultArray()[0];
    }
}
