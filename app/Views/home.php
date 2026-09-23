<?= $this->extend('layout') ?>
<?= $this->section('content') ?>
<section class="hero-section">
    <div class="container"><div class="row align-items-center g-5">
        <div class="col-lg-7"><span class="eyebrow">POWER YOU CAN TRUST</span><h1>Powering your world with excellence</h1><p class="lead">Safe, reliable, and efficient electrical solutions for homes and businesses—backed by more than 25 years of hands-on experience.</p><div class="d-flex flex-wrap gap-3"><a class="btn btn-primary btn-lg" href="<?= base_url('services') ?>">Explore services</a><a class="btn btn-outline-light btn-lg" href="<?= base_url('contact') ?>">Get a free quote</a></div></div>
        <div class="col-lg-5 text-center"><div class="hero-bolt"><i class="fas fa-bolt"></i></div></div>
    </div></div>
</section>
<section class="section-padding bg-light-custom">
    <div class="container"><div class="section-heading"><span>WHY PUIHAHA</span><h2>Electrical work done right</h2><p>Experience, modern tools, and responsive service come together in every project.</p></div>
        <div class="row g-4">
            <?php $features = [['shield-halved','Licensed & Insured','Qualified electricians and comprehensive insurance for complete peace of mind.'],['clock','24/7 Emergency Service','Fast help when an electrical problem cannot wait until morning.'],['award','25+ Years Experience','Proven expertise across residential, commercial, and industrial work.'],['screwdriver-wrench','Modern Equipment','Professional diagnostic tools for accurate, efficient solutions.'],['leaf','Energy Efficient','Smarter installations that reduce energy waste and operating costs.'],['handshake','Satisfaction Guaranteed','Careful workmanship supported by dependable warranties.']]; ?>
            <?php foreach ($features as [$icon, $heading, $copy]): ?><div class="col-md-6 col-lg-4"><article class="card feature-card h-100"><div class="feature-icon"><i class="fas fa-<?= $icon ?>"></i></div><h3><?= esc($heading) ?></h3><p><?= esc($copy) ?></p></article></div><?php endforeach ?>
        </div>
    </div>
</section>
<section class="section-padding"><div class="container"><div class="row align-items-center g-5"><div class="col-lg-6"><span class="eyebrow text-dark">COMPLETE ELECTRICAL CARE</span><h2 class="display-5 fw-bold">From a single outlet to a full facility</h2><p class="lead text-muted">We plan, install, inspect, repair, and maintain electrical systems with safety at the center.</p><a class="btn btn-primary" href="<?= base_url('services') ?>">View all services</a></div><div class="col-lg-6"><div class="row g-3"><div class="col-6"><div class="service-tile"><i class="fas fa-house"></i><strong>Residential</strong></div></div><div class="col-6"><div class="service-tile"><i class="fas fa-building"></i><strong>Commercial</strong></div></div><div class="col-6"><div class="service-tile"><i class="fas fa-industry"></i><strong>Industrial</strong></div></div><div class="col-6"><div class="service-tile"><i class="fas fa-solar-panel"></i><strong>Renewable</strong></div></div></div></div></div></div></section>
<section class="cta-section"><div class="container text-center"><h2>Electrical emergency?</h2><p>Our response team is available around the clock.</p><a class="btn btn-light btn-lg" href="tel:5551234567"><i class="fas fa-phone me-2"></i>(555) 123-4567</a></div></section>
<?= $this->endSection() ?>
