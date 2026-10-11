<section class="section-block" id="services">
    <div class="section-head">
        <h2 class="section-title">Barangay Services</h2>
        <p class="section-sub">Choose a document or service to request online.</p>
    </div>

    <div class="row g-3 g-md-4">
        <?php foreach ($services as $service): ?>
            <div class="col-12 col-sm-6 col-lg-4">
                <a href="#" class="service-card">
                    <div class="service-icon"><i class="bi <?= e($service['icon']) ?>" aria-hidden="true"></i></div>
                    <div class="service-body">
                        <div class="service-title"><?= e($service['title']) ?></div>
                        <div class="service-desc"><?= e($service['desc']) ?></div>
                    </div>
                    <i class="bi bi-arrow-right service-arrow" aria-hidden="true"></i>
                </a>
            </div>
        <?php endforeach; ?>
    </div>
</section>
