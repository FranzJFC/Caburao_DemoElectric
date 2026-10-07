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

        $query = $this->accountsQuery();

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

        $accounts = $query
            ->orderBy('created_at', 'DESC')
            ->orderBy('id', 'ASC')
            ->findAll();

        return view('dashboard', [
            'title'              => 'Customer Accounts - Puihaha Electric',
            'page'               => 'dashboard',
            'user'               => $user,
            'accounts'           => $accounts,
            'total_accounts'     => $this->accountsQuery()->countAllResults(),
            'active_accounts'    => $this->accountsQuery()->where('status', 'active')->countAllResults(),
            'inactive_accounts'  => $this->accountsQuery()->where('status', 'inactive')->countAllResults(),
            'suspended_accounts' => $this->accountsQuery()->where('status', 'suspended')->countAllResults(),
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

        $account = $this->accountsQuery()->where('id', $id)->first();

        if ($account === null) {
            throw PageNotFoundException::forPageNotFound();
        }

        return view('dashboard_account', [
            'title'   => 'Account Details - Puihaha Electric',
            'page'    => 'dashboard',
            'account' => $account,
            'is_admin' => $user['user_type'] === 'admin',
        ]);
    }

    public function newAccount(): string|RedirectResponse
    {
        $user = $this->adminUser();
        if ($user instanceof RedirectResponse) {
            return $user;
        }

        return view('account_form', [
            'title' => 'Add Customer Account - Puihaha Electric',
            'page' => 'dashboard',
            'account' => null,
            'validation' => session()->getFlashdata('validation'),
            'error' => session()->getFlashdata('error'),
        ]);
    }

    public function createAccount(): RedirectResponse
    {
        $user = $this->adminUser();
        if ($user instanceof RedirectResponse) {
            return $user;
        }

        $data = $this->accountData();
        if (! $this->validateData($data, $this->accountRules())) {
            return redirect()->back()->withInput()->with('validation', $this->validator->getErrors());
        }

        $accounts = new CustomerAccount();
        if ($accounts->where('account_number', $data['account_number'])->first()) {
            return redirect()->back()->withInput()->with('validation', ['account_number' => 'This account number is already in use.']);
        }

        try {
            $id = $accounts->insert($data);
        } catch (\Throwable $exception) {
            log_message('error', 'Account creation failed: {message}', ['message' => $exception->getMessage()]);
            return redirect()->back()->withInput()->with('error', 'Could not save the account. Please try again.');
        }

        if (! $id) {
            return redirect()->back()->withInput()->with('validation', $accounts->errors());
        }

        return redirect()->to('/account/' . $id)->with('success', 'Customer account created.');
    }

    public function editAccount(int $id): string|RedirectResponse
    {
        $user = $this->adminUser();
        if ($user instanceof RedirectResponse) {
            return $user;
        }

        $account = (new CustomerAccount())->find($id);
        if ($account === null) {
            throw PageNotFoundException::forPageNotFound();
        }

        return view('account_form', [
            'title' => 'Edit Customer Account - Puihaha Electric',
            'page' => 'dashboard',
            'account' => $account,
            'validation' => session()->getFlashdata('validation'),
            'error' => session()->getFlashdata('error'),
        ]);
    }

    public function updateAccount(int $id): RedirectResponse
    {
        $user = $this->adminUser();
        if ($user instanceof RedirectResponse) {
            return $user;
        }

        $accounts = new CustomerAccount();
        if ($accounts->find($id) === null) {
            throw PageNotFoundException::forPageNotFound();
        }

        $data = $this->accountData();
        if (! $this->validateData($data, $this->accountRules())) {
            return redirect()->back()->withInput()->with('validation', $this->validator->getErrors());
        }

        if ($accounts->where('account_number', $data['account_number'])->where('id !=', $id)->first()) {
            return redirect()->back()->withInput()->with('validation', ['account_number' => 'This account number is already in use.']);
        }

        try {
            $saved = $accounts->update($id, $data);
        } catch (\Throwable $exception) {
            log_message('error', 'Account update failed: {message}', ['message' => $exception->getMessage()]);
            return redirect()->back()->withInput()->with('error', 'Could not update the account. Please try again.');
        }

        if (! $saved) {
            return redirect()->back()->withInput()->with('validation', $accounts->errors());
        }

        return redirect()->to('/account/' . $id)->with('success', 'Customer account updated.');
    }

    public function deleteAccount(int $id): RedirectResponse
    {
        $user = $this->adminUser();
        if ($user instanceof RedirectResponse) {
            return $user;
        }

        $accounts = new CustomerAccount();
        if ($accounts->find($id) === null) {
            throw PageNotFoundException::forPageNotFound();
        }

        try {
            $deleted = $accounts->delete($id);
        } catch (\Throwable $exception) {
            log_message('error', 'Account deletion failed: {message}', ['message' => $exception->getMessage()]);
            return redirect()->to('/dashboard')->with('error', 'Could not delete the account. Please try again.');
        }

        if (! $deleted) {
            return redirect()->to('/dashboard')->with('error', 'Could not delete the account. Please try again.');
        }

        return redirect()->to('/dashboard')->with('success', 'Customer account deleted.');
    }

    private function adminUser(): array|RedirectResponse
    {
        $user = $this->activeUser();
        if ($user === null) {
            return redirect()->to('/login')->with('error', 'Please log in to continue.');
        }

        if ($user['user_type'] !== 'admin') {
            return redirect()->to('/dashboard')->with('error', 'Only administrators can manage customer accounts.');
        }

        return $user;
    }

    private function accountData(): array
    {
        $data = [];
        foreach (['account_number', 'customer_name', 'address', 'phone', 'email', 'meter_number', 'connection_type', 'status'] as $field) {
            $value = $this->request->getPost($field);
            $data[$field] = is_string($value) ? trim($value) : '';
        }

        return $data;
    }

    private function accountRules(): array
    {
        return [
            'account_number' => 'required|max_length[50]',
            'customer_name' => 'required|max_length[150]',
            'address' => 'required',
            'phone' => 'permit_empty|max_length[20]',
            'email' => 'permit_empty|valid_email|max_length[100]',
            'meter_number' => 'permit_empty|max_length[50]',
            'connection_type' => 'required|in_list[residential,commercial,industrial]',
            'status' => 'required|in_list[active,inactive,suspended]',
        ];
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

    private function accountsQuery(): CustomerAccount
    {
        return new CustomerAccount();
    }

    private function queryValue(string $name): string
    {
        $value = $this->request->getGet($name);

        return is_string($value) ? mb_substr(trim($value), 0, 100) : '';
    }
}
