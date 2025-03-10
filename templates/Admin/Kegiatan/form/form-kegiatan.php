<form method="post" id="form-add-new-data" enctype="multipart/form-data">
    <div class="modal-body">
        <input type="hidden" id="id" name="id">
        <div class="form-group ">
            <label for="keterangan">Keterangan</label>
            <textarea class="form-control" id="keterangan" name="keterangan" required placeholder="Keterangan"></textarea>
        </div>
        <div class="form-group ">
            <label for="tanggal">Tanggal</label>
            <input type="date" class="form-control" id="tanggal" name="tanggal" required>
        </div>
        <div class="form-group ">
            <label for="gambar">Gambar</label>
            <input type="file" class="form-control" id="gambar" name="gambar" required>
        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-primary" id="btnSaves">Simpan</button>
    </div>
</form>