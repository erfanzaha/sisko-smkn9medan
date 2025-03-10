<form method="post" id="form-add-new-data">
    <div class="modal-body">
        <input type="hidden" id="id" name="id">
        <input type="hidden" id="id_auth" name="id_auth">
        <input type="hidden" id="id_siswa" name="id_siswa">
        <div class="row">
            <div class="col-md-4">
                <h5>Data Ayah</h5>
                <hr>
                <div class="form-group ">
                    <label for="nama_ayah">Nama Ayah</label>
                    <input type="text" class="form-control" id="nama_ayah" name="nama_ayah" required placeholder="Nama Ayah">
                </div>
                <div class="form-group ">
                    <label for="tmpt_lhr_ayah">Tempat Lahir Ayah</label>
                    <input type="text" class="form-control" id="tmpt_lhr_ayah" name="tmpt_lhr_ayah" required placeholder="Tempat Lahir Ayah">
                </div>
                <div class="form-group ">
                    <label for="tanggal_lahir_ayah">Tanggal Lahir Ayah</label>
                    <input type="date" class="form-control" id="tanggal_lahir_ayah" name="tanggal_lahir_ayah" required>
                </div>
                <div class="form-group ">
                    <label for="agama_ayah">Agama Ayah</label>
                    <select name="agama_ayah" id="agama_ayah" class="form-control" required>
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
                    <label for="pendidikan_ayah">Pendidikan Ayah</label>
                    <input type="text" class="form-control" id="pendidikan_ayah" name="pendidikan_ayah" placeholder="Pendidikan Terakhir Ayah" required>
                </div>
                <div class="form-group ">
                    <label for="pekerjaan_ayah">Pekerjaan Ayah</label>
                    <input type="text" class="form-control" id="pekerjaan_ayah" name="pekerjaan_ayah" required placeholder="Pekerjaan Ayah">
                </div>
                <div class="form-group ">
                    <label for="penghasilan_ayah">Penghasilan Ayah</label>
                    <input type="text" class="form-control" id="penghasilan_ayah" name="penghasilan_ayah" required placeholder="Penghasilan Ayah">
                </div>
                <div class="form-group ">
                    <label for="no_hp_ayah">No Hp Ayah</label>
                    <input type="text" class="form-control" id="no_hp_ayah" name="no_hp_ayah" required placeholder="No. HP Ayah">
                </div>
                <div class="form-group ">
                    <label for="alamat_ayah">Alamat Ayah</label>
                    <input type="text" class="form-control" id="alamat_ayah" name="alamat_ayah" required placeholder="Alamat Ayah">
                </div>
                <div class="form-group ">
                    <label for="hidup_meninggal_ayah">Keberadaan Ayah</label>
                    <select name="hidup_meninggal_ayah" id="hidup_meninggal_ayah" class="form-control" required>
                        <option disabled selected>Pilih Salah Satu</option>
                        <option value="masih hidup">Masih Hidup</option>
                        <option value="sudah meninggal">Sudah Meninggal</option>
                    </select>
                </div>
            </div>

            <div class="col-md-4">
                <h5>Data Ibu</h5>
                <hr>
                <div class="form-group ">
                    <label for="nama_ibu">Nama Ibu</label>
                    <input type="text" class="form-control" id="nama_ibu" name="nama_ibu" required placeholder="Nama ibu">
                </div>
                <div class="form-group ">
                    <label for="tmpt_lhr_ibu">Tempat Lahir Ibu</label>
                    <input type="text" class="form-control" id="tmpt_lhr_ibu" name="tmpt_lhr_ibu" required placeholder="Tempat Lahir Ibu">
                </div>
                <div class="form-group ">
                    <label for="tanggal_lahir_ibu">Tanggal Lahir Ibu</label>
                    <input type="date" class="form-control" id="tanggal_lahir_ibu" name="tanggal_lahir_ibu" required>
                </div>
                <div class="form-group ">
                    <label for="agama_ibu">Agama Ibu</label>
                    <select name="agama_ibu" id="agama_ibu" class="form-control" required>
                        <option disabled selected>Pilih Salah Satu</option>
                        <option value="Islam">Islam</option>
                        <option value="Khatolik">Khatolik</option>
                        <option value="Protestan">Protestan</option>
                        <option value="Hindu">Hindu</option>
                        <option value="Buddha">Buddha</option>
                        <option value="Konghuchu">Konghuchu</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="pendidikan_ibu">Pendidikan Ibu</label>
                    <input type="text" class="form-control" id="pendidikan_ibu" name="pendidikan_ibu" required placeholder="Pendidikan Terakhir Ibu">
                </div>
                <div class="form-group">
                    <label for="pekerjaan_ibu">Pekerjaan Ibu</label>
                    <input type="text" class="form-control" id="pekerjaan_ibu" name="pekerjaan_ibu" required placeholder="Pekerjaan Ibu">
                </div>
                <div class="form-group">
                    <label for="penghasilan_ibu">Penghasilan Ibu</label>
                    <input type="text" class="form-control" id="penghasilan_ibu" name="penghasilan_ibu" required placeholder="Penghasilan Ibu">
                </div>
                <div class="form-group ">
                    <label for="no_hp_ibu">No Hp Ibu</label>
                    <input type="text" class="form-control" id="no_hp_ibu" name="no_hp_ibu" required placeholder="No. HP Ibu">
                </div>
                <div class="form-group ">
                    <label for="alamat_ibu">Alamat Ibu</label>
                    <input type="text" class="form-control" id="alamat_ibu" name="alamat_ibu" required placeholder="Alamat Ibu">
                </div>
                <div class="form-group ">
                    <label for="hidup_meninggal_ibu">Keberadaan Ibu</label>
                    <select name="hidup_meninggal_ibu" id="hidup_meninggal_ibu" class="form-control" required>
                        <option disabled selected>Pilih Salah Satu</option>
                        <option value="masih_hidup">Masih Hidup</option>
                        <option value="sudah_meninggal">Sudah Meninggal</option>
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <h5>Data Wali</h5>
                <hr>
                <div class="form-group ">
                    <label for="nama_wali">Nama Wali</label>
                    <input type="text" class="form-control" id="nama_wali" name="nama_wali" placeholder="Nama Wali">
                </div>
                <div class="form-group ">
                    <label for="tmpt_lhr_wali">Tempat Lahir wali</label>
                    <input type="text" class="form-control" id="tmpt_lhr_wali" name="tmpt_lhr_wali" placeholder="Tempat Lahir wali">
                </div>
                <div class="form-group ">
                    <label for="tanggal_lahir_wali">Tanggal Lahir wali</label>
                    <input type="date" class="form-control" id="tanggal_lahir_wali" name="tanggal_lahir_wali">
                </div>
                <div class="form-group ">
                    <label for="agama_wali">Agama wali</label>
                    <select name="agama_wali" id="agama_wali" class="form-control">
                        <option disabled selected>Pilih Salah Satu</option>
                        <option value="Islam">Islam</option>
                        <option value="Khatolik">Khatolik</option>
                        <option value="Protestan">Protestan</option>
                        <option value="Hindu">Hindu</option>
                        <option value="Buddha">Buddha</option>
                        <option value="Konghuchu">Konghuchu</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="pendidikan_wali">Pendidikan wali</label>
                    <input type="text" class="form-control" id="pendidikan_wali" name="pendidikan_wali" placeholder="Pendidikan Terakhir wali">
                </div>
                <div class="form-group">
                    <label for="pekerjaan_wali">Pekerjaan wali</label>
                    <input type="text" class="form-control" id="pekerjaan_wali" name="pekerjaan_wali" placeholder="Pekerjaan wali">
                </div>
                <div class="form-group">
                    <label for="penghasilan_wali">Penghasilan wali</label>
                    <input type="text" class="form-control" id="penghasilan_wali" name="penghasilan_wali" placeholder="Penghasilan wali">
                </div>
                <div class="form-group ">
                    <label for="no_hp_wali">No Hp wali</label>
                    <input type="text" class="form-control" id="no_hp_wali" name="no_hp_wali" placeholder="No. HP wali">
                </div>
                <div class="form-group ">
                    <label for="alamat_wali">Alamat wali</label>
                    <input type="text" class="form-control" id="alamat_wali" name="alamat_wali" placeholder="Alamat wali">
                </div>
            </div>

        </div>
        <!-- <div class="row">
            <div class="col-md-12">
                <label for="alamat">Alamat</label>
                <textarea class="form-control" required name="alamat" id="alamat"></textarea>
            </div>
        </div> -->
        <hr>
        <div class="form-group ">
            <label for="username">Username</label>
            <input type="text" class="form-control" id="username" name="username" required placeholder="Username">
        </div>
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