<div class="sidebar-backdrop" id="sidebarBackdrop"></div>

<aside class="sidebar" id="sidebar" aria-label="Portal navigation">
    <div class="brand">
        <div class="brand-mark" aria-hidden="true"></div>
        <div>
            <div class="brand-name">EBRGY</div>
            <div class="brand-sub">Kawiteños Portal</div>
        </div>
    </div>

    <button type="button" class="account-card btn text-start p-0" id="accountCard" style="border:none;" title="Log out">
        <div class="account-avatar" aria-hidden="true"></div>
        <div>
            <div class="account-name"><?= e($user['fullname'] ?? 'Resident') ?></div>
            <div class="account-sub">@<?= e($user['username'] ?? '') ?></div>
        </div>
        <i class="bi bi-box-arrow-right account-chevron" aria-hidden="true"></i>
    </button>

    <div class="nav-label">YOUR PORTAL</div>
    <nav class="side-nav">
        <a href="index.php#overview" class="nav-link" aria-current="page">
            <i class="bi bi-grid-1x2-fill" aria-hidden="true"></i>
            Overview
        </a>
        <a href="index.php#services" class="nav-link">
            <i class="bi bi-file-earmark-text" aria-hidden="true"></i>
            Document Request
        </a>
        <a href="index.php#announcements" class="nav-link">
            <i class="bi bi-megaphone" aria-hidden="true"></i>
            Announcements
        </a>
        <a href="index.php#requests" class="nav-link">
            <i class="bi bi-clock-history" aria-hidden="true"></i>
            My Requests
        </a>
        <a href="logout.php" class="nav-link nav-logout">
            <i class="bi bi-box-arrow-left" aria-hidden="true"></i>
            Log out
        </a>
    </nav>
</aside>
