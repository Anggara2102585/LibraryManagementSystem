<?php

namespace App\Models;

use CodeIgniter\Model;

class RulesModel extends Model
{
    protected $table = 'rules';
    protected $primaryKey = 'id_rules';
    protected $allowedFields = ['id_rules', 'loan_periode', 'fine_amount'];

    public function getAllRules()
    {
        return $this->findAll();
    }

    public function getRulesById($id)
    {
        return $this->where('id_rules', $id)->first();
    }
}
