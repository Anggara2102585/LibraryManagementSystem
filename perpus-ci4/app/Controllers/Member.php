<?php

namespace App\Controllers;

use App\Models\MemberModel;

class Member extends BaseController
{
    public function index()
    {
        $model = new MemberModel();
        $data['member'] = $model->getAllMember();
        $data['pageTitle'] = 'Member List';
        return view('Membership/list', $data);
    }

    public function addMember()
    {
        date_default_timezone_set('Asia/Jakarta');
        
        if ($this->validate([
            'member_name' => 'required|max_length[255]',
            'email' => 'required|max_length[255]'
        ])) {
            $model = new MemberModel();
            $model->insert([
                'member_name' => $this->request->getVar('member_name'),
                'email' => $this->request->getVar('email'),
                'register_date' => date("Y-m-d"),
            ]);
            session()->setFlashdata('message', 'Member successfully added');
            return redirect()->to('member');
        } else {
            session()->setFlashdata('error', 'Add author failed');
            return redirect()->to('member');
        }
    }

    public function deleteMember()
    {
        $model = new MemberModel();
        $model->delete($this->request->getVar('id_member'));

        return redirect()->to('member');
    }

    public function editMember()
    {
        if ($this->validate([
            'member_name' => 'required|max_length[255]',
            'email' => 'required|max_length[255]'
        ])) {
            $model = new MemberModel();
            $id = $this->request->getVar('id_member');
            $model->update($id, [
                'member_name' => $this->request->getVar('member_name'),
                'email' => $this->request->getVar('email'),
            ]);
            session()->setFlashdata('message', 'Member successfully updated');
            return redirect()->to('member');
        } else {
            session()->setFlashdata('error', 'Update member failed');
            return redirect()->to('member');
        }
    }
}
