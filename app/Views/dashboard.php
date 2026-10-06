<?= $this->extend('layout') ?>
<?= $this->section('content') ?>
<section class="account-dashboard">
    <div class="container">
        <div class="account-dashboard-panel">
            <header class="text-center mb-4">
                <h1><i class="fas fa-bolt text-warning me-2"></i>Puihaha Electric Company</h1>
                <p class="text-muted mb-0"><?= $is_admin ? 'Customer Account Management System' : 'Your Customer Account' ?></p>
                <p class="mt-2 mb-0">Welcome, <?= esc($user['first_name']) ?></p>
            </header>

            <?php if ($message = session()->getFlashdata('success')): ?><div class="alert alert-success" role="alert"><?= esc($message) ?></div><?php endif ?>
            <?php if ($message = session()->getFlashdata('error')): ?><div class="alert alert-danger" role="alert"><?= esc($message) ?></div><?php endif ?>

            <?php if ($is_admin): ?><div class="d-flex justify-content-end mb-4"><a class="btn btn-primary" href="<?= base_url('accounts/new') ?>"><i class="fas fa-plus me-1"></i>Add customer account</a></div><?php endif ?>

            <div class="row g-3 mb-4">
                <?php foreach ([
                    ['total', 'Total Accounts', $total_accounts],
                    ['active', 'Active Accounts', $active_accounts],
                    ['inactive', 'Inactive Accounts', $inactive_accounts],
                    ['suspended', 'Suspended Accounts', $suspended_accounts],
                ] as [$kind, $label, $count]): ?>
                    <div class="col-sm-6 col-xl-3"><div class="account-stat account-stat-<?= $kind ?>"><strong><?= esc($count) ?></strong><span><?= esc($label) ?></span></div></div>
                <?php endforeach ?>
            </div>

            <?php if ($is_admin): ?>
                <form class="account-filters mb-4" method="get" action="<?= base_url('dashboard') ?>">
                    <div class="row g-3">
                        <div class="col-md-4"><label class="visually-hidden" for="search">Search accounts</label><input class="form-control" id="search" name="search" placeholder="Search by name, account, email, phone..." value="<?= esc($search_keyword) ?>"></div>
                        <div class="col-md-3"><label class="visually-hidden" for="status">Status</label><select class="form-select" id="status" name="status">
                            <option value="">All statuses</option>
                            <?php foreach (['active', 'inactive', 'suspended'] as $option): ?><option value="<?= $option ?>" <?= $filter_status === $option ? 'selected' : '' ?>><?= ucfirst($option) ?></option><?php endforeach ?>
                        </select></div>
                        <div class="col-md-3"><label class="visually-hidden" for="type">Connection type</label><select class="form-select" id="type" name="type">
                            <option value="">All types</option>
                            <?php foreach (['residential', 'commercial', 'industrial'] as $option): ?><option value="<?= $option ?>" <?= $filter_type === $option ? 'selected' : '' ?>><?= ucfirst($option) ?></option><?php endforeach ?>
                        </select></div>
                        <div class="col-md-2"><button class="btn btn-primary w-100" type="submit"><i class="fas fa-magnifying-glass me-1"></i>Search</button></div>
                    </div>
                    <?php if ($search_keyword !== '' || $filter_status !== '' || $filter_type !== ''): ?><a class="btn btn-sm btn-link mt-2" href="<?= base_url('dashboard') ?>">Clear filters</a><?php endif ?>
                </form>
            <?php endif ?>

            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-dark"><tr><th>Account Number</th><th>Customer Name</th><th>Email</th><th>Phone</th><th>Connection Type</th><th>Status</th><th>Action</th></tr></thead>
                    <tbody>
                        <?php if (empty($accounts)): ?>
                            <tr><td colspan="7" class="text-center text-muted py-4"><?= $is_admin ? 'No accounts found.' : 'No customer account is linked to your email address.' ?></td></tr>
                        <?php else: ?>
                            <?php foreach ($accounts as $account): ?>
                                <?php $badge = ['active' => 'success', 'inactive' => 'danger', 'suspended' => 'warning'][$account['status']] ?? 'secondary'; ?>
                                <tr>
                                    <td><strong><?= esc($account['account_number']) ?></strong></td>
                                    <td><?= esc($account['customer_name']) ?></td>
                                    <td><?= esc($account['email']) ?></td>
                                    <td><?= esc($account['phone']) ?></td>
                                    <td><?= esc(ucfirst($account['connection_type'])) ?></td>
                                    <td><span class="badge text-bg-<?= $badge ?>"><?= esc(ucfirst($account['status'])) ?></span></td>
                                    <td><div class="d-flex gap-1">
                                        <a class="btn btn-sm btn-outline-primary" href="<?= base_url('account/' . $account['id']) ?>">View</a>
                                        <?php if ($is_admin): ?>
                                            <a class="btn btn-sm btn-outline-secondary" href="<?= base_url('accounts/' . $account['id'] . '/edit') ?>">Edit</a>
                                            <form method="post" action="<?= base_url('accounts/' . $account['id'] . '/delete') ?>" onsubmit="return confirm('Delete this customer account? This cannot be undone.');"><?= csrf_field() ?><button class="btn btn-sm btn-outline-danger" type="submit">Delete</button></form>
                                        <?php endif ?>
                                    </div></td>
                                </tr>
                            <?php endforeach ?>
                        <?php endif ?>
                    </tbody>
                </table>
            </div>

            <?php if ($pager && $pager->getPageCount() > 1): ?>
                <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mt-3">
                    <span>Page <?= esc($pager->getCurrentPage()) ?> of <?= esc($pager->getPageCount()) ?></span>
                    <?= $pager->links() ?>
                </div>
            <?php endif ?>

            <?php if (! $is_admin): ?>
                <section class="account-filters mt-4" aria-labelledby="profile-heading">
                    <h2 class="h5" id="profile-heading">Your login profile</h2>
                    <p class="mb-1"><strong>Name:</strong> <?= esc($user['first_name'] . ' ' . $user['last_name']) ?></p>
                    <p class="mb-1"><strong>Email:</strong> <?= esc($user['email']) ?></p>
                    <?php if (! empty($user['phone'])): ?><p class="mb-1"><strong>Phone:</strong> <?= esc($user['phone']) ?></p><?php endif ?>
                    <?php if (! empty($user['address'])): ?><p class="mb-0"><strong>Service address:</strong> <?= esc(implode(', ', array_filter([$user['address'], $user['city'], $user['state'], $user['zip_code']]))) ?></p><?php endif ?>
                    <?php if (empty($accounts)): ?><p class="mt-3 mb-0">If you expected an existing service account here, <a href="<?= base_url('contact') ?>">contact us</a> to link it to your email.</p><?php endif ?>
                </section>
            <?php endif ?>
        </div>
    </div>
</section>
<?= $this->endSection() ?>
