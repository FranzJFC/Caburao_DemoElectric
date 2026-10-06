<?= $this->extend('layout') ?>
<?= $this->section('content') ?>
<?php $editing = $account !== null; ?>
<section class="account-dashboard">
    <div class="container">
        <div class="account-dashboard-panel account-detail-panel mx-auto">
            <h1><?= $editing ? 'Edit Customer Account' : 'Add Customer Account' ?></h1>
            <p class="text-muted">Enter the service account details below.</p>
            <a class="btn btn-outline-secondary mb-4" href="<?= base_url($editing ? 'account/' . $account['id'] : 'dashboard') ?>">Back</a>

            <?php if ($error): ?><div class="alert alert-danger" role="alert"><?= esc($error) ?></div><?php endif ?>
            <?php if (! empty($validation)): ?>
                <div class="alert alert-danger" role="alert"><strong>Please correct the following:</strong>
                    <ul class="mb-0 mt-2"><?php foreach ($validation as $message): ?><li><?= esc($message) ?></li><?php endforeach ?></ul>
                </div>
            <?php endif ?>

            <form method="post" action="<?= base_url($editing ? 'accounts/' . $account['id'] : 'accounts') ?>">
                <?= csrf_field() ?>
                <div class="row g-3">
                    <div class="col-md-6"><label class="form-label" for="account_number">Account number *</label><input class="form-control" id="account_number" name="account_number" maxlength="50" value="<?= esc(old('account_number', $account['account_number'] ?? '', false)) ?>" required></div>
                    <div class="col-md-6"><label class="form-label" for="customer_name">Customer name *</label><input class="form-control" id="customer_name" name="customer_name" maxlength="150" value="<?= esc(old('customer_name', $account['customer_name'] ?? '', false)) ?>" required></div>
                    <div class="col-12"><label class="form-label" for="address">Service address *</label><textarea class="form-control" id="address" name="address" rows="2" required><?= esc(old('address', $account['address'] ?? '', false)) ?></textarea></div>
                    <div class="col-md-6"><label class="form-label" for="phone">Phone</label><input class="form-control" type="tel" id="phone" name="phone" maxlength="20" value="<?= esc(old('phone', $account['phone'] ?? '', false)) ?>"></div>
                    <div class="col-md-6"><label class="form-label" for="email">Email</label><input class="form-control" type="email" id="email" name="email" maxlength="100" value="<?= esc(old('email', $account['email'] ?? '', false)) ?>"><div class="form-text">Customers see accounts linked to their login email.</div></div>
                    <div class="col-md-4"><label class="form-label" for="meter_number">Meter number</label><input class="form-control" id="meter_number" name="meter_number" maxlength="50" value="<?= esc(old('meter_number', $account['meter_number'] ?? '', false)) ?>"></div>
                    <div class="col-md-4"><label class="form-label" for="connection_type">Connection type *</label><select class="form-select" id="connection_type" name="connection_type" required>
                        <?php foreach (['residential', 'commercial', 'industrial'] as $option): ?><option value="<?= $option ?>" <?= old('connection_type', $account['connection_type'] ?? 'residential') === $option ? 'selected' : '' ?>><?= ucfirst($option) ?></option><?php endforeach ?>
                    </select></div>
                    <div class="col-md-4"><label class="form-label" for="status">Status *</label><select class="form-select" id="status" name="status" required>
                        <?php foreach (['active', 'inactive', 'suspended'] as $option): ?><option value="<?= $option ?>" <?= old('status', $account['status'] ?? 'active') === $option ? 'selected' : '' ?>><?= ucfirst($option) ?></option><?php endforeach ?>
                    </select></div>
                </div>
                <div class="d-flex gap-2 mt-4"><button class="btn btn-primary" type="submit"><?= $editing ? 'Save changes' : 'Create account' ?></button><a class="btn btn-outline-secondary" href="<?= base_url('dashboard') ?>">Cancel</a></div>
            </form>
        </div>
    </div>
</section>
<?= $this->endSection() ?>
