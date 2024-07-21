<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <nav class="col-md-2 d-none d-md-block sidebar">
            <div class="sidebar-sticky">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link <?= (current_url() == base_url('customer')) ? 'active' : '' ?>" href="<?= base_url('customer'); ?>">
                            Customer Dashboard <span class="sr-only">(current)</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= (current_url() == base_url('customer/subscription')) ? 'active' : '' ?>" href="<?= base_url('customer/subscription'); ?>">
                            Subscriptions
                        </a>
                    </li>
                   
                    <li class="nav-item">
                        <a class="nav-link <?= (current_url() == base_url('customer/plans')) ? 'active' : '' ?>" href="<?= base_url('customer/plans'); ?>">
                            Purchase/Recharge
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= (current_url() == base_url('customer/account')) ? 'active' : '' ?>" href="<?= base_url('customer/account'); ?>">
                            My Account
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