<?php

namespace App\Controllers;

use App\Models\BibliographyModel;
use App\Models\LoanModel;
use App\Models\MemberModel;
use App\Models\PaymentModel;
use App\Models\RulesModel;
use App\Models\BookDetailModel;

$session = session();

class Circulation extends BaseController
{
    public function index()
    {
        $data['pageTitle'] = 'Circulation';
        return view('circulation/start', $data);
    }

    public function set()
    {
        $id = $this->request->getVar('member_id');
        $model = new MemberModel();
        $data = $model->getMemberById($id);
        if (isset($data['id_member'])) {
            session()->set('member_id', $id);
            return redirect()->to('circulation/loan');
        } else {
            return redirect()->to('circulation/index');
        }
    }

    public function loan()
    {
        if (session()->get('member_id')) {
            $member = session()->get('member_id');
            
            $model = new MemberModel();
            $data['member'] = $model->getMemberById($member);

            $model = new BibliographyModel();
            $data['items'] = $model->getAvailableItems();

            $model = new LoanModel();
            $data['loan'] = $model->getCurrentLoan($member);
            $data['loan_history'] = $model->getLoanHistory($member);
            $fine = $model->getTotalFineMember($member)[0];

            $model = new PaymentModel();
            $data['payment_history'] = $model->getPaymentByMember($member);
            $paid = $model->getTotalPaid($member)[0];

            $data['unpaid'] = $fine['fine_amount'] - $paid['amount'];

            $data['pageTitle'] = 'Circulation';
            return view('circulation/loan', $data);
        } else {
            return redirect()->to('circulation/index');
        }
    }

    public function processLoan()
    {
        $id = $this->request->getVar('id_book_detail');
        $model = new BookDetailModel();
        $detail = $model->getDetailById($id);

        if(!$detail) {
            session()->setFlashdata('error', 'Item not found');
            return redirect()->to('circulation/loan');
        }
        
        if ((session()->get('member_id')) && ($detail['status'] == 'AVAILABLE')) {
            date_default_timezone_set('Asia/Jakarta');
            $date = date('Y-m-d');
            $rules = new RulesModel();
            $rule = $rules->getRulesById(1);
            
            $model = new LoanModel();
            $model->insert([
                'id_member' => session()->get('member_id'),
                'id_book_detail' => $id,
                'loan_date' => $date,
                'due_return_date' => date('Y-m-d', strtotime($date . ' + ' . $rule['loan_periode'] . ' days')),
                'fine_amount' => $rule['fine_amount'],
            ]);

            $model = new BookDetailModel();
            $model->update($id,[
                'status' => "BORROWED",
            ]);

            session()->setFlashdata('message', 'Item successfully borrowed');
            return redirect()->to('circulation/loan');
        } else {
            session()->setFlashdata('error', 'Failed to borrow item');
            return redirect()->to('circulation/loan');
        }
    }

    public function return($id, $idItem)
    {
        if (session()->get('member_id')) {
            date_default_timezone_set('Asia/Jakarta');
            
            $model = new LoanModel();
            $model->update($id,[
                'return_date' => date("Y-m-d"),
            ]);

            $model = new BookDetailModel();
            $model->update($idItem,[
                'status' => "AVAILABLE",
            ]);
            
            session()->setFlashdata('message', 'Item successfully returned');
            return redirect()->to('circulation/loan');
        }
    }

    public function payment()
    {
        if (session()->get('member_id')) {
            date_default_timezone_set('Asia/Jakarta');
            
            $model = new PaymentModel();
            $model->insert([
                'id_member' => session()->get('member_id'),
                'amount' => $this->request->getVar('amount'),
                'payment_date' => date('Y-m-d'),
            ]);

            return redirect()->to('circulation/loan');
        }
    }

    public function finish()
    {
        session_destroy();
        return redirect()->to('circulation/loan');
    }
}
