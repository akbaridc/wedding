<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link" href="<?= base_url('dashboard') ?>">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li><!-- End Dashboard Nav -->

        <li class="nav-heading">Master</li>

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#master-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-menu-button-wide"></i><span>Master</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="master-nav" class="nav-content collapse <?= $sidebar['parent'] == 'Master' ? 'show' : '' ?>" data-bs-parent="#sidebar-nav">
                <li>
                    <a href="<?= base_url('mempelai') ?>" class="<?= isset($sidebar['child']) && $sidebar['child'] == 'mempelai' ? 'active' : '' ?>">
                        <i class="bi bi-circle"></i><span>Mempelai</span>
                    </a>
                </li>
                <li>
                    <a href="<?= base_url('acara') ?>" class="<?= isset($sidebar['child']) && $sidebar['child'] == 'acara' ? 'active' : '' ?>">
                        <i class="bi bi-circle"></i><span>Acara</span>
                    </a>
                </li>
                <li>
                    <a href="<?= base_url('tamu-undangan') ?>" class="<?= isset($sidebar['child']) && $sidebar['child'] == 'tamu undangan' ? 'active' : '' ?>">
                        <i class="bi bi-circle"></i><span>Tamu Undangan</span>
                    </a>
                </li>
                <li>
                    <a href="<?= base_url('galery') ?>" class="<?= isset($sidebar['child']) && $sidebar['child'] == 'galery' ? 'active' : '' ?>">
                        <i class="bi bi-circle"></i><span>Galery</span>
                    </a>
                </li>
                <li>
                    <a href="<?= base_url('banner') ?>" class="<?= isset($sidebar['child']) && $sidebar['child'] == 'banner' ? 'active' : '' ?>">
                        <i class="bi bi-circle"></i><span>Banner</span>
                    </a>
                </li>
                <li>
                    <a href="<?= base_url('rekening') ?>" class="<?= isset($sidebar['child']) && $sidebar['child'] == 'rekening' ? 'active' : '' ?>">
                        <i class="bi bi-circle"></i><span>Rekening</span>
                    </a>
                </li>
                <li>
                    <a href="<?= base_url('rekening-hadiah') ?>" class="<?= isset($sidebar['child']) && $sidebar['child'] == 'rekening hadiah' ? 'active' : '' ?>">
                        <i class="bi bi-circle"></i><span>Rekening Hadiah</span>
                    </a>
                </li>
            </ul>
        </li>

        <li class="nav-heading">Aktifitas</li>

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#aktifitas-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-activity button-wide"></i><span>Aktifitas</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="aktifitas-nav" class="nav-content collapse <?= $sidebar['parent'] == 'Aktifitas' ? 'show' : '' ?>" data-bs-parent="#sidebar-nav">
                <li>
                    <a href="<?= base_url('kehadiran') ?>" class="<?= isset($sidebar['child']) && $sidebar['child'] == 'kehadiran tamu undangan' ? 'active' : '' ?>">
                        <i class="bi bi-circle"></i><span>Kehadiran Tamu Undangan</span>
                    </a>
                </li>
                <li>
                    <a href="<?= base_url('ucapan') ?>" class="<?= isset($sidebar['child']) && $sidebar['child'] == 'ucapan tamu undangan' ? 'active' : '' ?>">
                        <i class="bi bi-circle"></i><span>Ucapan Tamu Undangan</span>
                    </a>
                </li>
            </ul>
        </li>

        <li class="nav-heading">Setting</li>

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#setting-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-gear button-wide"></i><span>Setting</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="setting-nav" class="nav-content collapse <?= $sidebar['parent'] == 'Setting' ? 'show' : '' ?>" data-bs-parent="#sidebar-nav">
                <li>
                    <a href="<?= base_url('audio') ?>" class="<?= isset($sidebar['child']) && $sidebar['child'] == 'audio' ? 'active' : '' ?>">
                        <i class="bi bi-circle"></i><span>Sound Audio</span>
                    </a>
                </li>
                <li>
                    <a href="<?= base_url('maps') ?>" class="<?= isset($sidebar['child']) && $sidebar['child'] == 'maps' ? 'active' : '' ?>">
                        <i class="bi bi-circle"></i><span>Maps Acara</span>
                    </a>
                </li>
            </ul>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="<?= base_url('logout') ?>">
                <i class="bi bi-box-arrow-right"></i>
                <span>Logout</span>
            </a>
        </li>

    </ul>

</aside>
