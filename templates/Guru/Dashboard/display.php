<div class="row">
    <div class="col-md-6 col-lg-6">
        <div class="card">
            <div class="card-body">
                <div class="media align-items-center">
                    <div class="avatar avatar-icon avatar-lg avatar-blue">
                        <i class="anticon anticon-user"></i>
                    </div>
                    <div class="m-l-15">
                        <h2 class="m-b-0"><?= $dataJumlahSiswa ?></h2>
                        <p class="m-b-0 text-muted">Siswa Yang Diajar</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-6">
        <div class="card">
            <div class="card-body">
                <div class="media align-items-center">
                    <div class="avatar avatar-icon avatar-lg avatar-cyan">
                        <i class="anticon anticon-idcard"></i>
                    </div>
                    <div class="m-l-15">
                        <h2 class="m-b-0"><?= $dataKelasYangDiajar ?></h2>
                        <p class="m-b-0 text-muted">Kelas Yang Diajar</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12 col-lg-12">
        <div class="card">
            <div class="card-body">
                <button style="margin: 10px 0" class='btn btn-primary' title="Tambah Jadwal Pembayaran"
                    onclick="edit();" data-effect="effect-slide-in-bottom"> <i class="anticon anticon-edit"></i> &nbsp;
                    Edit Profil
                </button>
                <hr>
                <h5>Data Guru</h5>
                <table class="table">
                    <tr>
                        <td width="200">NIP</td>
                        <td>:</td>
                        <td><?= $dataGuru->nip ?></td>
                    </tr>
                    <tr>
                        <td width="200">NUPTK</td>
                        <td>:</td>
                        <td><?= $dataGuru->nuptk ?></td>
                    </tr>
                    <tr>
                        <td width="200">NPWP</td>
                        <td>:</td>
                        <td><?= $dataGuru->npwp ?></td>
                    </tr>
                    <tr>
                        <td>Nama Lengkap</td>
                        <td width="20">:</td>
                        <td><?= $dataGuru->nama_guru ?></td>
                    </tr>
                    <!-- <tr>
                        <td>Email</td>
                        <td>:</td>
                        <td><?= $dataGuru->email ?></td>
                    </tr> -->
                    <tr>
                        <td>Jenis Kelamin</td>
                        <td>:</td>
                        <td><?= $dataGuru->gender ?></td>
                    </tr>
                    <tr>
                        <td>Tempat Lahir</td>
                        <td>:</td>
                        <td><?= $dataGuru->tmpt_lhr ?></td>
                    </tr>
                    <tr>
                        <td>Tanggal Lahir</td>
                        <td>:</td>
                        <td><?= $dataGuru->tanggal_lahir ?></td>
                    </tr>
                    <tr>
                        <td>Agama</td>
                        <td>:</td>
                        <td><?= $dataGuru->agama ?></td>
                    </tr>
                    <tr>
                        <td>Status Keguruan</td>
                        <td>:</td>
                        <td><?= $dataGuru->sts_keguruan ?></td>
                    </tr>
                    <tr>
                        <td>Alamat</td>
                        <td>:</td>
                        <td><?= $dataGuru->alamat ?></td>
                    </tr>
                    <tr>
                        <td>Jabatan</td>
                        <td>:</td>
                        <td><?= $dataGuru->jabatan ?></td>
                    </tr>
                    <tr>
                        <td>Jabatan Terhitung Mulai Tanggal</td>
                        <td>:</td>
                        <td><?= $dataGuru->tmt_jabatan ?></td>
                    </tr>
                    <tr>
                        <td>Pangkat</td>
                        <td>:</td>
                        <td><?= $dataGuru->pangkat ?></td>
                    </tr>
                    <tr>
                        <td>Pangkat Terhitung Mulai Tanggal</td>
                        <td>:</td>
                        <td><?= $dataGuru->tmt_pangkat ?></td>
                    </tr>
                    <tr>
                        <td>No HP</td>
                        <td>:</td>
                        <td><?= $dataGuru->no_hp ?></td>
                    </tr>
                    <tr>
                        <td>Nama Perguruan Tinggi Terakhir</td>
                        <td>:</td>
                        <td><?= $dataGuru->nama_pt ?></td>
                    </tr>
                    <tr>
                        <td>Jurusan di Perguruan Tinggi</td>
                        <td>:</td>
                        <td><?= $dataGuru->jurusan_di_pt ?></td>
                    </tr>
                    <tr>
                        <td>Tamat di Perguruan Tinggi Tahun</td>
                        <td>:</td>
                        <td><?= $dataGuru->tamat_thn_di_pt ?></td>
                    </tr>
                    <tr>
                        <td>Mata Pelajaran</td>
                        <td>:</td>
                        <td><?= $dataMapel->mata_pelajaran ?></td>
                    </tr>
                    <tr>
                        <td>Tugas di Sekolah Terhitung Mulai Tanggal</td>
                        <td>:</td>
                        <td><?= $dataGuru->tmt_tugas_di_sklh ?></td>
                    </tr>
                    <tr>
                        <td>Masa Kerja Keseluruhan</td>
                        <td>:</td>
                        <td><?= $dataGuru->masa_kerja_keseluruhan ?></td>
                    </tr>
                    <tr>
                        <td>Catatan Mutasi Kepegawaian</td>
                        <td>:</td>
                        <td><?= $dataGuru->cttn_mutasi_kepeg ?></td>
                    </tr>
                    <tr>
                        <td>Tanggal Lulus Sertifikasi</td>
                        <td>:</td>
                        <td><?= $dataGuru->tgl_lulus_sertifikasi ?></td>
                    </tr>
                    <tr>
                        <td>Pensiun Terhitung Mulai Tanggal</td>
                        <td>:</td>
                        <td><?= $dataGuru->pensiun_tmt ?></td>
                    </tr>
                    <tr>
                        <td>Kenaikan Gaji Berkala</td>
                        <td>:</td>
                        <td><?= $dataGuru->kenaikan_gaji_berkala ?></td>
                    </tr>
                    <?php if(isset($dataWalikelas->kelas)): ?>
                    <tr>
                        <td>Wali Kelas</td>
                        <td>:</td>
                        <td><?= $dataWalikelas->kelas ?></td>
                    </tr>
                    <?php endif; ?>
                </table>
            </div>
        </div>
    </div>
</div>
<?= $this->element('Admin/modal'); ?>