<?php

namespace App\Controllers;

use App\Models\BibliographyModel;
use App\Models\CategoryModel;
use App\Models\AuthorModel;
use App\Models\AuthorBookModel;
use App\Models\BookDetailModel;

class Bibliography extends BaseController
{
    public function index()
    {
        $model = new BibliographyModel();
        $data['items'] = $model->getAllBibliographyVal();
        $data['pageTitle'] = 'Bibliograpic';
        return view('bibliography/bibliography', $data);
    }

    public function add()
    {
        $model = new CategoryModel();
        $data['category'] = $model->getAllCategory();

        $model = new AuthorModel();
        $data['author'] = $model->getAllAuthor();

        $data['pageTitle'] = 'Add Item';
        return view('bibliography/add', $data);
    }

    public function addProcess()
    {
        if ($this->validate([
            'title' => 'required|max_length[255]',
            'cover' => 'is_image[cover]|mime_in[cover,image/jpg,image/jpeg,image/png]'
        ])) {
            $fileCover = $this->request->getFile('cover');
            if ($fileCover->getError() == 4) {      // kalau gak ada gambar yang diupload
                $coverName = 'default.png';
            } else {
                $coverName = $fileCover->getName();
                $fileCover->move('img');    // pindah ke folder img
            }

            $model = new BibliographyModel();
            $copies = $this->request->getVar('copies');
            $model->insert([
                'cover' => $coverName,
                'title' => $this->request->getVar('title'),
                'isbn' => $this->request->getVar('isbn'),
                'id_category' => $this->request->getVar('id_category'),
                'publication_date' => $this->request->getVar('publication_date'),
                'copies' => $copies,
            ]);

            $id_book = $model->getInsertID();

            $model = new AuthorBookModel();
            if ($author = $this->request->getVar('author')) {
                foreach ($author as $id_author) {
                    $model->insert([
                        'id_book' => $id_book,
                        'id_author' => $id_author,
                    ]);
                }
            }

            $model = new BookDetailModel();
            for ($i=0; $i<$copies; $i++) {
                $model->insert(['id_book' => $id_book]);
            }

            session()->setFlashdata('message', 'Item successfully added');
            return redirect()->to('bibliography/add');
        } else {
            session()->setFlashdata('error', 'Add item failed');
            return redirect()->to('bibliography/add');
        }
    }

    public function delete()
    {
        $id = $this->request->getVar('id_book');
        $model = new BibliographyModel();

        $item = $model->find($id);

        if ($item['cover'] != 'default.png') {
            unlink('img/' . $item['cover']);
        }

        $model->delete($id);

        return redirect()->to('bibliography');
    }

    public function edit($id)
    {
        $model = new CategoryModel();
        $data['category'] = $model->getAllCategory();

        $model = new AuthorModel();
        $data['author'] = $model->getAllAuthor();

        $model = new BibliographyModel();
        $data['item'] = $model->getBibliographyById($id);

        $model = new AuthorBookModel();
        $fetchdata = $model->getByBook($id);
        $data['authored'] = [];
        foreach ($fetchdata as $row) {
            $data['authored'][] = $row['id_author'];
        }

        $data['pageTitle'] = 'Edit Item';
        return view('bibliography/edit', $data);
    }

    public function editProcess()
    {
        if ($this->validate([
            'title' => 'required|max_length[255]',
            'cover' => 'is_image[cover]|mime_in[cover,image/jpg,image/jpeg,image/png]'
        ])) {
            $fileCover = $this->request->getFile('cover');
            $oldCover = $this->request->getVar('oldCover');
            if ($fileCover->getError() == 4) {      // kalau gak ada gambar yang diupload
                $coverName = $oldCover;
            } else {
                $coverName = $fileCover->getName();
                $fileCover->move('img');    // pindah ke folder img
                if ($oldCover != 'default.png') {
                    unlink('img/' . $oldCover);    // hapus sampul lama
                }
            }

            $model = new BibliographyModel();
            $id = $this->request->getVar('id_book');
            $model->update($id, [
                'cover' => $coverName,
                'title' => $this->request->getVar('title'),
                'isbn' => $this->request->getVar('isbn'),
                'id_category' => $this->request->getVar('id_category'),
                'publication_date' => $this->request->getVar('publication_date'),
                'copies' => $this->request->getVar('copies'),
            ]);

            $model = new AuthorBookModel();
            $model->delAuthorByBook($id);
            if ($author = $this->request->getVar('author')) {
                foreach ($author as $id_author) {
                    $model->insert([
                        'id_book' => $id,
                        'id_author' => $id_author,
                    ]);
                }
            }

            session()->setFlashdata('message', 'Item successfully updated');
            return redirect()->to('bibliography/edit/' . $id);
        } else {
            session()->setFlashdata('error', 'Update item failed');
            return redirect()->to('bibliography/edit/' . $this->request->getVar('id_book'));
        }
    }
    
    public function detail($id)
    {
        $model = new BookDetailModel();
        $data['items'] = $model->getDetailByBook($id);

        $model = new BibliographyModel();
        $book = $model->getBibliographyById($id);
        
        $data['idBook'] = $id;
        $data['pageTitle'] = 'Item List for "' . $book['title'] . '"';
        return view('bibliography/detail', $data);
    }

    public function addDetail()
    {
        $idBook = $this->request->getVar('id_book');
        if ($this->validate([
            'status' => 'max_length[255]',
            'book_condition' => 'max_length[255]'
        ])) {
            $model = new BookDetailModel();
            $model->insert([
                'id_book' => $this->request->getVar('id_book'),
                'status' => $this->request->getVar('status'),
                'book_condition' => $this->request->getVar('book_condition'),
            ]);

            $model = new BibliographyModel();
            $model->inc_copies($idBook);
            
            session()->setFlashdata('message', 'Item successfully added');
            return redirect()->to("bibliography/detail/$idBook");
        } else {
            session()->setFlashdata('error', 'Add item failed');
            return redirect()->to("bibliography/detail/$idBook");
        }
    }

    public function editDetail()
    {
        $idBook = $this->request->getVar('id_book');
        if ($this->validate([
            'status' => 'max_length[255]',
            'book_condition' => 'max_length[255]'
        ])) {
            $model = new BookDetailModel();
            $id = $this->request->getVar('id_book_detail');
            $model->update($id, [
                'status' => $this->request->getVar('status'),
                'book_condition' => $this->request->getVar('book_condition'),
            ]);

            session()->setFlashdata('message', 'Item successfully updated');
            return redirect()->to("bibliography/detail/$idBook");
        } else {
            session()->setFlashdata('error', 'Update item failed');
            return redirect()->to("bibliography/detail/$idBook");
        }
    }

    public function deleteDetail()
    {
        $id = $this->request->getVar('id_book_detail');
        $idBook = $this->request->getVar('id_book');

        $model = new BookDetailModel();
        $model->delete($id);

        $model = new BibliographyModel();
        $model->dec_copies($idBook);

        session()->setFlashdata('message', 'Item successfully deleted');
        return redirect()->to("bibliography/detail/$idBook");
    }
}
