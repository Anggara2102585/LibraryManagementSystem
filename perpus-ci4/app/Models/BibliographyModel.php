<?php

namespace App\Models;

use CodeIgniter\Model;

class BibliographyModel extends Model
{
    protected $table = 'book';
    protected $primaryKey = 'id_book';
    protected $allowedFields = ['id_book', 'cover', 'title', 'isbn', 'id_category', 'publication_date', 'copies'];

    public function getAllBibliography()
    {
        return $this->findAll();
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

    public function dec_copies($id)
    {
        $this->set('copies', 'copies-1', false);
        $this->where('id_book', $id);
        $this->update();
    }

    public function inc_copies($id)
    {
        $this->set('copies', 'copies+1', false);
        $this->where('id_book', $id);
        $this->update();
    }

    public function count_total()
    {
        $builder = $this;
        $builder->selectCount('id_book');
        $query = $builder->get();
        return $query->getResultArray()[0];
    }
}
