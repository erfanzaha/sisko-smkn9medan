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