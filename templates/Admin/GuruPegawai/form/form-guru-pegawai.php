<form method="post" id="form-add-new-data">
    <div class="modal-body">
        <input type="hidden" id="id" name="id">
        <input type="hidden" id="id_auth" name="id_auth">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group ">
                    <label for="nip">NIP</label>
                    <input type="text" class="form-control" id="nip" name="nip" required placeholder="NIP">
                </div>
                <div class="form-group ">
                    <label for="nuptk">NUPTK</label>
                    <input type="text" class="form-control" id="nuptk" name="nuptk" required placeholder="NUPTK">
                </div>
                <div class="form-group ">
                    <label for="npwp">NPWP</label>
                    <input type="text" class="form-control" id="npwp" name="npwp" required placeholder="NPWP">
                </div>
                <div class="form-group ">
                    <label for="nama_guru">Nama Guru</label>
                    <input type="text" class="form-control" id="nama_guru" name="nama_guru" required
                        placeholder="Nama Guru">
                </div>
                <div class="form-group ">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" id="username" name="username" required
                    placeholder="Username">
                </div>
                <div class="form-group ">
                    <label for="gender">Gender</label>
                    <select name="gender" id="gender" class="form-control" required>
                        <option disabled selected>PIlih Salah Satu</option>
                        <option value="laki - laki">Laki - laki</option>
                        <option value="perempuan">Perempuan</o-ption>
                    </select>
                </div>
                <div class="form-group ">
                    <label for="tmpt_lhr">Tempat Lahir</label>
                    <input type="tmpt_lhr" class="form-control" id="tmpt_lhr" name="tmpt_lhr" required placeholder="Lahir di Kota">
                </div>
                <div class="form-group ">
                    <label for="tanggal_lahir">Tanggal Lahir</label>
                    <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" required>
                </div>
                <div class="form-group ">
                    <label for="agama">Agama</label>
                    <select name="agama" id="agama" class="form-control" required>
                        <option disabled selected>Pilih Salah Satu</option>
                        <option value="Islam">Islam</option>
                        <option value="Khatolik">Khatolik</option>
                        <option value="Protestan">Protestan</option>
                        <option value="Hindu">Hindu</option>
                        <option value="Buddha">Buddha</option>
                        <option value="Konghuchu">Konghuchu</option>
                    </select>
                </div>
                <div class="form-group ">
                    <label for="no_hp">No HP</label>
                    <input type="text" class="form-control" id="no_hp" name="no_hp" required placeholder="No HP">
                </div>
                <div class="form-group ">
                    <label for="sts_keguruan">Status Keguruan</label>
                    <input type="text" class="form-control" id="sts_keguruan" name="sts_keguruan" required placeholder="Status Keguruan">
                </div>
                <div class="form-group ">
                    <label for="id_mapel">Mata Pelajaran</label>
                    <select name="id_mapel" id="id_mapel" class="form-control" required>
                    </select>
                </div>
                <div class="form-group ">
                    <label for="alamat">Alamat</label>
                    <input type="text" class="form-control" id="alamat" name="alamat" required placeholder="Alamat">
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group ">
                    <label for="jabatan">Jabatan <small class="text-danger">isi ( - ) jika tidak ada
                            jabatan</small></label>
                    <input type="text" class="form-control" id="jabatan" name="jabatan" required placeholder="jabatan">
                </div>
                <div class="form-group ">
                    <label for="tmt_jabatan">Tanggal Mulai Jabatan <small class="text-danger">isi ( - ) jika tidak ada
                            jabatan</small></label>
                    <input type="text" class="form-control" id="tmt_jabatan" name="tmt_jabatan" required placeholder="Jabatan Terhitung Mulai Tanggal">
                </div>
                <div class="form-group ">
                    <label for="pangkat">Pangkat</label>
                    <input type="text" class="form-control" id="pangkat" name="pangkat" required placeholder="Pangkat">
                </div>
                <div class="form-group ">
                    <label for="tmt_pangkat">Pangkat Terhitung Mulai Tanggal</label>
                    <input type="text" class="form-control" id="tmt_pangkat" name="tmt_pangkat" required placeholder="Pangkat Terhitung Mulai Tanggal">
                </div>
                <div class="form-group ">
                    <label for="nama_pt">Nama Instansi Pendidikan Terakhir</label>
                    <input type="text" class="form-control" id="nama_pt" name="nama_pt" required placeholder="Nama Instansi Pendidikan Terakhir">
                </div>
                <div class="form-group ">
                    <label for="jurusan_di_pt">Jurusan Pendidikan Terakhir</label>
                    <input type="text" class="form-control" id="jurusan_di_pt" name="jurusan_di_pt" required placeholder="Jurusan Pendidikan Terakhir">
                </div>
                <div class="form-group ">
                    <label for="tamat_thn_di_pt">Tahun Tamat Pendidikan Terakhir</label>
                    <input type="text" class="form-control" id="tamat_thn_di_pt" name="tamat_thn_di_pt" required placeholder="Tahun Tamat Pendidikan Terakhir">
                </div>
                <div class="form-group ">
                    <label for="tmt_tugas_di_sklh">Tanggal Mulai Tugas di Sekolah</label>
                    <input type="text" class="form-control" id="tmt_tugas_di_sklh" name="tmt_tugas_di_sklh" required placeholder="Tanggal Mulai Tugas di Sekolah">
                </div>
                <div class="form-group ">
                    <label for="masa_kerja_keseluruhan">Masa Kerja Keseluruhan</label>
                    <input type="text" class="form-control" id="masa_kerja_keseluruhan" name="masa_kerja_keseluruhan" required placeholder="Masa Kerja Keseluruhan">
                </div>
                <div class="form-group ">
                    <label for="cttn_mutasi_kepeg">Catatan Mutasi Kepegawaian</label>
                    <input type="text" class="form-control" id="cttn_mutasi_kepeg" name="cttn_mutasi_kepeg" required placeholder="Catatan Mutasi Kepegawaian">
                </div>
                <div class="form-group ">
                    <label for="tgl_lulus_sertifikasi">Tanggal Lulus Sertifikasi</label>
                    <input type="text" class="form-control" id="tgl_lulus_sertifikasi" name="tgl_lulus_sertifikasi" required placeholder="Tanggal Lulus Sertifikasi">
                </div>
                <div class="form-group ">
                    <label for="pensiun_tmt">Pensiun Terhitung Mulai Tanggal</label>
                    <input type="text" class="form-control" id="pensiun_tmt" name="pensiun_tmt" required placeholder="Pensiun Terhitung Mulai Tanggal">
                </div>
                <div class="form-group ">
                    <label for="kenaikan_gaji_berkala">Kenaikan Gaji Berkala</label>
                    <input type="text" class="form-control" id="kenaikan_gaji_berkala" name="kenaikan_gaji_berkala" required placeholder="Kenaikan Gaji Berkala">
                </div>
            </div>
        </div>
        <hr>
        <div id="">
            <div class="alert alert-danger bg-danger" style='display:none;' id="msg-pass">
                <span></span>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input required class="form-control" name="password" type="password" id="password"
                    placeholder="Password" onkeyup="checkPass();">
            </div>

            <div class="form-group">
                <label for="confirm">Confirm Password</label>
                <input required class="form-control" name="confirm" type="password" id="confirm"
                    placeholder="Confirm Password" onkeyup="checkPass();">
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-primary" id="btnSaves">Simpan</button>
    </div>
</form>

<form method="post" id="form-add-new-data-wali-kelas">
    <div class="modal-body">

    </div>
    <div class="modal-footer">
        <button type="button" class="btn disabled" id="btnSaves">Simpan</button>
    </div>
</form>