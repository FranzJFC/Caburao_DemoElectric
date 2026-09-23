<?= $this->extend('layout') ?>
<?= $this->section('content') ?>
<section class="page-hero"><div class="container text-center"><span class="eyebrow">OUR SERVICES</span><h1>Solutions for every electrical need</h1><p class="lead mx-auto">Licensed expertise for homes, businesses, industrial facilities, and renewable-energy systems.</p></div></section>
<section class="section-padding"><div class="container"><div class="row g-4">
<?php $services = [
['house','Residential Services','Safe, convenient electrical systems designed around your home.',['New wiring and rewiring','Panel and breaker upgrades','Lighting and ceiling fans','Smart-home installations']],
['building','Commercial Services','Reliable power solutions that help your organization operate smoothly.',['Tenant fit-outs','Code-compliant installations','Data and low-voltage wiring','Emergency and exit lighting']],
['industry','Industrial Services','Robust systems for manufacturing, warehousing, and complex equipment.',['Machine wiring','Control systems','High-bay lighting','Power quality correction']],
['screwdriver-wrench','Maintenance & Repair','Preventive care and rapid troubleshooting that reduce downtime.',['System inspections','Thermal imaging','Equipment testing','Scheduled maintenance']],
['solar-panel','Solar & Storage','Renewable power engineered for long-term performance and savings.',['Solar system design','Professional installation','Battery backup','Performance monitoring']],
['bolt','Emergency Response','Around-the-clock help for urgent and potentially dangerous failures.',['Power outages','Electrical faults','Burning odors and sparks','Storm-related damage']],
]; ?>
<?php foreach ($services as [$icon,$heading,$copy,$items]): ?><div class="col-md-6 col-lg-4"><article class="card service-card h-100"><div class="feature-icon"><i class="fas fa-<?= $icon ?>"></i></div><h2><?= esc($heading) ?></h2><p><?= esc($copy) ?></p><ul><?php foreach ($items as $item): ?><li><i class="fas fa-check"></i><?= esc($item) ?></li><?php endforeach ?></ul></article></div><?php endforeach ?>
</div></div></section>
<section class="process-section section-padding"><div class="container"><div class="section-heading text-white"><span>HOW IT WORKS</span><h2>A clear process from start to finish</h2></div><div class="row g-4 text-center"><?php foreach ([['1','Consultation'],['2','Assessment'],['3','Installation'],['4','Follow-up']] as [$number,$name]): ?><div class="col-6 col-lg-3"><div class="process-step"><strong><?= $number ?></strong><h3><?= $name ?></h3></div></div><?php endforeach ?></div></div></section>
<section class="section-padding"><div class="container text-center"><h2 class="display-6 fw-bold">Ready to get started?</h2><p class="lead text-muted">Request a consultation and a clear, no-obligation estimate.</p><a class="btn btn-primary btn-lg" href="<?= base_url('contact') ?>">Get a free quote</a></div></section>
<?= $this->endSection() ?>
