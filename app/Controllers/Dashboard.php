<?php

namespace App\Controllers;

use App\Models\CustomerAccount;
use App\Models\User;
use CodeIgniter\Exceptions\PageNotFoundException;
use CodeIgniter\HTTP\RedirectResponse;

class Dashboard extends BaseController
{
    public function index(): string|RedirectResponse
    {
        $user = $this->activeUser();

        if ($user === null) {
            return redirect()->to('/login')->with('error', 'Please log in to continue.');
        }

        $search = $this->queryValue('search');
        $status = $this->queryValue('status');
        $type   = $this->queryValue('type');

        if (! in_array($status, ['', 'active', 'inactive', 'suspended'], true)) {
            $status = '';
        }

        if (! in_array($type, ['', 'residential', 'commercial', 'industrial'], true)) {
            $type = '';
        }

        $query = $this->accountsFor($user);

        if ($search !== '') {
            $query->groupStart()
                ->like('account_number', $search)
                ->orLike('customer_name', $search)
                ->orLike('email', $search)
                ->orLike('phone', $search)
                ->groupEnd();
        }

        if ($status !== '') {
            $query->where('status', $status);
        }

        if ($type !== '') {
            $query->where('connection_type', $type);
        }

        $accounts = $query->orderBy('created_at', 'DESC')->paginate(10);

        return view('dashboard', [
            'title'              => 'Customer Accounts - Puihaha Electric',
            'page'               => 'dashboard',
            'user'               => $user,
            'accounts'           => $accounts,
            'pager'              => $query->pager,
            'total_accounts'     => $this->accountsFor($user)->countAllResults(),
            'active_accounts'    => $this->accountsFor($user)->where('status', 'active')->countAllResults(),
            'inactive_accounts'  => $this->accountsFor($user)->where('status', 'inactive')->countAllResults(),
            'suspended_accounts' => $this->accountsFor($user)->where('status', 'suspended')->countAllResults(),
            'search_keyword'     => $search,
            'filter_status'      => $status,
            'filter_type'        => $type,
            'is_admin'           => $user['user_type'] === 'admin',
        ]);
    }

    public function account(int $id): string|RedirectResponse
    {
        $user = $this->activeUser();

        if ($user === null) {
            return redirect()->to('/login')->with('error', 'Please log in to continue.');
        }

        $account = $this->accountsFor($user)->where('id', $id)->first();

        if ($account === null) {
            throw PageNotFoundException::forPageNotFound();
        }

        return view('dashboard_account', [
            'title'   => 'Account Details - Puihaha Electric',
            'page'    => 'dashboard',
            'account' => $account,
        ]);
    }

    private function activeUser(): ?array
    {
        $user = (new User())->find(session()->get('user_id'));

        if (! $user || ! $user['is_active']) {
            session()->destroy();

            return null;
        }

        return $user;
    }

    private function accountsFor(array $user): CustomerAccount
    {
        $accounts = new CustomerAccount();

        if ($user['user_type'] !== 'admin') {
            $accounts->where('email', $user['email']);
        }

        return $accounts;
    }

    private function queryValue(string $name): string
    {
        $value = $this->request->getGet($name);

        return is_string($value) ? mb_substr(trim($value), 0, 100) : '';
    }
}
