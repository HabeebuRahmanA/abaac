<?= view('customer/temp-parts/header') ?>

<div class="container-fluid">
    <div class="row">
        <?= view('customer/temp-parts/sidebar'); ?>

        <!-- Main content area -->
        <div class="container py-5">
            <h2 class="mb-4">Welcome, Customer</h2>
            <p>User ID: <?= esc($userid) ?></p>
            
            <h3>Your Subscriptions</h3>
            <?php if (!empty($subscriptions)) : ?>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Subscription ID</th>
                            <th scope="col">Package Name</th>
                            <th scope="col">Purchase Date</th>
                            <th scope="col">Expiry Date</th>
                            <th scope="col">Total Services</th>
                            <th scope="col">Remaining Services</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($subscriptions as $subscription) : ?>
                            <tr>
                                <td><?= esc($subscription->SubscriptionID) ?></td>
                                <td><?= esc($subscription->PackageName) ?></td>
                                <td><?= esc($subscription->PurchaseDate) ?></td>
                                <td><?= esc($subscription->ExpiryDate) ?></td>
                                <td><?= esc($subscription->TotalServices) ?></td>
                                <td><?= esc($subscription->RemainingServices) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else : ?>
                <p>You have no subscriptions.</p>
            <?php endif; ?>

            <h3>Contact Your Manager</h3>
            <?php if ($manager) : ?>
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"><?= esc($manager->FirstName . ' ' . $manager->LastName) ?></h5>
                        <p class="card-text"><strong>Mobile:</strong> <?= esc($manager->Phone) ?></p>
                        <p class="card-text"><strong>Email:</strong> <?= esc($manager->email) ?></p>
                    </div>
                </div>
            <?php else : ?>
                <p>No manager assigned to you.</p>
            <?php endif; ?>
        </div>
    </div>
</div>

<?= view('customer/temp-parts/footer') ?>
