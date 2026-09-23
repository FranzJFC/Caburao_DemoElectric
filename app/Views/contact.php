<?= $this->extend('layout') ?>
<?= $this->section('content') ?>
<section class="page-hero"><div class="container text-center"><span class="eyebrow">CONTACT US</span><h1>Let’s talk about your project</h1><p class="lead mx-auto">Tell us what you need and a member of our team will respond within one business day.</p></div></section>
<section class="section-padding"><div class="container">
    <?php if ($success): ?><div class="alert alert-success" role="alert"><i class="fas fa-circle-check me-2"></i><?= esc($success) ?></div><?php endif ?>
    <div class="row g-5">
        <div class="col-lg-5"><span class="eyebrow text-dark">GET IN TOUCH</span><h2 class="display-6 fw-bold">We’re ready to help</h2><p class="text-muted">For electrical hazards or loss of power, call our emergency line for the fastest response.</p>
            <div class="contact-card"><i class="fas fa-phone"></i><div><strong>Call us</strong><a href="tel:5551234567">(555) 123-4567</a></div></div>
            <div class="contact-card"><i class="fas fa-envelope"></i><div><strong>Email us</strong><a href="mailto:info@puihahaelectric.com">info@puihahaelectric.com</a></div></div>
            <div class="contact-card"><i class="fas fa-location-dot"></i><div><strong>Visit us</strong><span>123 Electric Avenue, Power City</span></div></div>
            <div class="emergency-box"><i class="fas fa-triangle-exclamation"></i><div><strong>24/7 Emergency Service</strong><span>Immediate help for dangerous electrical issues.</span></div></div>
        </div>
        <div class="col-lg-7"><div class="form-panel"><h2>Request service</h2><p class="text-muted">Fields marked * are required.</p>
            <?php if (! empty($validation)): ?><div class="alert alert-danger" role="alert"><strong>Please correct the following:</strong><ul class="mb-0 mt-2"><?php foreach ($validation as $error): ?><li><?= esc($error) ?></li><?php endforeach ?></ul></div><?php endif ?>
            <form action="<?= base_url('contact') ?>" method="post" novalidate><?= csrf_field() ?>
                <div class="row g-3"><div class="col-md-6"><label class="form-label" for="name">Full name *</label><input class="form-control" id="name" name="name" value="<?= old('name') ?>" required></div><div class="col-md-6"><label class="form-label" for="email">Email *</label><input class="form-control" type="email" id="email" name="email" value="<?= old('email') ?>" required></div>
                <div class="col-md-6"><label class="form-label" for="phone">Phone *</label><input class="form-control" type="tel" id="phone" name="phone" value="<?= old('phone') ?>" required></div><div class="col-md-6"><label class="form-label" for="service_type">Service *</label><select class="form-select" id="service_type" name="service_type" required><option value="">Select a service</option><?php foreach (['residential'=>'Residential','commercial'=>'Commercial','industrial'=>'Industrial','solar'=>'Solar & Renewable','emergency'=>'Emergency','other'=>'Other'] as $value=>$label): ?><option value="<?= $value ?>" <?= old('service_type') === $value ? 'selected' : '' ?>><?= $label ?></option><?php endforeach ?></select></div>
                <div class="col-12"><label class="form-label" for="message">How can we help? *</label><textarea class="form-control" id="message" name="message" rows="6" required><?= old('message') ?></textarea></div><div class="col-12"><button class="btn btn-primary" type="submit"><i class="fas fa-paper-plane me-2"></i>Send message</button></div></div>
            </form>
        </div></div>
    </div>
</div></section>
<?= $this->endSection() ?>
