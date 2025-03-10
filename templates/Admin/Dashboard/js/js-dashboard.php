<script>
function formatNumber(num) {
    return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
}
$(document).ready(function() {

    var table = $('#konten').DataTable({
        "bDestroy": true,
        "language": {
            "searchPlaceholder": 'Pencarian',
            "sSearch": '',
            "lengthMenu": '_MENU_ items/page',
        },
        "ajax": "/admin/view-dashboard-pembayaran",
        "columns": [{
                "data": "nama_siswa"
            },
            {
                "data": "keterangan"
            },
            {
                "data": "status_pembayaran"
            },
            {
                "data": null,
                "render": function(data) {
                    return "Rp. " + formatNumber(data.jumlah_tagihan);
                }
            },
        ]
    });
});
</script>