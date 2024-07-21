<?= view('admin/temp-parts/header') ?>

<div class="container-fluid">
    <div class="row">
        <?= view('admin/temp-parts/sidebar'); ?>

        <!-- Main content area -->
        <div class="container py-5">
            <div class="card mx-auto shadow-lg" style="max-width: 600px;">
                <div class="card-body">
                    <h5 class="card-title"><?= esc($package->PackageName) ?></h5>
                    <h6 class="card-subtitle mb-2 text-muted">Package ID: <?= esc($package->PackageID) ?></h6>
                    <p class="card-text"><?= esc($package->PackageDescription) ?></p>
                    <p class="card-text"><strong>Price:</strong> $<?= esc($package->PackagePrice) ?></p>
                    <a href="<?= site_url('admin/purchase/confirm/' . $package->PackageID) . '/'.$userid  ?>" class="btn btn-primary btn-block">Purchase Now</a>
                </div>
            </div>
        </div>
    </div>
</div>

<?= view('admin/temp-parts/footer') ?>
