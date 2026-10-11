<section class="section-block" id="announcements">
    <div class="section-head">
        <h2 class="section-title">Announcements</h2>
        <p class="section-sub">Latest news and reminders from the barangay.</p>
    </div>

    <div class="row g-3 g-md-4">
        <?php foreach ($announcements as $item): ?>
            <div class="col-12 col-lg-4">
                <article class="news-card">
                    <div class="news-top">
                        <span class="news-tag"><i class="bi <?= e($item['icon']) ?>" aria-hidden="true"></i> <?= e($item['tag']) ?></span>
                        <span class="news-date"><?= date('M j', strtotime('+' . (int) $item['in_days'] . ' days')) ?></span>
                    </div>
                    <h3 class="news-title"><?= e($item['title']) ?></h3>
                    <p class="news-body"><?= e($item['body']) ?></p>
                </article>
            </div>
        <?php endforeach; ?>
    </div>
</section>
