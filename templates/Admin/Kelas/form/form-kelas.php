<form method="post" id="form-add-new-data">
    <div class="modal-body">
        <input type="hidden" id="id" name="id">
        <div class="form-group ">
            <label for="jurusan">Jurusan</label>
            <select class="form-control" id="jurusan" name="jurusan" required>
                <option disabled selected>Pilih Jurusan</option>
                <option value="RPL">RPL</option>
                <option value="TKJ">TKJ</option>
                <option value="PS">PS</option>
                <option value="DKV">DKV</option>
                <option value="AN">AN</option>
                <option value="MM">MM</option>
            </select>
        </div>
        <div class="form-group ">
            <label for="kelas">Kelas</label>
            <input type="text" class="form-control" id="kelas" name="kelas" required placeholder="Kelas">
        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-primary" id="btnSaves">Simpan</button>
    </div>
</form>

<form method="post" id="form-wali-kelas">
    <div class="modal-body">
        <input type="hidden" id="id_wali_kelas" name="id_wali_kelas">
        <div class="form-group ">
            <label for="id_tahun_ajaran_wali_kelas">Tahun Ajaran</label>
            <select class="form-control" id="id_tahun_ajaran_wali_kelas" name="id_tahun_ajaran_wali_kelas" required></select>
        </div>
        <div class="form-group ">
            <label for="id_kelas">Kelas</label>
            <select class="form-control" id="id_kelas" name="id_kelas" required></select>
        </div>
        <div class="form-group ">
            <label for="id_guru">Guru</label>
            <select class="form-control" id="id_guru" name="id_guru" required></select>
        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-primary" id="btnSaves">Simpan Wali Kelas</button>
    </div>
</form>