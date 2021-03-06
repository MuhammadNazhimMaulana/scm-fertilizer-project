    <!-- Awal Sidebar -->
    <header class="header" id="header">
        <div class="header__toggle">
            <i class="fas fa-bars" id="header-toggle"></i>
        </div>

        <div class="header__image">
            <img src="<?= base_url('images/Rhino.jpg') ?>">
        </div>
    </header>

    <div class="l-navbar" id="nav-bar">
        <nav class="nav">
            <div>
                <a href="#" class="nav__logo">
                    <i class="fas fa-layer-group nav__logo__icon"></i>
                    <span class="nav__logo__name">Bonevian</span>
                </a>

                <div class="nav__list">
                    <a href="<?= site_url('admin/') ?>" class="nav__link <?= $title == 'Dashboard' ? 'active' : ''?>">
                        <i class="fas fa-th-large nav__icon"></i>
                        <span class="nav__name">Dashboard</span>
                    </a>
                    <a href="<?= site_url('admin/profile') ?>" class="nav__link <?= $title == 'Pengguna' ? 'active' : ''?>">
                        <i class="fas fa-user nav__icon"></i>
                        <span class="nav__name">User</span>
                    </a>

                    <a href="<?= site_url('Admin/Pesanan_A/read') ?>" class="nav__link <?= $title == 'Pesanan' ? 'active' : ''?>">
                        <i class="fas fa-blog nav__icon"></i>
                        <span class="nav__name">Pesanan</span>
                    </a>

                    <a href="<?= site_url('Admin/Produk_A/read') ?>" class="nav__link <?= $title == 'Produk' ? 'active' : ''?>">
                        <i class="fas fa-blog nav__icon"></i>
                        <span class="nav__name">Produk</span>
                    </a>

                </div>
            </div>

            <a href="<?= site_url('Auth/Authorisasi/logout') ?>" class="nav__link">
                <i class="fas fa-sign-out-alt nav__icon"></i>
                <span class="nav__name">Log Out</span>
            </a>

        </nav>
    </div>
    
    <!-- Akhir Sidebar -->