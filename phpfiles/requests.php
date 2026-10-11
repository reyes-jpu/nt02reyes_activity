<section class="section-block" id="requests">
    <div class="section-head">
        <h2 class="section-title">My Recent Requests <span class="demo-pill">Sample data</span></h2>
        <p class="section-sub">Keep track of the documents you have requested.</p>
    </div>

    <div class="panel">
        <div class="table-responsive">
            <table class="request-table">
                <thead>
                    <tr>
                        <th>Reference No.</th>
                        <th>Document</th>
                        <th>Filed</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($requests as $request): ?>
                        <tr>
                            <td data-label="Reference No."><?= e($request['ref']) ?></td>
                            <td data-label="Document"><?= e($request['document']) ?></td>
                            <td data-label="Filed"><?= date('M j, Y', strtotime('-' . (int) $request['filed_days_ago'] . ' days')) ?></td>
                            <td data-label="Status">
                                <span class="status-pill <?= e(strtolower(str_replace(' ', '-', $request['status']))) ?>"><?= e($request['status']) ?></span>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</section>
