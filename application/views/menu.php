<ul class="nav navbar-nav side-nav">
    <li>
        <a href="<?= base_url() ?>panel/home/"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
    </li>

    <?php
    if ($this->session->userdata('role_id') == 0 || $this->session->userdata('role_id') == 2) {
        ?>
        <li>
            <a href="<?= base_url() ?>cari-kiriman/"><i class="fa fa-fw fa-search-plus"></i> Cari Kiriman</a>
        </li>
    <?php
    }

    if ($this->session->userdata('role_id') == 0 || $this->session->userdata('role_id') == 1) {
        ?>
        <li>
            <a href="<?= base_url() ?>kirim/"><i class="fa fa-fw fa-send"></i> Kirim</a>
        </li>
    <?php } ?>
    <li>
        <a href="<?= base_url() ?>kiriman"><i class="fa fa-fw fa-dropbox"></i> Kiriman</a>
    </li>

    <?php
    if ($this->session->userdata('role_id') == 0 || $this->session->userdata('role_id') == 2) {
        ?>
        <li>
            <a href="<?= base_url() ?>kendaraan"><i class="fa fa-fw fa-truck"></i> Kendaraan</a>
        </li>
        <li>
            <a href="<?= base_url() ?>supir"><i class="fa fa-fw fa-male"></i> Supir</a>
        </li>

        <li>
            <a href="<?= base_url() ?>tagihan"><i class="fa fa-fw fa-archive"></i> Tagihan</a>
        </li>

        <li>
            <a href="<?= base_url() ?>alat"><i class="fa fa-fw fa-tasks"></i> Alat</a>
        </li>
    <?php } ?>

    <?php
    if ($this->session->userdata('role_id') == 0 || $this->session->userdata('role_id') == 2) {
        ?>
        <li>
            <a href="<?= base_url() ?>lokasi"><i class="fa fa-fw fa-map-marker"></i> Lokasi</a>
        </li>
    <?php } ?>


        <li>
            <a href="<?= base_url() ?>rekanan"><i class="fa fa-fw fa-gift"></i> Rekanan</a>
        </li>
	    <?php
    //if ($this->session->userdata('role_id') == 0) {
        ?>	
        <li>
            <a href="<?= base_url() ?>user"><i class="fa fa-fw fa-user"></i> User</a>
        </li>
    <?php // } ?>


    <li>
        <a href="<?= base_url() ?>report"><i class="fa fa-fw fa-bar-chart"></i> Laporan</a>
    </li>
</ul>