<div class="modal fade" id="modalNewData">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Tambah Guru dan Pegawai</h5>
                <button type="button" class="close" onclick="tutup();">
                    <i class="anticon anticon-close"></i>
                </button>
            </div>
            <?= $this->element('Admin/form'); ?>
        </div>
    </div>
</div>

<div class="modal fade" id="modalDetail">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Detail OrangTua</h5>
                <button type="button" class="close" onclick="tutup();">
                    <i class="anticon anticon-close"></i>
                </button>
            </div>
            <form method="post" id="form-detail-data">
    <div class="modal-body">
        <input type="hidden" id="id2" name="id">
        <input type="hidden" id="id_auth2" name="id_auth">
        <input type="hidden" id="id_siswa2" name="id_siswa">
        <div class="row">
            <div class="col-md-4">
                <h5>Data Ayah</h5>
                <hr>
                <div class="form-group ">
                    <label for="nama_ayah">Nama Ayah</label>
                    <input type="text" class="form-control" id="nama_ayah2" name="nama_ayah" readonly>
                </div>
                <div class="form-group ">
                    <label for="tmpt_lhr_ayah">Tempat Lahir Ayah</label>
                    <input type="text" class="form-control" id="tmpt_lhr_ayah2" name="tmpt_lhr_ayah" readonly>
                </div>
                <div class="form-group ">
                    <label for="tanggal_lahir_ayah">Tanggal Lahir Ayah</label>
                    <input type="date" class="form-control" id="tanggal_lahir_ayah2" name="tanggal_lahir_ayah" readonly>
                </div>
                <div class="form-group ">
                    <label for="agama_ayah">Agama Ayah</label>
                    <input type="text" class="form-control" id="agama_ayah2" name="agama_ayah" readonly>
                </div>
                <div class="form-group ">
                    <label for="pendidikan_ayah">Pendidikan Ayah</label>
                    <input type="text" class="form-control" id="pendidikan_ayah2" name="pendidikan_ayah" readonly>
                </div>
                <div class="form-group ">
                    <label for="pekerjaan_ayah">Pekerjaan Ayah</label>
                    <input type="text" class="form-control" id="pekerjaan_ayah2" name="pekerjaan_ayah" readonly>
                </div>
                <div class="form-group ">
                    <label for="penghasilan_ayah">Penghasilan Ayah</label>
                    <input type="text" class="form-control" id="penghasilan_ayah2" name="penghasilan_ayah" readonly>
                </div>
                <div class="form-group ">
                    <label for="no_hp_ayah">No Hp Ayah</label>
                    <input type="text" class="form-control" id="no_hp_ayah2" name="no_hp_ayah" readonly>
                </div>
                <div class="form-group ">
                    <label for="alamat_ayah">Alamat Ayah</label>
                    <input type="text" class="form-control" id="alamat_ayah2" name="alamat_ayah" readonly>
                </div>
                <div class="form-group ">
                    <label for="hidup_meninggal_ayah">Keberadaan Ayah</label>
                    <input type="text" class="form-control" id="hidup_meninggal_ayah2" name="hidup_meninggal_ayah" readonly>
                </div>
            </div>

            <div class="col-md-4">
                <h5>Data Ibu</h5>
                <hr>
                <div class="form-group ">
                    <label for="nama_ibu">Nama Ibu</label>
                    <input type="text" class="form-control" id="nama_ibu2" name="nama_ibu" readonly>
                </div>
                <div class="form-group ">
                    <label for="tmpt_lhr_ibu">Tempat Lahir Ibu</label>
                    <input type="text" class="form-control" id="tmpt_lhr_ibu2" name="tmpt_lhr_ibu" readonly>
                </div>
                <div class="form-group ">
                    <label for="tanggal_lahir_ibu">Tanggal Lahir Ibu</label>
                    <input type="date" class="form-control" id="tanggal_lahir_ibu2" name="tanggal_lahir_ibu" readonly>
                </div>
                <div class="form-group ">
                    <label for="agama_ibu">Agama Ibu</label>
                    <input type="text" name="agama_ibu" id="agama_ibu2" class="form-control" readonly>
                </div>
                <div class="form-group">
                    <label for="pendidikan_ibu">Pendidikan Ibu</label>
                    <input type="text" class="form-control" id="pendidikan_ibu2" name="pendidikan_ibu" readonly>
                </div>
                <div class="form-group">
                    <label for="pekerjaan_ibu">Pekerjaan Ibu</label>
                    <input type="text" class="form-control" id="pekerjaan_ibu2" name="pekerjaan_ibu" readonly>
                </div>
                <div class="form-group">
                    <label for="penghasilan_ibu">Penghasilan Ibu</label>
                    <input type="text" class="form-control" id="penghasilan_ibu2" name="penghasilan_ibu" readonly>
                </div>
                <div class="form-group ">
                    <label for="no_hp_ibu">No Hp Ibu</label>
                    <input type="text" class="form-control" id="no_hp_ibu2" name="no_hp_ibu" readonly>
                </div>
                <div class="form-group ">
                    <label for="alamat_ibu">Alamat Ibu</label>
                    <input type="text" class="form-control" id="alamat_ibu2" name="alamat_ibu" readonly>
                </div>
                <div class="form-group ">
                    <label for="hidup_meninggal_ibu">Keberadaan Ibu</label>
                    <input type="text" name="hidup_meninggal_ibu" id="hidup_meninggal_ibu2" class="form-control" readonly>
                </div>
            </div>
            <div class="col-md-4">
                <h5>Data Wali</h5>
                <hr>
                <div class="form-group ">
                    <label for="nama_wali">Nama Wali</label>
                    <input type="text" class="form-control" id="nama_wali2" name="nama_wali" readonly>
                </div>
                <div class="form-group ">
                    <label for="tmpt_lhr_wali">Tempat Lahir wali</label>
                    <input type="text" class="form-control" id="tmpt_lhr_wali2" name="tmpt_lhr_wali" readonly>
                </div>
                <div class="form-group ">
                    <label for="tanggal_lahir_wali">Tanggal Lahir wali</label>
                    <input type="date" class="form-control" id="tanggal_lahir_wali2" name="tanggal_lahir_wali" readonly>
                </div>
                <div class="form-group ">
                    <label for="agama_wali">Agama wali</label>
                    <input type="text" name="agama_wali" id="agama_wali2" class="form-control" readonly>
                </div>
                <div class="form-group">
                    <label for="pendidikan_wali">Pendidikan wali</label>
                    <input type="text" class="form-control" id="pendidikan_wali2" name="pendidikan_wali" readonly>
                </div>
                <div class="form-group">
                    <label for="pekerjaan_wali">Pekerjaan wali</label>
                    <input type="text" class="form-control" id="pekerjaan_wali2" name="pekerjaan_wali" readonly>
                </div>
                <div class="form-group">
                    <label for="penghasilan_wali">Penghasilan wali</label>
                    <input type="text" class="form-control" id="penghasilan_wali2" name="penghasilan_wali" readonly>
                </div>
                <div class="form-group ">
                    <label for="no_hp_wali">No Hp wali</label>
                    <input type="text" class="form-control" id="no_hp_wali2" name="no_hp_wali" readonly>
                </div>
                <div class="form-group ">
                    <label for="alamat_wali">Alamat wali</label>
                    <input type="text" class="form-control" id="alamat_wali2" name="alamat_wali" readonly>
                </div>
            </div>

        </div>
    </form>
        </div>
    </div>
</div>