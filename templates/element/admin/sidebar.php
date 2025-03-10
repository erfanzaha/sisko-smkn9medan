<!-- Side Nav START -->
<div class="side-nav">
    <div class="side-nav-inner">
        <?php if($level == "admin"): ?>
        <ul class="side-nav-menu scrollable">
            <li>
                <a href="<?= $this->Url->build('/admin/dashboard') ?>">
                    <span class="icon-holder">
                        <i class="anticon anticon-dashboard"></i>
                    </span>
                    <span class="title">Dashboard</span>
                </a>
            </li>

            <li>
                <a href="<?= $this->Url->build('/admin/administrator') ?>">
                    <span class="icon-holder">
                        <i class="anticon anticon-user"></i>
                    </span>
                    <span class="title">Administrator</span>
                </a>
            </li>
            <li>
                <a href="<?= $this->Url->build('/admin/guru-pegawai') ?>">
                    <span class="icon-holder">
                        <i class="anticon anticon-usergroup-add"></i>
                    </span>
                    <span class="title">Guru & Pegawai</span>
                </a>
            </li>
            <li>
                <a href="<?= $this->Url->build('/admin/orang-tua') ?>">
                    <span class="icon-holder">
                        <i class="anticon anticon-usergroup-add"></i>
                    </span>
                    <span class="title">Orang Tua Siswa</span>
                </a>
            </li>
            <li>
                <a href="<?= $this->Url->build('/admin/siswa') ?>">
                    <span class="icon-holder">
                        <i class="anticon anticon-user-add"></i>
                    </span>
                    <span class="title">Siswa</span>
                </a>
            </li>
            <li>
                <a href="<?= $this->Url->build('/admin/tahun-ajaran') ?>">
                    <span class="icon-holder">
                        <i class="anticon anticon-calendar"></i>
                    </span>
                    <span class="title">Tahun Ajaran</span>
                </a>
            </li>
            <li>
                <a href="<?= $this->Url->build('/admin/kelas') ?>">
                    <span class="icon-holder">
                        <i class="anticon anticon-idcard"></i>
                    </span>
                    <span class="title">Kelas</span>
                </a>
            </li>
            <li>
                <a href="<?= $this->Url->build('/admin/kelas-yang-diajar') ?>">
                    <span class="icon-holder">
                        <i class="anticon anticon-idcard"></i>
                    </span>
                    <span class="title">Kelas yang Diajar</span>
                </a>
            </li>
            <li>
                <a href="<?= $this->Url->build('/admin/mata-pelajaran') ?>">
                    <span class="icon-holder">
                        <i class="anticon anticon-branches"></i>
                    </span>
                    <span class="title">Mata Pelajaran</span>
                </a>
            </li>
            <li>
                <a href="<?= $this->Url->build('/admin/berita') ?>">
                    <span class="icon-holder">
                        <i class="anticon anticon-file-text"></i>
                    </span>
                    <span class="title">Berita</span>
                </a>
            </li>
            <li>
                <a href="<?= $this->Url->build('/admin/kegiatan') ?>">
                    <span class="icon-holder">
                        <i class="anticon anticon-picture"></i>
                    </span>
                    <span class="title">Kegiatan</span>
                </a>
            </li>
            <li>
                <a href="<?= $this->Url->build('/admin/profil-sekolah') ?>">
                    <span class="icon-holder">
                        <i class="anticon anticon-bank"></i>
                    </span>
                    <span class="title">Profil Sekolah</span>
                </a>
            </li>
            <li>
                <a href="<?= $this->Url->build('/admin/jadwal-pembayaran') ?>">
                    <span class="icon-holder">
                        <i class="anticon anticon-audit"></i>
                    </span>
                    <span class="title">Jadwal Pembayaran</span>
                </a>
            </li>
            <li>
                <a href="<?= $this->Url->build('/admin/pembayaran') ?>">
                    <span class="icon-holder">
                        <i class="anticon anticon-schedule"></i>
                    </span>
                    <span class="title">Pembayaran</span>
                </a>
            </li>

            <li>
                <a href="<?= $this->Url->build('/admin/nilai') ?>">
                    <span class="icon-holder">
                        <i class="anticon anticon-file-done"></i>
                    </span>
                    <span class="title">Nilai</span>
                </a>
            </li>

        </ul>
        <?php elseif($level == "siswa"): ?>
        <ul class="side-nav-menu scrollable">
            <li>
                <a href="<?= $this->Url->build('/siswa/dashboard') ?>">
                    <span class="icon-holder">
                        <i class="anticon anticon-dashboard"></i>
                    </span>
                    <span class="title">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="<?= $this->Url->build('/siswa/mata-pelajaran') ?>">
                    <span class="icon-holder">
                        <i class="anticon anticon-branches"></i>
                    </span>
                    <span class="title">Mata Pelajaran</span>
                </a>
            </li>
            <li>
                <a href="<?= $this->Url->build('/siswa/nilai') ?>">
                    <span class="icon-holder">
                        <i class="anticon anticon-file-done"></i>
                    </span>
                    <span class="title">Nilai</span>
                </a>
            </li>
            <li>
                <a href="<?= $this->Url->build('/siswa/laporan') ?>">
                    <span class="icon-holder">
                        <i class="anticon anticon-file-done"></i>
                    </span>
                    <span class="title">Report</span>
                </a>
            </li>
        </ul>
        <?php elseif($level == "orang tua"): ?>
        <ul class="side-nav-menu scrollable">
            <li>
                <a href="<?= $this->Url->build('/orangtua/dashboard') ?>">
                    <span class="icon-holder">
                        <i class="anticon anticon-dashboard"></i>
                    </span>
                    <span class="title">Dashboard</span>
                </a>
            </li>

            <li>
                <a href="<?= $this->Url->build('/orangtua/nilai') ?>">
                    <span class="icon-holder">
                        <i class="anticon anticon-file-done"></i>
                    </span>
                    <span class="title">Nilai</span>
                </a>
            </li>

            <li>
                <a href="<?= $this->Url->build('/orangtua/laporan') ?>">
                    <span class="icon-holder">
                        <i class="anticon anticon-file-done"></i>
                    </span>
                    <span class="title">Report</span>
                </a>
            </li>
        </ul>
        <?php elseif($level == "guru"): ?>
        <ul class="side-nav-menu scrollable">
            <li>
                <a href="<?= $this->Url->build('/guru/dashboard') ?>">
                    <span class="icon-holder">
                        <i class="anticon anticon-dashboard"></i>
                    </span>
                    <span class="title">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="<?= $this->Url->build('/guru/nilai') ?>">
                    <span class="icon-holder">
                        <i class="anticon anticon-file-done"></i>
                    </span>
                    <span class="title">Nilai</span>
                </a>
            </li>
            <li>
                <a href="<?= $this->Url->build('/guru/kelas') ?>">
                    <span class="icon-holder">
                        <i class="anticon anticon-idcard"></i>
                    </span>
                    <span class="title">Kelas</span>
                </a>
            </li>
            <li>
                <a href="<?= $this->Url->build('/guru/wali-kelas') ?>">
                    <span class="icon-holder">
                        <i class="anticon anticon-idcard"></i>
                    </span>
                    <span class="title">Wali Kelas</span>
                </a>
            </li>
        </ul>
        <?php endif; ?>
    </div>
</div>
<!-- Side Nav END -->