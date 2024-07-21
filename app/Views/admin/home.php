<?= view('admin/temp-parts/header') ?>

<div class="container-fluid">
    <div class="row">
        <?= view('admin/temp-parts/sidebar'); ?>

        <!-- Main content area -->



        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
            <?php if (session()->has('success')) : ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?= session()->get('success') ?>
                    
                </div>
            <?php endif; ?>
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Admin Dashboard</h1>

            </div>
            <div class="table-responsive">
                <h2>Subscriptions</h2>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Subscription ID</th>
                            <th scope="col">User</th>
                            <th scope="col">Package ID</th>
                            <th scope="col">Purchase Date</th>
                            <th scope="col">Expiry Date</th>
                            <th scope="col">Total Services</th>
                            <th scope="col">Remaining Services</th>
                            <th scope="col">Update Remaining Services</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($subscriptions as $subscription) : ?>
                            <tr>
                                <td><?= esc($subscription->SubscriptionID) ?></td>
                                <td>
                                    <?php foreach ($users as $user) : ?>
                                        <?php if ($user->UserID == $subscription->UserID) : ?>
                                            <a href="<?= site_url('admin/users/edit/' . $user->UserID) ?>">
                                                <?= esc($user->FirstName . ' ' . $user->LastName) ?>
                                            </a>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </td>
                                <td><?= esc($subscription->PackageID) ?></td>
                                <td><?= esc($subscription->PurchaseDate) ?></td>
                                <td><?= esc($subscription->ExpiryDate) ?></td>
                                <td><?= esc($subscription->TotalServices) ?></td>
                                <td><?= esc($subscription->RemainingServices) ?></td>
                                <td>
                                    <form action="<?= site_url('admin/subscriptions/update/' . $subscription->SubscriptionID) ?>" method="POST">
                                        <input type="number" name="remaining_services" value="<?= esc($subscription->RemainingServices) ?>" min="0" max="<?= esc($subscription->TotalServices) ?>" required>
                                        <button type="submit" class="btn btn-primary">Update</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </main>
    </div>
</div>




<?= view('admin/temp-parts/footer') ?>