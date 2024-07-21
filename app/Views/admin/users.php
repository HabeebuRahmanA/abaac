<?= view('admin/temp-parts/header') ?>

<div class="container-fluid">
    <div class="row">
        <?= view('admin/temp-parts/sidebar'); ?>

        <!-- Main content area -->
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
            <div class="container mt-4">
                <h1>All User List</h1>

                <!-- Button to add a new user and dropdowns for user control -->
                <div class="mb-3 d-flex justify-content-between align-items-center">
                    <a href="<?= site_url('admin/create-user') ?>" class="btn btn-success">Add User</a>

                    <!-- Form to control pagination and filtering -->
                    <div>
                        <form action="<?= site_url('admin/users') ?>" method="get" class="form-inline">
                            <label for="perPage" class="mr-2">Results per page:</label>
                            <select id="perPage" name="perPage" onchange="this.form.submit()" class="form-control mr-3">
                                <option value="5" <?= $perPage == 5 ? 'selected' : '' ?>>5</option>
                                <option value="10" <?= $perPage == 10 ? 'selected' : '' ?>>10</option>
                                <option value="20" <?= $perPage == 20 ? 'selected' : '' ?>>20</option>
                                <option value="30" <?= $perPage == 30 ? 'selected' : '' ?>>30</option>
                            </select>

                            <label for="group" class="mr-2">User Group:</label>
                            <select id="group" name="group" onchange="this.form.submit()" class="form-control mr-3">
                                <option value="">All Users</option>
                                <option value="superadmin" <?= $selectedGroup == 'superadmin' ? 'selected' : '' ?>>Administrators</option>
                                <option value="manager" <?= $selectedGroup == 'manager' ? 'selected' : '' ?>>Managers</option>
                                <option value="customer" <?= $selectedGroup == 'customer' ? 'selected' : '' ?>>Customers</option>
                            </select> 
                            <input type="hidden" name="search" value="<?= esc($search) ?>">
                        </form>
                        <br> 
                        <form action="<?= site_url('admin/users') ?>" method="get" class="form-inline">
                            <input type="text" name="search" class="form-control mr-2" placeholder="Search users..." value="<?= esc($search) ?>" />
                            <button type="submit" class="btn btn-primary">Search</button>
                        </form>
                    </div>
                </div>

                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            
                            <th>Email</th>
                            <th>User Roles</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($users as $user) : ?>
                            <tr>
                                <td><?= $user->id ?></td>
                                
                                <td><?= $user->email ?></td>
                                <td>
                                    <?= $user->inGroup('superadmin') ? 'Super Admin' : '' ?>
                                    <?= $user->inGroup('customer') ? ' Customer' : '' ?>
                                    <?= $user->inGroup('manager') ? ' Manager' : '' ?>
                                </td>
                                <td>
                                    <a href="<?= site_url('admin/users/edit/' . $user->id) ?>" class="btn btn-primary btn-sm">Edit</a>
                                    <a href="<?= site_url('admin/users/delete/' . $user->id) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this user?');">Delete</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

                <!-- Render pagination links -->
                <?= $pager->links('default', 'vd_custom_template') ?>
            </div>
        </main>
    </div>
</div>

<?= view('admin/temp-parts/footer') ?>
