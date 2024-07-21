<?= view('admin/temp-parts/header') ?>

<div class="container-fluid">
    <div class="row">
        <?= view('admin/temp-parts/sidebar'); ?>

        <!-- Main content area -->
        <div class="container py-5">
            <h2 class="text-center mb-4">Edit Flat</h2>
            <form action="<?= site_url('admin/flats/update') ?>" method="post">
                <?= csrf_field() ?>
                <input type="hidden" name="FlatID" value="<?= esc($flat->FlatID) ?>">
                <div class="form-group">
                    <label for="FlatName">Flat Name</label>
                    <input type="text" class="form-control" id="FlatName" name="FlatName" value="<?= esc($flat->FlatName) ?>" required>
                </div>
                <div class="form-group">
                    <label for="FlatAddress">Flat Address</label>
                    <input type="text" class="form-control" id="FlatAddress" name="FlatAddress" value="<?= esc($flat->FlatAddress) ?>" required>
                </div>
                <div class="form-group">
                    <label for="ManagerID">Manager</label>
                    <select class="form-control" id="ManagerID" name="ManagerID" required>
                        <?php foreach ($managers as $manager) : ?>
                            <option value="<?= esc($manager->UserID) ?>" <?= $manager->UserID == $flat->ManagerID ? 'selected' : '' ?>>
                                <?= esc($manager->FirstName) ?> <?= esc($manager->LastName) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="<?= site_url('flats') ?>" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>

<?= view('admin/temp-parts/footer') ?>
