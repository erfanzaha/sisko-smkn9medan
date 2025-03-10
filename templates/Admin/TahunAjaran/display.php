<div class="card">
    <div class="card-body">
        <div class="m-t-25">
            <button style="margin: 10px 0" class='btn btn-primary' title="Tambah Tahun Ajaran" onclick="show();"
                data-effect="effect-slide-in-bottom"> <i class="anticon anticon-plus"></i> &nbsp; Tahun Ajaran
            </button>
            <hr>    
            <?= $this->element('Admin/table'); ?>
        </div>
    </div>
</div>
<?= $this->element('Admin/modal'); ?>