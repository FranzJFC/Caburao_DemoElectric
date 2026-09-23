<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= esc($title ?? 'Puihaha Electric') ?></title>
    <meta name="description" content="Reliable residential, commercial, industrial, and renewable-energy electrical services.">
    <link rel="preconnect" href="https://cdn.jsdelivr.net">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/css/custom.css') ?>">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top" aria-label="Main navigation">
    <div class="container">
        <a class="navbar-brand" href="<?= base_url('/') ?>"><i class="fas fa-bolt text-warning me-2"></i>Puihaha Electric</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav" aria-controls="mainNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="mainNav">
            <ul class="navbar-nav ms-auto align-items-lg-center">
                <?php foreach (['home' => '/', 'about' => 'about', 'services' => 'services', 'contact' => 'contact', 'register' => 'register'] as $label => $url): ?>
                    <li class="nav-item"><a class="nav-link <?= ($page ?? '') === $label ? 'active' : '' ?>" href="<?= base_url($url) ?>"><?= ucfirst($label) ?></a></li>
                <?php endforeach ?>
            </ul>
        </div>
    </div>
</nav>

<main><?= $this->renderSection('content') ?></main>

<footer class="footer">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-5">
                <h5><i class="fas fa-bolt text-warning me-2"></i>Puihaha Electric</h5>
                <p>Reliable and sustainable electrical solutions from licensed professionals. Your safety and satisfaction power everything we do.</p>
                <div class="social-icons" aria-label="Social links">
                    <a href="#" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" aria-label="X"><i class="fab fa-x-twitter"></i></a>
                    <a href="#" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>
            <div class="col-6 col-lg-2">
                <h5>Quick links</h5>
                <ul class="list-unstyled"><li><a href="<?= base_url('/') ?>">Home</a></li><li><a href="<?= base_url('about') ?>">About</a></li><li><a href="<?= base_url('services') ?>">Services</a></li><li><a href="<?= base_url('contact') ?>">Contact</a></li></ul>
            </div>
            <div class="col-6 col-lg-2">
                <h5>Services</h5>
                <ul class="list-unstyled"><li>Residential</li><li>Commercial</li><li>Emergency</li><li>Solar</li></ul>
            </div>
            <div class="col-lg-3">
                <h5>Contact</h5>
                <ul class="list-unstyled contact-list"><li><i class="fas fa-location-dot"></i> 123 Electric Avenue, Power City</li><li><i class="fas fa-phone"></i> (555) 123-4567</li><li><i class="fas fa-envelope"></i> info@puihahaelectric.com</li><li><i class="fas fa-clock"></i> 24/7 Emergency Service</li></ul>
            </div>
        </div>
        <hr>
        <div class="d-md-flex justify-content-between"><p>&copy; <?= date('Y') ?> Puihaha Electric. All rights reserved.</p><p>Licensed &amp; Insured | License #EL123456</p></div>
    </div>
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="<?= base_url('assets/js/app.js') ?>"></script>
</body>
</html>
