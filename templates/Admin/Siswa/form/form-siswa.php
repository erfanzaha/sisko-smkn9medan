<form method="post" id="form-add-new-data">
    <div class="modal-body">
        <input type="hidden" id="id" name="id">
        <input type="hidden" id="id_auth" name="id_auth">
        <input type="hidden" id="id_siswa_kelas" name="id_siswa_kelas">

        <div class="row">
            <div class="col-md-6">
                <div class="form-group ">
                    <label for="nisn">NISN</label>
                    <input type="text" class="form-control" id="nisn" name="nisn" required placeholder="NISN">
                </div>
                <div class="form-group ">
                    <label for="nipd">NIPD</label>
                    <input type="text" class="form-control" id="nipd" name="nipd" required placeholder="NISPD">
                </div>
                <div class="form-group ">
                    <label for="nama_siswa">Nama Siswa</label>
                    <input type="text" class="form-control" id="nama_siswa" name="nama_siswa" required placeholder="Nama Siswa">
                </div>
                <div class="form-group ">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required placeholder="Email">
                </div>
                <div class="form-group ">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" id="username" name="username" required placeholder="Username">
                </div>
                <div class="form-group ">
                    <label for="gender">Gender</label>
                    <select name="gender" id="gender" class="form-control" required>
                        <option disabled selected>Pilih Salah Satu</option>
                        <option value="laki - laki">Laki - laki</option>
                        <option value="perempuan">Perempuan</o-ption>
                    </select>
                </div>
                <div class="form-group ">
                    <label for="kewarganegaraan">Kewarganegaraan</label>
                    <input type="text" class="form-control" id="kewarganegaraan" name="kewarganegaraan" required placeholder="Kewarganegaraan">
                </div>
                <div class="form-group ">
                    <label for="anak_ke">Anak Ke</label>
                    <input type="text" class="form-control" id="anak_ke" name="anak_ke" required placeholder="Anak Ke">
                </div>
                <div class="form-group ">
                    <label for="anak_yatim_piatu">Anak Yatim/Piatu<small class="text-danger">isi - jika tidak</small></label>
                    <input type="text" class="form-control" id="anak_yatim_piatu" name="anak_yatim_piatu" required placeholder="Anak Yatim/Piatu">
                </div>
                <div class="form-group ">
                    <label for="bahasa_dirumah">Bahasa Dirumah</label>
                    <input type="text" class="form-control" id="bahasa_dirumah" name="bahasa_dirumah" required placeholder="Bahasa Dirumah">
                </div>
                <div class="form-group">
                    <label for="tinggal_dengan">Tinggal Dengan</label>
                    <input type="text" class="form-control" id="tinggal_dengan" name="tinggal_dengan" required placeholder="Tinggal Dengan">
                </div>
                <div class="form-group">
                    <label for="jrk_tgl_ke_sklh">Jarak tempat tinggal ke sekolah</label>
                    <input type="text" class="form-control" id="jrk_tgl_ke_sklh" name="jrk_tgl_ke_sklh" required placeholder="Jarak tempat tinggal ke sekolah">
                </div>
                <div class="form-group">
                    <label for="gol_darah">Golongan Darah</label>
                    <input type="text" class="form-control" id="gol_darah" name="gol_darah" required placeholder="Golongan Darah">
                </div>
                <div class="form-group">
                    <label for="penyakit">Penyakit yang pernah diderita</label>
                    <input type="text" class="form-control" id="penyakit" name="penyakit" required placeholder="Penyakit">
                </div>
                <div class="form-group">
                    <label for="kelainan_jasmani">Kelainan Jasmani</label>
                    <input type="text" class="form-control" id="kelainan_jasmani" name="kelainan_jasmani" required placeholder="Kelainan Jasmani">
                </div>
                <div class="form-group">
                    <label for="tinggi_badan">Tinggi Badan</label>
                    <input type="text" class="form-control" id="tinggi_badan" name="tinggi_badan" required placeholder="Tinggi Badan">
                </div>
                <div class="form-group">
                    <label for="berat_badan">Berat Badan</label>
                    <input type="text" class="form-control" id="berat_badan" name="berat_badan" required placeholder="Berat Badan">
                </div>
                <div class="form-group">
                    <label for="jurusan">Jurusan</label>
                    <input type="text" class="form-control" id="jurusan" name="jurusan" required placeholder="Jurusan">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group ">
                    <label for="alamat">Alamat</label>
                    <input type="text" class="form-control" id="alamat" name="alamat" required placeholder="Alamat">
                </div>
                <div class="form-group ">
                    <label for="tempat_lahir">Tempat Lahir</label>
                    <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" required placeholder="Tempat Lahir">
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
                    <label for="jlh_saudara_kandung">Jumlah Saudara Kandung<small class="text-danger">isi ( 0 ) jika tidak ada</small></label>
                    <input type="number" class="form-control" id="jlh_saudara_kandung" name="jlh_saudara_kandung" required min="0">
                </div>
                <div class="form-group ">
                    <label for="jlh_saudara_tiri">Jumlah Saudara Tiri<small class="text-danger">isi ( 0 ) jika tidak ada</small></label>
                    <input type="number" class="form-control" id="jlh_saudara_tiri" name="jlh_saudara_tiri" required min="0">
                </div>
                <div class="form-group ">
                    <label for="jlh_saudara_angkat">Jumlah Saudara Angkat<small class="text-danger">isi ( 0 ) jika tidak ada</small></label>
                    <input type="number" class="form-control" id="jlh_saudara_angkat" name="jlh_saudara_angkat" required min="0">
                </div>
                <div class="form-group ">
                    <label for="no_hp">No HP</label>
                    <input type="text" class="form-control" id="no_hp" name="no_hp" required placeholder="No HP">
                </div>
                <div class="form-group ">
                    <label for="asal_sekolah">Asal Sekolah</label>
                    <input type="text" class="form-control" id="asal_sekolah" name="asal_sekolah" required placeholder="Asal Sekolah">
                </div>
                <div class="form-group ">
                    <label for="tgl_no_sttb">Tanggal, No. STTB</label>
                    <input type="text" class="form-control" id="tgl_no_sttb" name="tgl_no_sttb" required placeholder="Tanggal, No. STTB">
                </div>
                <div class="form-group ">
                    <label for="lama_bljr">Lama Belajar</label>
                    <input type="text" class="form-control" id="lama_bljr" name="lama_bljr" required placeholder="Lama Belajar">
                </div>
                <div class="form-group ">
                    <label for="diterima_dikelas">Diterima Dikelas</label>
                    <input type="text" class="form-control" id="diterima_dikelas" name="diterima_dikelas" required placeholder="Diterima Dikelas">
                </div>
                <div class="form-group ">
                    <label for="diterima_tgl">Diterima Tanggal</label>
                    <input type="date" class="form-control" id="diterima_tgl" name="diterima_tgl" required placeholder="diterima_tgl">
                </div>
                <div class="form-group ">
                    <label for="kesenian">Kesenian</label>
                    <input type="text" class="form-control" id="kesenian" name="kesenian" required placeholder="Kesenian">
                </div>
                <div class="form-group ">
                    <label for="olahraga">Olahraga</label>
                    <input type="text" class="form-control" id="olahraga" name="olahraga" required placeholder="Olahraga">
                </div>
                <div class="form-group ">
                    <label for="organisasi">Organisasi</label>
                    <input type="text" class="form-control" id="organisasi" name="organisasi" required placeholder="Organisasi">
                </div>
                <div class="form-group ">
                    <label for="lain_lain">Lain-lain</label>
                    <input type="text" class="form-control" id="lain_lain" name="lain_lain" required placeholder="Lain-lain">
                </div>
                <div class="form-group ">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="id_tahun_ajaran">Tahun Ajaran</label>
                            <select name="id_tahun_ajaran" id="id_tahun_ajaran" class="form-control" required>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="id_kelas">Kelas</label>
                            <select name="id_kelas" id="id_kelas" class="form-control" required>
                            </select>
                        </div>
                    </div>

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
        <button type="button" class="btn disabled" id="btnSimpan">Simpan</button>
    </div>
</form>

<form method="post" id="form-konfirmasi-kenaikan-kelas">
    <div class="modal-body">
        <input type="hidden" id="id_siswa" name="id_siswa">
        <input type="hidden" id="status_konfirmasi" name="status_konfirmasi">
        <div class="form-group ">
            <div class="row">
                <div class="col-md-6">
                    <label for="id_tahun_ajaran_konfirmasi_kelas">Tahun Ajaran</label>
                    <select name="id_tahun_ajaran_konfirmasi_kelas" id="id_tahun_ajaran_konfirmasi_kelas" class="form-control" required>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="id_kelas_konfirmasi_kelas">Kelas</label>
                    <select name="id_kelas_konfirmasi_kelas" id="id_kelas_konfirmasi_kelas" class="form-control" required>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Simpan</button>
    </div>
</form>