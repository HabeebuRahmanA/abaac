<?= view('manager/temp-parts/header') ?>

<div class="container-fluid">
    <div class="row">
        <?= view('manager/temp-parts/sidebar'); ?>

        <!-- Main content area -->
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
            <div class="container mt-5">
                <div class="row">
                    <div class="col-md-8 offset-md-2">
                        <div class="card shadow-lg">
                            <div class="card-header">
                                <h1 class="text-center">Create New User</h1>
                            </div>
                            <div class="card-body">
                                <!-- Error Alert -->
                                <?php if (session()->has('errors')) : ?>
                                    <div class="alert alert-danger" role="alert">
                                        <ul>
                                            <?php foreach (session('errors') as $error) : ?>
                                                <li><?= $error ?></li>
                                            <?php endforeach ?>
                                        </ul>
                                    </div>
                                <?php endif ?>

                                <!-- User Creation Form -->
                                <!-- User Creation Form -->
                                <form action="<?= site_url('manager/save-user') ?>" method="post">
                                    <div class="mb-3">
                                        <label for="username" class="form-label">Username</label>
                                        <input type="text" class="form-control" id="username" name="username" value="user" required autocomplete="off">
                                    </div>
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="email" name="email" required autocomplete="off">
                                    </div>
                                    <div class="mb-3">
                                        <label for="password" class="form-label">Password</label>
                                        <input type="password" class="form-control" id="password" name="password" required autocomplete="off">
                                    </div>
                                    <div class="d-grid gap-2">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<?= view('manager/temp-parts/footer') ?>