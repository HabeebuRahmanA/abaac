<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <nav class="col-md-2 d-none d-md-block sidebar">
            <div class="sidebar-sticky">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link <?= (current_url() == base_url('customer')) ? 'active' : '' ?>" href="<?= base_url('customer '); ?>">
                            Manager Dashboard <span class="sr-only">(current)</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= (current_url() == base_url('manager/customers')) ? 'active' : '' ?>" href="<?= base_url('manager/customers/'.$manager->UserID); ?>">
                            Customers
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= (current_url() == base_url('admin/products')) ? 'active' : '' ?>" href="<?= base_url('admin/products'); ?>">
                            Settings
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= (current_url() == base_url('admin/customers')) ? 'active' : '' ?>" href="<?= base_url('admin/customers'); ?>">
                            Others
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
