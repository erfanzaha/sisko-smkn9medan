<form method="post" id="form-add-new-data">
    <div class="modal-body">
        <?php foreach ($data as $key => $value): ?>
        <div class="form-group">
            <input type="text" class="form-control" id="<?= $value->tipe ?>" name="<?= $value->tipe ?>" required
                placeholder="<?= $value->title ?>" value="<?= $value->deskripsi ?>">
        </div>
        <?php endforeach; ?>
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-primary" id="btnSaves">Simpan Perubahan</button>
    </div>
</form>