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
        try {
            $users = new User();
            $user  = $users->where('is_active', true)->first();
        } catch (\Throwable $exception) {
            log_message('error', 'Login failed: {message}', ['message' => $exception->getMessage()]);

            return redirect()->to('/login')
                ->with('error', 'Login is temporarily unavailable. Please try again.');
        }

        if (! $user) {
            return redirect()->to('/login')->with('error', 'No active user is available.');
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
