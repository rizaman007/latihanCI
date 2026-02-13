<?= $this->extend('layout/page_layout') ?>

<?= $this->section('content') ?>
<div class="container py-5">
    <div class="card shadow border-0">
        <div class="card-body p-5">
            <h2 class="fw-bolder mb-4">Edit Contact</h2>
            <form action="<?= base_url('contact/update/' . $contact['id']) ?>" method="post">
                <?= csrf_field() ?>
                
                <div class="form-floating mb-3">
                    <input class="form-control <?= session('errors.name') ? 'is-invalid' : '' ?>" name="name" type="text" value="<?= old('name', $contact['name']) ?>" />
                    <label>Full Name</label>
                    <?php if(session('errors.name')) : ?>
                        <div class="invalid-feedback"><?= session('errors.name') ?></div>
                    <?php endif; ?>
                </div>

                <div class="form-floating mb-3">
                    <input class="form-control <?= session('errors.email') ? 'is-invalid' : '' ?>" name="email" type="email" value="<?= old('email', $contact['email']) ?>" />
                    <label>Email Address</label>
                    <?php if(session('errors.email')) : ?>
                        <div class="invalid-feedback"><?= session('errors.email') ?></div>
                    <?php endif; ?>
                </div>

                <div class="form-floating mb-3">
                    <input class="form-control <?= session('errors.phone') ? 'is-invalid' : '' ?>" name="phone" type="text" value="<?= old('phone', $contact['phone']) ?>" />
                    <label>Phone Number</label>
                    <?php if(session('errors.phone')) : ?>
                        <div class="invalid-feedback"><?= session('errors.phone') ?></div>
                    <?php endif; ?>
                </div>

                <div class="form-floating mb-3">
                    <textarea class="form-control <?= session('errors.message') ? 'is-invalid' : '' ?>" name="message" style="height: 10rem"><?= old('message', $contact['message']) ?></textarea>
                    <label>Message</label>
                    <?php if(session('errors.email')) : ?>
                        <div class="invalid-feedback"><?= session('errors.message') ?></div>
                    <?php endif; ?>
                </div>

                <div class="d-flex gap-2">
                    <button class="btn btn-primary" type="submit">Update Data</button>
                    <a href="<?= base_url('contact/list') ?>" class="btn btn-light btn-lg">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection() ?>