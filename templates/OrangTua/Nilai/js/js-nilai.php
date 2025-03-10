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
        dom: 'Bfrtip',
        buttons: [
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5'
        ]
    });
});

function showTahunAjaran() {
    var id_tahun_ajaran = $("#id_tahun_ajaran").val();
    $('#konten').DataTable({
        "bDestroy": true,
        "scrollX": true,
        "ajax": {
            "url": "/orangtua/view-nilai",
            "type": "POST",
            "data": {
                "id_tahun_ajaran": id_tahun_ajaran,
            },
        },
        "responsive": true,
        "language": {
            "searchPlaceholder": 'Pencarian',
            "sSearch": '',
            "lengthMenu": '_MENU_ items/page',
        },
        dom: 'Bfrtip',
        buttons: [
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5'
        ],
        "columns": [{
                "data": "mapel"
            },
            {
                "data": "nilai_tugas"
            },
            {
                "data": "nilai_mid"
            },
            {
                "data": "nilai_uas"
            },
        ]
    });
}
</script>