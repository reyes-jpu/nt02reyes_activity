<div class="row" id="overview">
    <div class="col-12">
        <div id="greetingCarousel" class="carousel slide greeting-card" data-bs-ride="carousel" data-bs-interval="6000">
            <div class="carousel-inner">

                <div class="carousel-item active" style="background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('image/ngek.jpg');">
                    <h1 class="greeting-title"><?= e(greeting()) ?>, <span class="placeholder-name"><?= e(first_name($user['fullname'] ?? 'Resident')) ?></span>.</h1>
                    <p class="greeting-sub mb-3">Resident Overview &middot; <?= e($barangay['name']) ?></p>
                    <a href="#services" class="hero-btn">Request a document</a>
                </div>

                <div class="carousel-item" style="background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('image/wew.png');">
                    <h1 class="greeting-title"><?= count($announcements) ?> Announcements</h1>
                    <p class="greeting-sub mb-3">New updates from <?= e($barangay['name']) ?></p>
                    <a href="#announcements" class="hero-btn">Read updates</a>
                </div>

                <div class="carousel-item" style="background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('image/life.jpg');">
                    <h1 class="greeting-title"><?= (int) $pendingCount ?> Requests In Progress</h1>
                    <p class="greeting-sub mb-3">Track the status of your document requests</p>
                    <a href="#requests" class="hero-btn">Track requests</a>
                </div>

            </div>

            <div class="carousel-dots">
                <button type="button" data-bs-target="#greetingCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#greetingCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#greetingCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
        </div>
    </div>
</div>
