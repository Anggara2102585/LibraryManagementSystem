<?php

namespace App\Models;

use CodeIgniter\Model;

class PaymentModel extends Model
{
    protected $table = 'fine_payment';
    protected $primaryKey = 'id_payment';
    protected $allowedFields = ['id_payment', 'id_member', 'amount', 'payment_date'];

    public function getAllPayment()
    {
        return $this->findAll();
    }

    public function getPaymentById($id)
    {
        return $this->where('id_payment', $id)->first();
    }

    public function getTotalPaid($id)
    {
        $builder = $this;
        $builder->selectSum('amount');
        $builder->where('id_member', $id, FALSE);
        $query = $builder->get();
        return $query->getResultArray();
    }

    public function getPaymentByMember($id)
    {
        $builder = $this;
        $builder->select('*');
        $builder->where('id_member', $id, FALSE);
        $query = $builder->get();
        return $query->getResultArray();
    }
}
