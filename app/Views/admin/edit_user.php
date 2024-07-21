<?= view('admin/temp-parts/header') ?>

<div class="container-fluid">
    <div class="row">
        <?= view('admin/temp-parts/sidebar'); ?>

        <!-- Main content area -->
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
            <div class="container mt-4">
                <h1>Edit User</h1>
                <?php if (session()->has('errors')) : ?>
                    <ul>
                        <?php foreach (session('errors') as $error) : ?>
                            <li><?= esc($error) ?></li>
                        <?php endforeach ?>
                    </ul>
                <?php endif ?>

                <form action="<?= site_url('admin/users/update/' . $user->id) ?>" method="post">

                   
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="<?= esc($user->email) ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="firstname" class="form-label">First Name</label>
                        <input type="text" class="form-control" id="firstname" name="firstname" value="<?= esc($additionalinfo->FirstName ?? '') ?>">
                    </div>
                    <div class="mb-3">
                        <label for="lastname" class="form-label">Last Name</label>
                        <input type="text" class="form-control" id="lastname" name="lastname" value="<?= esc($additionalinfo->LastName ?? '') ?>">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password">
                        <div class="form-text">Enter a new password or repeat the old one to confirm changes.</div>
                    </div>
                    <div class="mb-3">
                        <label for="group" class="form-label">User Role</label>
                        <select id="group" name="group" class="form-control mr-3">
                            <option value="">All Users</option>
                            <option value="superadmin" <?= ($userrole ?? '') == 'superadmin' ? 'selected' : '' ?>>Administrator</option>
                            <option value="manager" <?= ($userrole ?? '') == 'manager' ? 'selected' : '' ?>>Manager</option>
                            <option value="customer" <?= ($userrole ?? '') == 'customer' ? 'selected' : '' ?>>Customer</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone</label>
                        <input type="phone" class="form-control" id="phone" name="phone" value="<?= esc($additionalinfo->Phone ?? '') ?>">

                    </div>

                    <?php if ($userrole === 'customer') : ?>
                        <div class="mb-3">
                            <label for="manager" class="form-label">Manager</label>
                            <select class="form-control" id="manager" name="manager">
                                <option value="">Select a Manager</option>
                                <?php foreach ($managers as $manager) : ?>
                                    <option value="<?= esc($manager->id) ?>" <?= (isset($additionalinfo->ManagerID) && $additionalinfo->ManagerID == $manager->id) ? 'selected' : '' ?>>
                                        <?= esc($manager->username . ' - ' . $manager->email) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    <?php endif; ?>


                    <div class="mb-3">
                        <label for="dob" class="form-label">Date of Birth</label>
                        <input type="date" class="form-control" id="dob" name="dob" value="<?= esc($additionalinfo->DOB ?? '') ?>">
                    </div>
                    <div class="mb-3">
                        <label for="gender" class="form-label">Gender</label>
                        <select class="form-select" id="gender" name="gender">
                            <option value="">Choose...</option>
                            <option value="Male" <?= (isset($additionalinfo->Gender) && $additionalinfo->Gender == 'Male') ? 'selected' : '' ?>>Male</option>
                            <option value="Female" <?= (isset($additionalinfo->Gender) && $additionalinfo->Gender == 'Female') ? 'selected' : '' ?>>Female</option>
                            <option value="Other" <?= (isset($additionalinfo->Gender) && $additionalinfo->Gender == 'Other') ? 'selected' : '' ?>>Other</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <input type="text" class="form-control" id="address" name="address" value="<?= esc($additionalinfo->Address ?? '') ?>">
                    </div>
                    <div class="mb-3">
                        <label for="flatname" class="form-label">Flat Name</label>
                        <input type="text" class="form-control" id="flatname" name="flatname" value="<?= esc($flatdetails->FlatName ?? '') ?>">
                    </div>
                    <div class="mb-3">
                        <label for="flataddress" class="form-label">Flat Address</label>
                        <input type="text" class="form-control" id="flataddress" name="flataddress" value="<?= esc($flatdetails->FlatAddress ?? '') ?>">
                    </div>
                    <input type="hidden" name="cuserid" value="<?= esc($user->id); ?>">


                    <button type="submit" class="btn btn-primary">Update User</button>
                </form>
                <br><br>
                <h2>Subscriptions</h2>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col"> <a href="<?= site_url('admin/users/plan/' . $user->id) ?>"> <button type="" class="btn btn-primary">Add Subscription</button> </a> </th>
                            </tr>
                            <tr>
                                <th scope="col">Subscription ID</th>
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

            </div>
        </main>
    </div>
</div>

<?= view('admin/temp-parts/footer') ?>