<table id="konten" class="table" style="width:100%;">
    <thead>
        <tr>
            <th>Rank</th>
            <th>Nama Siswa</th>
            <th>Nilai Tugas</th>
            <th>NIlai MID</th>
            <th>NIlai UAS</th>
            <th>Total Nilai</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($view as $key => $value) { ?>
        <tr>
            <td><?= $key + 1 ?></td>
            <td><?= $value['nama_siswa'] ?></td>
            <td><?= $value['nilai_tugas'] ?></td>
            <td><?= $value['nilai_mid'] ?></td>
            <td><?= $value['nilai_uas'] ?></td>
            <td><?= $value['total_nilai'] ?></td>
        </tr>
        <?php } ?>
    </tbody>
    <tfoot>
        <tr>
            <th>Rank</th>
            <th>Nama Siswa</th>
            <th>Nilai Tugas</th>
            <th>Nilai MID</th>
            <th>Nilai UAS</th>
            <th>Total Nilai</th>
        </tr>
    </tfoot>
</table>