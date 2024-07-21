<?= view('customer/temp-parts/header') ?>

<div class="container-fluid">
    <div class="row">
        <?= view('customer/temp-parts/sidebar'); ?>

        <!-- Main content area -->
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
            <div class="container mt-4">
                <h2>User Details Form <?php echo $userid ?></h2>
                <!-- Displaying the message -->
                <?php if (!empty($message)) : ?>
                    <div class="alert alert-info" role="alert">
                        <?= esc($message) ?>
                    </div>
                <?php endif; ?>

                <form action="<?= site_url('customer/saveDetails') ?>" method="post">
                    <div class="mb-3">
                        <label for="firstname" class="form-label">First Name</label>
                        <input type="text" class="form-control" id="firstname" name="firstname" value="<?= esc($FirstName ?? '') ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="lastname" class="form-label">Last Name</label>
                        <input type="text" class="form-control" id="lastname" name="lastname" value="<?= esc($LastName ?? '') ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone</label>
                        <input type="text" class="form-control" id="phone" name="phone" value="<?= esc($Phone ?? '') ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="dob" class="form-label">Date of Birth</label>
                        <input type="date" class="form-control" id="dob" name="dob" value="<?= esc($DOB ?? '') ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="gender" class="form-label">Gender</label>
                        <select class="form-select" id="gender" name="gender" required>
                            <option value="">Choose...</option>
                            <option value="Male" <?= (isset($Gender) && $Gender == 'Male') ? 'selected' : '' ?>>Male</option>
                            <option value="Female" <?= (isset($Gender) && $Gender == 'Female') ? 'selected' : '' ?>>Female</option>
                            <option value="Other" <?= (isset($Gender) && $Gender == 'Other') ? 'selected' : '' ?>>Other</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <input type="text" class="form-control" id="address" name="address" value="<?= esc($Address ?? '') ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="flatname" class="form-label">Flat Name</label>
                        <input type="text" class="form-control" id="flatname" name="flatname" value="<?= esc($flatname ?? '') ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="flataddress" class="form-label">Flat Address</label>
                        <input type="text" class="form-control" id="flataddress" name="flataddress" value="<?= esc($flataddress ?? '') ?>" required>
                    </div>
                    <input type="hidden" name="cuserid" value="<?= esc($userid); ?>">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>

        </main>
    </div>
</div>

<?= view('customer/temp-parts/footer') ?>