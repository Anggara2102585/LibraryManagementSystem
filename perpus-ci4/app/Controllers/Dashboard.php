<?php

namespace App\Controllers;

use App\Models\AuthorModel;
use App\Models\BibliographyModel;
use App\Models\BookDetailModel;
use App\Models\CategoryModel;
use App\Models\RulesModel;

class Dashboard extends BaseController
{
    public function index()
    {
        $model = new BibliographyModel();
        $data['collections'] = $model->count_total();

        $model = new BookDetailModel();
        $data['items'] = $model->count_total();

        $model = new BookDetailModel();
        $data['borrowed'] = $model->countBorrowed();

        $model = new BookDetailModel();
        $data['available'] = $model->countAvailable();
        
        $data['pageTitle'] = 'Home';
        return view('dashboard/home', $data);
    }

    public function author()
    {
        $model = new AuthorModel();
        $data['author'] = $model->getAllAuthor();
        $data['pageTitle'] = 'Author List';
        return view('dashboard/author', $data);
    }

    public function addAuthor()
    {
        if ($this->validate([
            'name' => 'required|max_length[100]'
        ])) {
            $model = new AuthorModel();
            $model->insert([
                'name' => $this->request->getVar('name'),
            ]);
            session()->setFlashdata('message', 'Author successfully added');
            return redirect()->to('dashboard/author');
        } else {
            session()->setFlashdata('error', 'Add author failed');
            return redirect()->to('dashboard/author');
        }
    }

    public function deleteAuthor()
    {
        $model = new AuthorModel();
        $model->delete($this->request->getVar('id_author'));

        return redirect()->to('dashboard/author');
    }

    public function editAuthor()
    {
        if ($this->validate([
            'name' => 'required|max_length[100]'
        ])) {
            $model = new AuthorModel();
            $id = $this->request->getVar('id_author');
            $model->update($id, [
                'name' => $this->request->getVar('name'),
            ]);
            session()->setFlashdata('message', 'Author successfully updated');
            return redirect()->to('dashboard/author');
        } else {
            session()->setFlashdata('error', 'Update author failed');
            return redirect()->to('dashboard/author');
        }
    }

    public function category()
    {
        $model = new CategoryModel();
        $data['category'] = $model->getAllCategory();
        $data['pageTitle'] = 'Category List';
        return view('dashboard/category', $data);
    }

    public function addCategory()
    {
        if ($this->validate([
            'name' => 'required|max_length[50]'
        ])) {
            $model = new CategoryModel();
            $model->insert([
                'name' => $this->request->getVar('name'),
            ]);
            session()->setFlashdata('message', 'Category successfully added');
            return redirect()->to('dashboard/category');
        } else {
            session()->setFlashdata('error', 'Add category failed');
            return redirect()->to('dashboard/category');
        }
    }

    public function deleteCategory()
    {
        $model = new CategoryModel();
        $model->delete($this->request->getVar('id_category'));

        return redirect()->to('dashboard/category');
    }

    public function editCategory()
    {
        if ($this->validate([
            'name' => 'required|max_length[50]'
        ])) {
            $model = new CategoryModel();
            $id = $this->request->getVar('id_category');
            $model->update($id, [
                'name' => $this->request->getVar('name'),
            ]);
            session()->setFlashdata('message', 'Category successfully updated');
            return redirect()->to('dashboard/category');
        } else {
            session()->setFlashdata('error', 'Update category failed');
            return redirect()->to('dashboard/category');
        }
    }

    public function rules()
    {
        $model = new RulesModel();
        $data['rules'] = $model->getRulesById(1);
        $data['pageTitle'] = 'Loan Rules';
        return view('dashboard/rules', $data);
    }

    public function updateRules()
    {
        if ($this->validate([
            'loan_periode' => 'required|max_length[11]',
            'fine_amount' => 'required|max_length[11]',
        ])) {
            $model = new RulesModel();
            $model->update(1, [
                'loan_periode' => $this->request->getVar('loan_periode'),
                'fine_amount' => $this->request->getVar('fine_amount'),
            ]);
            session()->setFlashdata('message', 'Rules successfully updated');
            return redirect()->to('dashboard/rules');
        } else {
            session()->setFlashdata('error', 'Update rules failed');
            return redirect()->to('dashboard/rules');
        }
    }
}
