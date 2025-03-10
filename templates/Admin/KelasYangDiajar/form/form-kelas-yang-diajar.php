<form method="post" id="form-add-new-data">
    <div class="modal-body">
        <input type="hidden" id="id" name="id">
        <div class="form-group ">
            <label for="id_guru">Guru</label>
            <select class="form-control" id="id_guru" name="id_guru" required></select>
        </div>
        <div class="form-group ">
            <label for="id_tahun_ajaran">Tahun Ajaran</label>
            <select class="form-control" id="id_tahun_ajaran" name="id_tahun_ajaran" required></select>
        </div>
        <div class="form-group ">
            <label for="id_kelas">Kelas</label>
            <select class="form-control" id="id_kelas" name="id_kelas" required></select>
        </div>  
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-primary" id="btnSaves">Simpan</button>
    </div>
</form>