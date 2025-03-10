<script type="text/javascript">
$(document).ready(function() {
    $('#konten').DataTable({
        "bDestroy": true,
        "scrollX":true,
        "language": {
            "searchPlaceholder": 'Pencarian',
            "sSearch": '',
            "lengthMenu": '_MENU_ items/page',
        },
        "ajax": "/siswa/view-mata-pelajaran",
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
                "data": "nama_guru"
            },
        ]
    });
});
</script>