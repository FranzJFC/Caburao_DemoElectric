<?php

namespace App\Controllers;

use App\Models\User;
use CodeIgniter\HTTP\RedirectResponse;

class Login extends BaseController
{
    public function index(): string|RedirectResponse
    {
        if (session()->get('user_id')) {
            return redirect()->to('/dashboard');
        }

        return view('login', [
            'title'      => 'Log in - Puihaha Electric',
            'page'       => 'login',
            'success'    => session()->getFlashdata('success'),
            'error'      => session()->getFlashdata('error'),
            'validation' => session()->getFlashdata('validation'),
            'email'      => session()->getFlashdata('login_email'),
        ]);
    }

    public function authenticate(): RedirectResponse
    {
        $submittedEmail = $this->request->getPost('email');
        $email = is_string($submittedEmail) ? trim($submittedEmail) : '';
        $password = $this->request->getPost('password');

        if (! filter_var($email, FILTER_VALIDATE_EMAIL) || ! is_string($password) || $password === '') {
            return redirect()->to('/login')
                ->with('login_email', $email)
                ->with('error', 'Enter a valid email address and password.');
        }

        try {
            $users = new User();
            $user  = $users->findByEmail($email);
        } catch (\Throwable $exception) {
            log_message('error', 'Login failed: {message}', ['message' => $exception->getMessage()]);

            return redirect()->to('/login')
                ->with('error', 'Login is temporarily unavailable. Please try again.');
        }

        if (! $user || ! $user['is_active'] || ! $users->verifyPassword($password, $user['password'])) {
            return redirect()->to('/login')
                ->with('login_email', $email)
                ->with('error', 'Invalid email or password.');
        }

        session()->regenerate(true);
        session()->set('user_id', $user['id']);

        return redirect()->to('/dashboard');
    }

    public function logout(): RedirectResponse
    {
        session()->destroy();

        return redirect()->to('/login');
    }
}
