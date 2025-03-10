<form method="post" id="form-add-new-data">
    <div class="modal-body">
        <input type="hidden" id="id" name="id">        
        <div class="form-group ">
            <label for="tanggal_pembayaran">Tanggal Pembayaran</label>
            <input type="date" name="tanggal_pembayaran" id="tanggal_pembayaran" required class="form-control">
        </div>
        <div class="form-group ">
            <label for="jumlah_pembayaran">Jumlah Pembayaran</label>
            <input type="text" name="jumlah_pembayaran" id="jumlah_pembayaran" required class="form-control" onkeyup="rupiahCurrency();">
        </div>  
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-primary" id="btnSaves">Simpan</button>
    </div>
</form>