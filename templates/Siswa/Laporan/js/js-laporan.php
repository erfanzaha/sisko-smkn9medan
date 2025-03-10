<script type="text/javascript">
$(document).ready(function() {
    $.get("/admin/view-tahun-ajaran", function(data) {
        $('#id_tahun_ajaran').empty();
        $('#id_tahun_ajaran').append('<option value="">Pilih Tahun Ajaran</option>');
        const json = data;
        const arr = JSON.parse(json);
        $.each(arr, function() {
            $.each(this, function(index, obj) {
                $('#id_tahun_ajaran').append('<option value="' + obj.id +
                    '" data-id="' + obj
                    .id +
                    '">' +
                    obj.tahun_ajaran.toUpperCase() + '</option>');
            });
        });
    });

    $('#konten').DataTable({
        "bDestroy": true,
        "scrollX": true,
        // "ajax": {
        //     "url": "/siswa/view-laporan",
        //     "type": "POST",
        //     "data": {
        //         "id_kelas": id_kelas,
        //     },
        // },
        // "responsive": true,
        // "language": {
        //     "searchPlaceholder": 'Pencarian',
        //     "sSearch": '',
        //     "lengthMenu": '_MENU_ items/page',
        // },
        dom: 'Bfrtip',
        buttons: [
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5'
        ],
        // "columns": [{
        //         "data": "nama_siswa"
        //     },
        //     {
        //         "data": "nilai_tugas"
        //     },
        //     {
        //         "data": "nilai_mid"
        //     },
        //     {
        //         "data": "nilai_uas"
        //     },
        //     {
        //         "data": "total_nilai"
        //     },
        //     {
        //         "data": "ranking"
        //     },
        // ]
    });
});

function showTahunAjaran() {
    var id_tahun_ajaran = $("#id_tahun_ajaran").val();
    window.location.href = "/siswa/laporan/"+id_tahun_ajaran;
}
</script>