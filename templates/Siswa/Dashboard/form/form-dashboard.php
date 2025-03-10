<form method="post" id="form-add-new-data">
    <div class="modal-body">
        <input type="hidden" id="id" name="id">
        <input type="hidden" id="id_auth" name="id_auth">
        <input type="hidden" id="id_siswa_kelas" name="id_siswa_kelas">

        <div class="row">
            <div class="col-md-6">
                <div class="form-group ">
                    <label for="nisn">NISN</label>
                    <input type="text" class="form-control" id="nisn" name="nisn" required placeholder="NISN" disabled>
                </div>
                <div class="form-group ">
                    <label for="nama_siswa">Nama Siswa</label>
                    <input type="text" class="form-control" id="nama_siswa" name="nama_siswa" required
                        placeholder="Nama Siswa">
                </div>
                <div class="form-group ">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required placeholder="Email">
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
            </div>
            <div class="col-md-6">
                <div class="form-group ">
                    <label for="tanggal_lahir">Tanggal Lahir</label>
                    <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" required>
                </div>
                <div class="form-group ">
                    <label for="agama">Agama</label>
                    <select name="agama" id="agama" class="form-control" required>
                        <option disabled selected>PIlih Salah Satu</option>
                        <option value="Islam">Islam</option>
                        <option value="Khatolik">Khatolik</option>
                        <option value="Protestan">Protestan</option>
                        <option value="Hindu">Hindu</option>
                        <option value="Buddha">Buddha</option>
                        <option value="Konghuchu">Konghuchu</option>
                    </select>
                </div>
                <div class="form-group ">
                    <label for="jumlah_saudara">Jumlah Saudara <small class="text-danger">isi ( 0 ) jika tidak
                            ada
                            jumlah saudara</small></label>
                    <input type="number" class="form-control" id="jumlah_saudara" name="jumlah_saudara" required
                        min="0">
                </div>
                <div class="form-group ">
                    <label for="no_hp">No HP</label>
                    <input type="text" class="form-control" id="no_hp" name="no_hp" required placeholder="No HP">
                </div>
                <div class="form-group ">
                    <label for="id_kelas">Kelas</label>
                    <select name="id_kelas" id="id_kelas" class="form-control" required disabled>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <label for="almaat">Alamat</label>
                <textarea class="form-control" required name="alamat" id="alamat"></textarea>
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