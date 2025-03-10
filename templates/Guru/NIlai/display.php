<div class="row">
    <div class="col-md-12 col-lg-12">
        <div class="card">
            <div class="card-body">

                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <?php foreach ($dataKelasYangDiajar as $key => $value) : ?>
                    <li class="nav-item" onclick="showKelas('<?= $value['id'] ?>','<?= $key ?>','<?= $value['id_tahun_ajaran'] ?>')">
                        <a class="nav-link <?php if($key == 0): echo "active"; endif; ?>"
                            id="<?= str_replace(' ','',$value['kelas']) ?>-tab" data-toggle="tab"
                            href="#<?= str_replace(' ','',$value['kelas'])  ?>" role="tab"
                            aria-controls="<?= str_replace(' ','',$value['kelas'])  ?>"
                            aria-selected="<?php if($key == 0): echo "true"; else: echo"false"; endif; ?>"><?= $value['kelas'] ?> (<?= $value['tahun_ajaran']?>)</a>
                    </li>
                    <?php endforeach; ?>
                </ul>
                <div class="tab-content m-t-15" id="myTabContent">
                    <?php foreach ($dataKelasYangDiajar as $key => $value) : ?>
                    <div class="tab-pane fade <?php if($key == 0): echo "show active"; endif; ?>"
                        id="<?= str_replace(' ','',$value['kelas'])  ?>" role="tabpanel"
                        aria-labelledby="<?= str_replace(' ','',$value['kelas'])  ?>-tab">
                        <table id="konten<?= $key ?>" class="table">
                            <thead>
                                <tr>
                                    <th>Nama Siswa</th>
                                    <th>Nilai Tugas</th>
                                    <th>NIlai MID</th>
                                    <th>NIlai UAS</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Nama Siswa</th>
                                    <th>Nilai Tugas</th>
                                    <th>Nilai MID</th>
                                    <th>Nilai UAS</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->element('Admin/modal'); ?>