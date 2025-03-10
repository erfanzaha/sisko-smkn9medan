<form method="post" id="form-add-new-data">
    <div class="modal-body">
        <input type="hidden" id="id" name="id">
        <div class="form-group ">
            <label for="keterangan">Keterangan</label>
            <textarea name="keterangan" id='keterangan' class="form-control" required></textarea>
        </div>
        <div class="form-group ">
            <label for="tanggal_jatuh_tempo">Tanggal Jatuh Tempo</label>
            <input type="date" name="tanggal_jatuh_tempo" id="tanggal_jatuh_tempo" required class="form-control">
        </div>
        <div class="form-group ">
            <label for="jumlah_tagihan">Jumlah Tagihan</label>
            <input type="text" name="jumlah_tagihan" id="jumlah_tagihan" required class="form-control" onkeyup="rupiahCurrency();">
        </div>  
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-primary" id="btnSaves">Simpan</button>
    </div>
</form>