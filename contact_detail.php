<?= $this->extend('layout/page_layout') ?>

<?= $this->section('content') ?>
<div class="container py-5">
    <div class="card shadow border-0">
        <div class="card-body p-5">
            <h2 class="fw-bolder mb-4">Message Detail</h2>
            <hr>
            <div class="row mb-3">
                <div class="col-sm-3 fw-bold">From:</div>
                <div class="col-sm-9"><?= esc($contact['name']) ?> (<?= esc($contact['email']) ?>)</div>
            </div>
            <div class="row mb-3">
                <div class="col-sm-3 fw-bold">Phone:</div>
                <div class="col-sm-9"><?= esc($contact['phone']) ?></div>
            </div>
            <div class="row mb-3">
                <div class="col-sm-3 fw-bold">Date:</div>
                <div class="col-sm-9"><?= date('d M Y, H:i', strtotime($contact['created_at'])) ?></div>
            </div>
            <div class="row mb-3">
                <div class="col-sm-3 fw-bold">Message:</div>
                <div class="col-sm-9 p-3 bg-light rounded"><?= nl2br(esc($contact['message'])) ?></div>
            </div>
            <a href="<?= base_url('contact/list') ?>" class="btn btn-primary mt-3">Back to List</a>
        </div>
    </div>
</div>
<?= $this->endSection() ?>