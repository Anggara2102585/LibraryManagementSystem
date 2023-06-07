<?php

namespace App\Models;

use CodeIgniter\Model;

class LoanModel extends Model
{
    protected $table = 'loan';
    protected $primaryKey = 'id_loan';
    protected $allowedFields = ['id_loan', 'id_member', 'id_book_detail', 'loan_date', 'due_return_date', 'return_date', 'fine_amount'];

    public function getAllLoan()
    {
        return $this->findAll();
    }

    public function getLoanById($id)
    {
        return $this->where('id_loan', $id)->first();
    }

    public function getCurrentLoan($id)
    {
        $builder = $this;
        $builder->select('*');
        $builder->where('id_member', $id, FALSE);
        $builder->where('return_date is NULL', NULL, FALSE);
        $builder->join('book_detail', 'loan.id_book_detail = book_detail.id_book_detail');
        $builder->join('book', 'book_detail.id_book = book.id_book');
        $builder->join('category', 'category.id_category = book.id_category');
        $query = $builder->get();
        return $query->getResultArray();
    }

    public function getLoanHistory($id)
    {
        $sql = "SELECT
        loan.id_book_detail,
        loan.id_loan,
        loan.id_member,
        loan.loan_date,
        loan.due_return_date,
        loan.return_date,
        loan.fine_amount,
        book_detail.id_book_detail,
        book_detail.id_book,
        book_detail.`status`,
        book_detail.book_condition,
        book.id_book,
        book.cover,
        book.title,
        book.isbn,
        book.id_category,
        book.publication_date,
        book.copies,
        category.id_category,
        category.`name`
        FROM
        loan
        Inner Join book_detail ON book_detail.id_book_detail = loan.id_book_detail
        Inner Join book ON book_detail.id_book = book.id_book
        Inner Join category ON book.id_category = category.id_category
        WHERE loan.id_member = '$id'
        ";
        // $builder = $this;
        // $builder->select('*');
        // $builder->where('id_member', $id, FALSE);
        // $builder->join('book_detail', 'loan.id_book_detail = book_detail.id_book_detail');
        // $builder->join('book', 'book_detail.id_book = book.id_book');
        // $builder->join('category', 'category.id_category = book.id_category');
        $query = $this->db->simpleQuery($sql);
        return $query;
    }

    public function getTotalFineMember($id)
    {
        date_default_timezone_set('Asia/Jakarta');
        $builder = $this;
        $builder->selectSum('fine_amount');
        $builder->where('id_member', $id, FALSE);
        $where = "(due_return_date < return_date OR due_return_date < " . date('Y-m-d') . ")";
        $builder->where($where);
        // $builder->where('due_return_date <', date('Y-m-d'));
        // $builder->where('due_return_date <', 'return_date');
        $query = $builder->get();
        return $query->getResultArray();
    }
}
