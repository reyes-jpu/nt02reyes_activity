<div class="row g-3 g-md-4 section-block">
    <?php foreach ($stats as $stat): ?>
        <div class="col-12 col-sm-6 col-lg-4">
            <div class="stat-card">
                <div class="stat-icon"><i class="bi <?= e($stat['icon']) ?>" aria-hidden="true"></i></div>
                <div>
                    <div class="stat-value"><?= e($stat['value']) ?></div>
                    <div class="stat-label"><?= e($stat['label']) ?></div>
                    <div class="stat-note"><?= e($stat['note']) ?></div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>
