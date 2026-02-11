<?= $this->extend('layout/page_layout') ?>

<?= $this->section('content') ?>
<section class="py-5">
    <div class="container px-5">
        <div class="card shadow-sm border-0">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="fw-bolder mb-0">Contact List</h2>
                    
                    <form action="" method="get" class="d-flex w-50">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control" placeholder="Search name, email, or phone..." value="<?= $keyword ?>">
                            <button class="btn btn-primary" type="submit">Search</button>
                        </div>
                    </form>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($contacts) && is_array($contacts)) : ?>
                                <?php foreach ($contacts as $c) : ?>
                                    <tr>
                                        <td><?= esc($c['name']) ?></td>
                                        <td><?= esc($c['email']) ?></td>
                                        <td><?= esc($c['phone']) ?></td>
                                        <td>
                                            <form action="<?= base_url('contact/delete/' . $c['id']) ?>" method="post" class="d-inline form-delete">
                                                <?= csrf_field() ?>
                                                <input type="hidden" name="_method" value="DELETE">
                                                <button type="button" class="btn btn-sm btn-outline-danger btn-hapus" title="Hapus Data">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <tr>
                                    <td colspan="4" class="text-center">No data found.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-center mt-4">
                    <?= $pager->links('contact_group', 'bootstrap_pagination') ?>
                </div>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>