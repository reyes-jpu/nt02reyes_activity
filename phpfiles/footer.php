<footer class="site-footer">
    <div class="footer-grid">
        <div>
            <div class="footer-brand">EBRGY &middot; Kawiteños Portal</div>
            <p class="footer-text">Online services for the residents of <?= e($barangay['name']) ?>, <?= e($barangay['location']) ?>.</p>
        </div>
        <div>
            <div class="footer-heading">Barangay Hall</div>
            <p class="footer-text"><i class="bi bi-clock" aria-hidden="true"></i> <?= e($barangay['office_hours']) ?></p>
            <p class="footer-text"><i class="bi bi-telephone" aria-hidden="true"></i> Emergency: <?= e($barangay['emergency']) ?></p>
        </div>
        <div>
            <div class="footer-heading">Quick Links</div>
            <a href="#services" class="footer-link">Document Request</a>
            <a href="#announcements" class="footer-link">Announcements</a>
            <a href="#requests" class="footer-link">My Requests</a>
        </div>
    </div>
    <div class="footer-bottom">&copy; <?= date('Y') ?> EBRGY. All rights reserved.</div>
</footer>
