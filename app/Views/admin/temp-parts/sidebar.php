<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <nav class="col-md-2 d-none d-md-block sidebar">
            <div class="sidebar-sticky">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link <?= (current_url() == base_url('admin')) ? 'active' : '' ?>" href="<?= base_url('admin'); ?>">
                          Admin  Dashboard <span class="sr-only">(current)</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= (current_url() == base_url('admin/users')) ? 'active' : '' ?>" href="<?= base_url('admin/users'); ?>">
                            All Users
                        </a>
                    </li>
                    <!-- <li class="nav-item">
                        <a class="nav-link <?= (current_url() == base_url('admin/unassigned-users')) ? 'active' : '' ?>" href="<?= base_url('admin/unassigned-users'); ?>">
                            Unassigned Customers
                        </a>
                    </li> -->
                    <li class="nav-item">
                        <a class="nav-link <?= (current_url() == base_url('admin/managers')) ? 'active' : '' ?>" href="<?= base_url('admin/managers'); ?>">
                            Managers
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= (current_url() == base_url('admin/flats')) ? 'active' : '' ?>" href="<?= base_url('admin/flats'); ?>">
                            Flats
                        </a>
                    </li>
                    <li>&nbsp; </li>
                    <li> &nbsp;</li>
                    <!-- Logout Link -->
                    <li class="nav-item mt-auto">
                        <a class="nav-link" href="<?= base_url('logout'); ?>">
                            Logout
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
