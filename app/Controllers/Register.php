<?php

namespace App\Controllers;

use App\Models\User;
use CodeIgniter\HTTP\RedirectResponse;

class Register extends BaseController
{
    public function index(): string
    {
        return view('register', [
            'title'      => 'Register - PowerFlow Electric',
            'page'       => 'register',
            'success'    => session()->getFlashdata('success'),
            'error'      => session()->getFlashdata('error'),
            'validation' => session()->getFlashdata('validation'),
        ]);
    }

    public function create(): RedirectResponse
    {
        $rules = [
            'first_name'       => 'required|min_length[2]|max_length[100]',
            'last_name'        => 'required|min_length[2]|max_length[100]',
            'email'            => 'required|valid_email|max_length[255]|is_unique[users.email]',
            'phone'            => 'required|min_length[10]|max_length[20]',
            'address'          => 'required|min_length[5]|max_length[255]',
            'city'             => 'required|min_length[2]|max_length[100]',
            'state'            => 'required|min_length[2]|max_length[50]',
            'zip_code'         => 'required|min_length[4]|max_length[10]',
            'password'         => 'required|min_length[8]|max_length[255]',
            'confirm_password' => 'required|matches[password]',
            'terms'            => 'required',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('validation', $this->validator->getErrors());
        }

        $user = new User();
        $data = $this->request->getPost([
            'first_name', 'last_name', 'email', 'phone', 'address', 'city', 'state', 'zip_code', 'password',
        ]);
        $data['user_type']      = 'customer';
        $data['is_active']      = true;
        $data['email_verified'] = false;

        try {
            if (! $user->insert($data)) {
                return redirect()->back()->withInput()->with('validation', $user->errors());
            }
        } catch (\Throwable $exception) {
            log_message('error', 'Registration failed: {message}', ['message' => $exception->getMessage()]);

            return redirect()->back()->withInput()->with(
                'error',
                'Registration could not be completed. Please check the database setup and try again.'
            );
        }

        return redirect()->to('/register')->with(
            'success',
            'Registration successful! Welcome to PowerFlow Electric.'
        );
    }
}
