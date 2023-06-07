<?php

namespace App\Models;

use CodeIgniter\Model;

class AuthorBookModel extends Model
{
    protected $table = 'link_book_author';
    protected $allowedFields = ['id_book', 'id_author'];

    public function getAllAuthorBook()
    {
        return $this->findAll();
    }

    public function getByBook($id)
    {
        $builder = $this;
        $builder->select('*');
        $builder->where('id_book =', $id);
        $query = $builder->get();
        return $query->getResultArray();
    }
    
    public function getByAuthor($id)
    {
        $builder = $this;
        $builder->select('*');
        $builder->where('id_author =', $id);
        $query = $builder->get();
        return $query->getResultArray();
    }
    
    public function getAllBibliographyVal()
    {
        $builder = $this;
        $builder->select('*');
        $builder->join('category', 'category.id_category = book.id_category');
        $query = $builder->get();
        return $query->getResultArray();
    }

    public function getBibliographyById($id)
    {
        return $this->where('id_book', $id)->first();
    }

    public function getAvailableItems()
    {
        $builder = $this;
        $builder->select('*');
        $builder->join('category', 'category.id_category = book.id_category');
        $builder->where('copies >', 0);
        $query = $builder->get();
        return $query->getResultArray();
    }

    public function delAuthorByBook($id)
    {
        $builder = $this;
        $builder->where('id_book', $id);
        $builder->delete();
    }
}
