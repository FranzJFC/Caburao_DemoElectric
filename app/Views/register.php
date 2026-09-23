<?= $this->extend('layout') ?>
<?= $this->section('content') ?>
<section class="page-hero compact"><div class="container text-center"><span class="eyebrow">CUSTOMER REGISTRATION</span><h1>Join the Puihaha community</h1><p class="lead mx-auto">Create your customer profile to get started with our electrical services.</p></div></section>
<section class="section-padding bg-light-custom"><div class="container"><div class="form-panel register-panel mx-auto">
    <div class="text-center mb-4"><div class="feature-icon"><i class="fas fa-user-plus"></i></div><h2>Create your account</h2><p class="text-muted">Your information is used only to manage your service relationship.</p></div>
    <?php if ($success): ?><div class="alert alert-success" role="alert"><i class="fas fa-circle-check me-2"></i><?= esc($success) ?></div><?php endif ?>
    <?php if ($error): ?><div class="alert alert-danger" role="alert"><i class="fas fa-circle-exclamation me-2"></i><?= esc($error) ?></div><?php endif ?>
    <?php if (! empty($validation)): ?><div class="alert alert-danger" role="alert"><strong>Please correct the following:</strong><ul class="mb-0 mt-2"><?php foreach ($validation as $message): ?><li><?= esc($message) ?></li><?php endforeach ?></ul></div><?php endif ?>
    <form action="<?= base_url('register') ?>" method="post" novalidate><?= csrf_field() ?>
        <h3 class="form-section-title">Personal details</h3><div class="row g-3">
            <div class="col-md-6"><label class="form-label" for="first_name">First name *</label><input class="form-control" id="first_name" name="first_name" value="<?= old('first_name') ?>" required></div>
            <div class="col-md-6"><label class="form-label" for="last_name">Last name *</label><input class="form-control" id="last_name" name="last_name" value="<?= old('last_name') ?>" required></div>
            <div class="col-md-6"><label class="form-label" for="email">Email *</label><input class="form-control" type="email" id="email" name="email" value="<?= old('email') ?>" required></div>
            <div class="col-md-6"><label class="form-label" for="phone">Phone *</label><input class="form-control" type="tel" id="phone" name="phone" value="<?= old('phone') ?>" required></div>
        </div>
        <h3 class="form-section-title">Service address</h3><div class="row g-3">
            <div class="col-12"><label class="form-label" for="address">Street address *</label><input class="form-control" id="address" name="address" value="<?= old('address') ?>" required></div>
            <div class="col-md-5"><label class="form-label" for="city">City *</label><input class="form-control" id="city" name="city" value="<?= old('city') ?>" required></div>
            <div class="col-md-4"><label class="form-label" for="state">State / Province *</label><input class="form-control" id="state" name="state" value="<?= old('state') ?>" required></div>
            <div class="col-md-3"><label class="form-label" for="zip_code">ZIP code *</label><input class="form-control" id="zip_code" name="zip_code" value="<?= old('zip_code') ?>" required></div>
        </div>
        <h3 class="form-section-title">Secure your account</h3><div class="row g-3">
            <div class="col-md-6"><label class="form-label" for="password">Password *</label><div class="password-field"><input class="form-control" type="password" id="password" name="password" minlength="8" required><button type="button" class="password-toggle" aria-label="Show password"><i class="fas fa-eye"></i></button></div><div class="password-strength" aria-live="polite"></div><small class="text-muted">Use at least 8 characters.</small></div>
            <div class="col-md-6"><label class="form-label" for="confirm_password">Confirm password *</label><input class="form-control" type="password" id="confirm_password" name="confirm_password" minlength="8" required></div>
            <div class="col-12"><div class="form-check"><input class="form-check-input" type="checkbox" value="1" id="terms" name="terms" <?= old('terms') ? 'checked' : '' ?> required><label class="form-check-label" for="terms">I agree to the terms of service and privacy policy.</label></div></div>
            <div class="col-12"><div class="form-check"><input class="form-check-input" type="checkbox" value="1" id="newsletter" name="newsletter" <?= old('newsletter') ? 'checked' : '' ?>><label class="form-check-label" for="newsletter">Subscribe to our newsletter for electrical tips and special offers.</label></div></div>
            <div class="col-12"><button class="btn btn-primary btn-lg w-100" type="submit"><i class="fas fa-user-plus me-2"></i>Create account</button></div>
        </div>
    </form>
</div></div></section>
<?= $this->endSection() ?>
