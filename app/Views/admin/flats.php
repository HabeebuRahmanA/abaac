<?= view('admin/temp-parts/header') ?>

<div class="container-fluid">
    <div class="row">
        <?= view('admin/temp-parts/sidebar'); ?>

        <!-- Main content area -->
        <div class="container py-5">
            <h2 class="text-center mb-4">List of Flats</h2>
            <?php if (session()->has('message')): ?>
                <div class="alert alert-success"><?= session('message') ?></div>
            <?php endif; ?>
            <div class="row">
                <?php if (!empty($flats)) : ?>
                    <?php foreach ($flats as $flat) : ?>
                        <div class="col-md-4 mb-4">
                            <div class="card shadow-lg h-100">
                                <div class="card-body">
                                    <h5 class="card-title"><?= esc($flat->FlatName) ?></h5>
                                    <h6 class="card-subtitle mb-2 text-muted">Manager: <?= esc($flat->ManagerName) ?></h6>
                                    <p class="card-text"><?= esc($flat->FlatAddress) ?></p>
                                    <a href="<?= site_url('admin/flats/edit/' . $flat->FlatID) ?>" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="<?= site_url('admin/flats/delete/' . $flat->FlatID) ?>" method="post" class="d-inline">
                                        <?= csrf_field() ?>
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else : ?>
                    <p class="text-center">No flats found.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?= view('admin/temp-parts/footer') ?>
