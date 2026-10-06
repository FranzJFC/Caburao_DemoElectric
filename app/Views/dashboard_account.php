<?= $this->extend('layout') ?>
<?= $this->section('content') ?>
<section class="account-dashboard">
    <div class="container">
        <div class="account-dashboard-panel account-detail-panel mx-auto">
            <header class="text-center mb-4">
                <h1><i class="fas fa-bolt text-warning me-2"></i>Puihaha Electric Company</h1>
                <p class="text-muted">Customer Account Details</p>
            </header>
            <a class="btn btn-secondary mb-4" href="<?= base_url('dashboard') ?>"><i class="fas fa-arrow-left me-2"></i>Back to Dashboard</a>
            <?php if ($message = session()->getFlashdata('success')): ?><div class="alert alert-success" role="alert"><?= esc($message) ?></div><?php endif ?>
            <?php if ($is_admin): ?><a class="btn btn-outline-primary mb-4" href="<?= base_url('accounts/' . $account['id'] . '/edit') ?>">Edit account</a><?php endif ?>
            <div class="card account-detail-card">
                <div class="card-header"><h2 class="h4 mb-0">Account Information</h2></div>
                <div class="card-body">
                    <div class="row g-3">
                        <?php $fields = [
                            'Account Number' => $account['account_number'],
                            'Status' => ucfirst($account['status']),
                            'Customer Name' => $account['customer_name'],
                            'Address' => $account['address'],
                            'Phone' => $account['phone'],
                            'Email' => $account['email'],
                            'Meter Number' => $account['meter_number'],
                            'Connection Type' => ucfirst($account['connection_type']),
                            'Created At' => $account['created_at'],
                            'Last Updated' => $account['updated_at'],
                        ]; ?>
                        <?php foreach ($fields as $label => $value): ?>
                            <div class="col-md-6"><div class="account-detail-field"><span><?= esc($label) ?></span><strong><?= esc($value ?: '—') ?></strong></div></div>
                        <?php endforeach ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>
