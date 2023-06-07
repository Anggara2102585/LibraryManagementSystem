<?php

namespace App\Controllers;

class Admin extends BaseController
{
    public function index()
    {
        $data['pageTitle'] = 'Home';
        return view('dashboard/home', $data);
    }
}
