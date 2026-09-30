<?= $this->extend('layout') ?>
<?= $this->section('content') ?>
<section class="page-hero compact">
    <div class="container text-center">
        <span class="eyebrow">CUSTOMER ACCESS</span>
        <h1>Welcome back</h1>
        <p class="lead mx-auto">Log in to access your Puihaha Electric dashboard.</p>
    </div>
</section>
<section class="section-padding bg-light-custom">
    <div class="container">
        <div class="form-panel login-panel mx-auto">
            <div class="text-center mb-4">
                <div class="feature-icon"><i class="fas fa-user-lock"></i></div>
                <h2>Log in to your account</h2>
            </div>
            <?php if ($success): ?><div class="alert alert-success" role="alert"><?= esc($success) ?></div><?php endif ?>
            <?php if ($error): ?><div class="alert alert-danger" role="alert"><?= esc($error) ?></div><?php endif ?>
            <?php if (! empty($validation)): ?>
                <div class="alert alert-danger" role="alert"><ul class="mb-0"><?php foreach ($validation as $message): ?><li><?= esc($message) ?></li><?php endforeach ?></ul></div>
            <?php endif ?>
            <form action="<?= base_url('login') ?>" method="post">
                <?= csrf_field() ?>
                <div class="mb-3">
                    <label class="form-label" for="email">Email address</label>
                    <input class="form-control" type="email" id="email" name="email" value="<?= esc($email ?? '') ?>" autocomplete="email" autofocus>
                </div>
                <div class="mb-4">
                    <label class="form-label" for="password">Password</label>
                    <div class="password-field">
                        <input class="form-control" type="password" id="password" name="password" autocomplete="current-password">
                        <button type="button" class="password-toggle" aria-label="Show password"><i class="fas fa-eye"></i></button>
                    </div>
                </div>
                <button class="btn btn-primary btn-lg w-100" type="submit">Log in</button>
            </form>
            <p class="text-center text-muted mt-4 mb-0">New here? <a href="<?= base_url('register') ?>">Create an account</a></p>
        </div>
    </div>
</section>
<?= $this->endSection() ?>
