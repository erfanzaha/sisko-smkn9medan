<div class="row">
    <div class="col-md-12 col-lg-12">
        <div class="card">
            <div class="card-body">
                <form method="post" id="form-filter">
                    <div class="row">
                        <div class="col-md-12">
                        </div>
                        <div class="col-md-4">
                            <div class="form-group ">
                                <select class="form-control" id="id_tahun_ajaran" name="id_tahun_ajaran" required></select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group ">
                                <select class="form-control" id="id_kelas" name="id_kelas" required></select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group ">
                                <select class="form-control" id="id_guru" name="id_guru" required></select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group ">
                                <button type="button" onclick="showKelas()" class="btn btn-primary btn-block">Tampilkan</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="row" id="div-table" style="display:none;">
    <div class="col-md-12 col-lg-12">
        <div class="card">
            <div class="card-body">
                <?= $this->element('Admin/table'); ?>
            </div>
        </div>
    </div>
</div>
<?= $this->element('Admin/modal'); ?>