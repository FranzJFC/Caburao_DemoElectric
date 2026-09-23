<?php

namespace App\Controllers;

class Services extends BaseController
{
    public function index(): string
    {
        return view('services', [
            'title' => 'Our Services - PowerFlow Electric',
            'page'  => 'services',
        ]);
    }
}
