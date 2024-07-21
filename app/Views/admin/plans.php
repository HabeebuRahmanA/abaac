<?= view('admin/temp-parts/header') ?>

<div class="container-fluid">
    <div class="row">
        <?= view('admin/temp-parts/sidebar'); ?>

        <!-- Main content area -->
        <div class="container py-5">
            <h2 class="mb-4">Choose Your Plan For User <i> <?= esc($user->email) ?> </i> </h2>
            <div class="row g-4">
                <!-- Hatchback Plan -->
                <div class="col-md-6 col-lg-3">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title">Hatchback</h5>
                            <p class="card-text">12 Exterior Washes/Month (3/Week)</p>
                            <p class="card-text">6 Interior Washes/Month</p>
                        </div>
                        <div class="card-footer">
                            <a href="pay/1/<?= esc($user->id) ?>" class="btn btn-primary">Choose Plan</a>
                        </div>
                    </div>
                </div>

                <!-- Sedan Plan -->
                <div class="col-md-6 col-lg-3">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title">Sedan</h5>
                            <p class="card-text">12 Exterior Washes/Month (3/Week)</p>
                            <p class="card-text">6 Interior Washes/Month</p>
                        </div>
                        <div class="card-footer">
                            <a href="pay/2/<?= esc($user->id) ?>" class="btn btn-primary">Choose Plan</a>
                        </div>
                    </div>
                </div>

                <!-- Premium Cars Plan -->
                <div class="col-md-6 col-lg-3">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title">Premium Cars</h5>
                            <p class="card-text">12 Exterior Washes/Month (3/Week)</p>
                            <p class="card-text">6 Interior Washes/Month</p>
                        </div>
                        <div class="card-footer">
                            <a href="pay/3/<?= esc($user->id) ?>" class="btn btn-primary">Choose Plan</a>
                        </div>
                    </div>
                </div>

                <!-- SUV Plan -->
                <div class="col-md-6 col-lg-3">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title">SUV</h5>
                            <p class="card-text">12 Exterior Washes/Month (3/Week)</p>
                            <p class="card-text">6 Interior Washes/Month</p>
                        </div>
                        <div class="card-footer">
                            <a href="pay/4/<?= esc($user->id) ?>" class="btn btn-primary">Choose Plan</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= view('admin/temp-parts/footer') ?>