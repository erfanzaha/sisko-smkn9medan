<div class="modal fade" id="modalNewData">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Tambah Guru dan Pegawai</h5>
                <button type="button" class="close" onclick="tutup();">
                    <i class="anticon anticon-close"></i>
                </button>
            </div>
            <?= $this->element('Admin/form'); ?>
        </div>
    </div>
</div>

<div class="modal fade" id="modalDetail">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailModalCenterTitle">Detail Guru dan Pegawai</h5>
                <button type="button" class="close" onclick="tutup();">
                    <i class="anticon anticon-close"></i>
                </button>
            </div>
            <form method="post" id="form-detail-data">
    <div class="modal-body">
        <input type="hidden" id="id2" name="id">
        <input type="hidden" id="id_auth2" name="id_auth">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group ">
                    <label for="nip">NIP</label>
                    <input type="text" class="form-control" id="nip2" name="nip" readonly>
                </div>
                <div class="form-group ">
                    <label for="nuptk">NUPTK</label>
                    <input type="text" class="form-control" id="nuptk2" name="nuptk" readonly>
                </div>
                <div class="form-group ">
                    <label for="npwp">NPWP</label>
                    <input type="text" class="form-control" id="npwp2" name="npwp" readonly>
                </div>
                <div class="form-group ">
                    <label for="nama_guru">Nama Guru</label>
                    <input type="text" class="form-control" id="nama_guru2" name="nama_guru" readonly>
                </div>
                <div class="form-group ">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" id="username2" name="username" readonly>
                </div>
                <div class="form-group ">
                    <label for="gender">Gender</label>
                    <input type="text" name="gender" id="gender2" class="form-control" readonly>
                        <!-- <option disabled selected>PIlih Salah Satu</option>
                        <option value="laki - laki">Laki - laki</option>
                        <option value="perempuan">Perempuan</o-ption>
                    </select> -->
                </div>
                <div class="form-group ">
                    <label for="tmpt_lhr">Tempat Lahir</label>
                    <input type="text" class="form-control" id="tmpt_lhr2" name="tmpt_lhr" readonly>
                </div>
                <div class="form-group ">
                    <label for="tanggal_lahir">Tanggal Lahir</label>
                    <input type="date" class="form-control" id="tanggal_lahir2" name="tanggal_lahir" readonly>
                </div>
                <div class="form-group ">
                    <label for="agama">Agama</label>
                    <input type="text" name="agama" id="agama2" class="form-control" readonly>
                        <!-- <option disabled selected>Pilih Salah Satu</option>
                        <option value="Islam">Islam</option>
                        <option value="Khatolik">Khatolik</option>
                        <option value="Protestan">Protestan</option>
                        <option value="Hindu">Hindu</option>
                        <option value="Buddha">Buddha</option>
                        <option value="Konghuchu">Konghuchu</option>
                    </select> -->
                </div>
                <div class="form-group ">
                    <label for="no_hp">No HP</label>
                    <input type="text" class="form-control" id="no_hp2" name="no_hp" readonly>
                </div>
                <div class="form-group ">
                    <label for="sts_keguruan">Status Keguruan</label>
                    <input type="text" class="form-control" id="sts_keguruan2" name="sts_keguruan" readonly>
                </div>
                <div class="form-group ">
                    <label for="id_mapel">Mata Pelajaran</label>
                    <select name="id_mapel" id="id_mapel2" class="form-control" readonly disabled>
                    </select>
                </div>
                <div class="form-group ">
                    <label for="alamat">Alamat</label>
                    <input type="text" class="form-control" id="alamat2" name="alamat" readonly>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group ">
                    <label for="jabatan">Jabatan</label>
                    <input type="text" class="form-control" id="jabatan2" name="jabatan" readonly>
                </div>
                <div class="form-group ">
                    <label for="tmt_jabatan">Tanggal Mulai Jabatan</label>
                    <input type="text" class="form-control" id="tmt_jabatan2" name="tmt_jabatan" readonly>
                </div>
                <div class="form-group ">
                    <label for="pangkat">Pangkat</label>
                    <input type="text" class="form-control" id="pangkat2" name="pangkat" readonly>
                </div>
                <div class="form-group ">
                    <label for="tmt_pangkat">Pangkat Terhitung Mulai Tanggal</label>
                    <input type="text" class="form-control" id="tmt_pangkat2" name="tmt_pangkat" readonly>
                </div>
                <div class="form-group ">
                    <label for="nama_pt">Nama Instansi Pendidikan Terakhir</label>
                    <input type="text" class="form-control" id="nama_pt2" name="nama_pt" readonly>
                </div>
                <div class="form-group ">
                    <label for="jurusan_di_pt">Jurusan Pendidikan Terakhir</label>
                    <input type="text" class="form-control" id="jurusan_di_pt2" name="jurusan_di_pt" readonly>
                </div>
                <div class="form-group ">
                    <label for="tamat_thn_di_pt">Tahun Tamat Pendidikan Terakhir</label>
                    <input type="text" class="form-control" id="tamat_thn_di_pt2" name="tamat_thn_di_pt" readonly>
                </div>
                <div class="form-group ">
                    <label for="tmt_tugas_di_sklh">Tanggal Mulai Tugas di Sekolah</label>
                    <input type="text" class="form-control" id="tmt_tugas_di_sklh2" name="tmt_tugas_di_sklh" readonly>
                </div>
                <div class="form-group ">
                    <label for="masa_kerja_keseluruhan">Masa Kerja Keseluruhan</label>
                    <input type="text" class="form-control" id="masa_kerja_keseluruhan2" name="masa_kerja_keseluruhan" readonly>
                </div>
                <div class="form-group ">
                    <label for="cttn_mutasi_kepeg">Catatan Mutasi Kepegawaian</label>
                    <input type="text" class="form-control" id="cttn_mutasi_kepeg2" name="cttn_mutasi_kepeg" readonly>
                </div>
                <div class="form-group ">
                    <label for="tgl_lulus_sertifikasi">Tanggal Lulus Sertifikasi</label>
                    <input type="text" class="form-control" id="tgl_lulus_sertifikasi2" name="tgl_lulus_sertifikasi" readonly>
                </div>
                <div class="form-group ">
                    <label for="pensiun_tmt">Pensiun Terhitung Mulai Tanggal</label>
                    <input type="text" class="form-control" id="pensiun_tmt2" name="pensiun_tmt" readonly>
                </div>
                <div class="form-group ">
                    <label for="kenaikan_gaji_berkala">Kenaikan Gaji Berkala</label>
                    <input type="text" class="form-control" id="kenaikan_gaji_berkala2" name="kenaikan_gaji_berkala" readonly>
                </div>
            </div>
        </div>
    </div>
</form>
        </div>
    </div>
</div>