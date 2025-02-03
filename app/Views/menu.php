<?php $currentUri = uri_string(); ?>

<body>
    <div id="app">
        <div id="sidebar" class="active">
            <div class="sidebar-wrapper active">
                <div class="sidebar-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="logo">
                            <img src="<?= base_url('images/' . $yogi->logo_website) ?>" alt="logo" style="max-width: 200%; height: 150px; max-height: 200px;"/>
                        </div>
                        <div class="toggler">
                            <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                        </div>
                    </div>
                </div>

                <div class="sidebar-menu">
                    <ul class="menu">
                        <li class="sidebar-title">Menu</li>

                        <!-- Dashboard -->
                        <li class="sidebar-item <?= ($currentUri == 'home/dashboard') ? 'active' : '' ?>">
        <a href="<?= base_url('home/dashboard') ?>" class='sidebar-link'>
            <i class="bi bi-speedometer2"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <!-- Lowongan -->
    <li class="sidebar-item has-sub <?= (in_array($currentUri, ['home/modal_produksi', 'home/penjualan_produk', 'home/pengeluaran', 'home/laporan_keuangan'])) ? 'active' : '' ?>">
                            <a href="#" class='sidebar-link'>
                                <i class="bi bi-file-earmark-medical-fill"></i>
                                <span>Luas</span>
                            </a>
                            <ul class="submenu">
                                <li class="submenu-item <?= ($currentUri == 'home/persegi') ? 'active' : '' ?>">
                                    <a href="<?= base_url('home/persegi') ?>">Persegi</a>
                                </li>
                                <li class="submenu-item <?= ($currentUri == 'home/surat_keluar') ? 'active' : '' ?>">
                                    <a href="<?= base_url('home/surat_keluar') ?>">Persegi Panjang</a>
                                </li>
                                <li class="submenu-item <?= ($currentUri == 'home/surat_keterlambatan') ? 'active' : '' ?>">
                                    <a href="<?= base_url('home/surat_keterlambatan') ?>">Segitiga</a>
                                </li>
                                <li class="submenu-item <?= ($currentUri == 'home/pengajuan_cuti') ? 'active' : '' ?>">
                                    <a href="<?= base_url('home/pengajuan_cuti') ?>">Jajar Genjang</a>
                                </li>
                                <li class="submenu-item <?= ($currentUri == 'home/pengajuan_cuti') ? 'active' : '' ?>">
                                    <a href="<?= base_url('home/pengajuan_cuti') ?>">Trapesium</a>
                                </li>
                                <li class="submenu-item <?= ($currentUri == 'home/pengajuan_cuti') ? 'active' : '' ?>">
                                    <a href="<?= base_url('home/pengajuan_cuti') ?>">Layang-Layang</a>
                                </li>
                                <li class="submenu-item <?= ($currentUri == 'home/pengajuan_cuti') ? 'active' : '' ?>">
                                    <a href="<?= base_url('home/pengajuan_cuti') ?>">Belah Ketupat</a>
                                </li>
                                <li class="submenu-item <?= ($currentUri == 'home/pengajuan_cuti') ? 'active' : '' ?>">
                                    <a href="<?= base_url('home/pengajuan_cuti') ?>">Lingkaran</a>
                                </li>
                            </ul>
                        </li>

    <!-- Lamaran -->
    <!-- <li class="sidebar-item <?= ($currentUri == 'home/lamaran') ? 'active' : '' ?>">
        <a href="<?= base_url('home/lamaran') ?>" class='sidebar-link'>
            <i class="bi bi-file-earmark-text-fill"></i>
            <span>Lamaran</span>
        </a>
    </li> -->

   

    <li class="sidebar-item <?= ($currentUri == 'home/user') ? 'active' : '' ?>">
        <a href="<?= base_url('home/user') ?>" class='sidebar-link'>
            <i class="bi bi-person-fill"></i>
            <span>User</span>
        </a>
    </li>

    <!-- Settings -->
    <li class="sidebar-item <?= ($currentUri == 'home/setting') ? 'active' : '' ?>">
        <a href="<?= base_url('home/setting') ?>" class='sidebar-link'>
            <i class="bi bi-gear-fill"></i>
            <span>Settings</span>
        </a>
    </li>

    <!-- Soft Delete -->
    <li class="sidebar-item <?= ($currentUri == 'home/soft_delete') ? 'active' : '' ?>">
        <a href="<?= base_url('home/soft_delete') ?>" class='sidebar-link'>
            <i class="bi bi-trash-fill"></i>
            <span>Soft Delete</span>
        </a>
    </li>

    <!-- Restore Edit -->
    <li class="sidebar-item <?= ($currentUri == 'home/restore_edit') ? 'active' : '' ?>">
        <a href="<?= base_url('home/restore_edit') ?>" class='sidebar-link'>
            <i class="bi bi-arrow-repeat"></i>
            <span>Restore Edit</span>
        </a>
    </li>

    <!-- Log Activity -->
    <li class="sidebar-item <?= ($currentUri == 'home/log_activity') ? 'active' : '' ?>">
        <a href="<?= base_url('home/log_activity') ?>" class='sidebar-link'>
            <i class="bi bi-clock-history"></i>
            <span>Log Activity</span>
        </a>
    </li>


<li class="sidebar-item <?= ($currentUri == 'home/logout') ? 'active' : '' ?>">
    <a href="<?= base_url('home/logout') ?>" class='sidebar-link'>
        <i class="bi bi-box-arrow-right"></i>
        <span>Logout</span>
    </a>
</li>
                    </ul>
                </div>
            </div>
        </div>
        <div id="main">
            <header class="mb-3"></header>
