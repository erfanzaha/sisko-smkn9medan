<form method="post" id="form-add-new-data">
    <div class="modal-body">
        <input type="hidden" id="id" name="id">
        <input type="hidden" id="id_siswa" name="id_siswa">
        <input type="hidden" id="id_kelas" name="id_kelas">
        <div class="form-group ">
            <label for="nilai_tugas">Nilai Tugas</label>
            <input type="number" min="0" class="form-control" id="nilai_tugas" name="nilai_tugas" required placeholder="Nilai Tugas">
        </div>
        <div class="form-group ">
            <label for="nilai_mid">Nilai MID</label>
            <input type="number" min="0" class="form-control" id="nilai_mid" name="nilai_mid" required placeholder="Nilai MID">
        </div>
        <div class="form-group ">
            <label for="nilai_uas">Nilai UAS</label>
            <input type="number" min="0" class="form-control" id="nilai_uas" name="nilai_uas" required placeholder="Nilai UAS">
        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-primary" id="btnSaves">Simpan</button>
    </div>
</form>