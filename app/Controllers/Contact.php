<?php

namespace App\Controllers;

use CodeIgniter\HTTP\RedirectResponse;

class Contact extends BaseController
{
    public function index(): string|RedirectResponse
    {
        if ($this->request->getMethod() === 'POST') {
            return $this->submitForm();
        }

        return view('contact', [
            'title'      => 'Contact Us - PowerFlow Electric',
            'page'       => 'contact',
            'success'    => session()->getFlashdata('success'),
            'error'      => session()->getFlashdata('error'),
            'validation' => session()->getFlashdata('validation'),
        ]);
    }

    private function submitForm(): RedirectResponse
    {
        $validation = \Config\Services::validation();
        $validation->setRules([
            'name'         => 'required|min_length[2]|max_length[100]',
            'email'        => 'required|valid_email|max_length[255]',
            'phone'        => 'required|min_length[10]|max_length[20]',
            'service_type' => 'required|in_list[residential,commercial,industrial,solar,emergency,other]',
            'message'      => 'required|min_length[10]|max_length[1000]',
        ]);

        if (! $validation->withRequest($this->request)->run()) {
            return redirect()
                ->back()
                ->withInput()
                ->with('validation', $validation->getErrors());
        }

        return redirect()->to('/contact')->with(
            'success',
            'Thank you for your message! We will contact you within 24 hours.'
        );
    }
}
