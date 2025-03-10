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

    $.get("/admin/view-tahun-ajaran", function(data) {
        $('#id_tahun_ajaran_konfirmasi_kelas').empty();
        $('#id_tahun_ajaran_konfirmasi_kelas').append('<option value="">Pilih Tahun Ajaran</option>');
        const json = data;
        const arr = JSON.parse(json);
        $.each(arr, function() {
            $.each(this, function(index, obj) {
                $('#id_tahun_ajaran_konfirmasi_kelas').append('<option value="' + obj
                    .id +
                    '" data-id="' + obj
                    .id +
                    '">' +
                    obj.tahun_ajaran.toUpperCase() + '</option>');
            });
        });
    });

    $.get("/admin/view-all-kelas", function(data) {
        $('#id_kelas_konfirmasi_kelas').empty();
        $('#id_kelas_konfirmasi_kelas').append('<option value="">Pilih Kelas</option>');
        const json = data;
        const arr = JSON.parse(json);
        $.each(arr, function() {
            $.each(this, function(index, obj) {
                $('#id_kelas_konfirmasi_kelas').append('<option value="' + obj.id + '" data-id="' + obj
                    .id +
                    '">' +
                    obj.kelas.toUpperCase() + '</option>');
            });
        });
    });

    var table = $('#konten').DataTable({});
});


function showTahunAjaran() {
    var id_tahun_ajaran = $("#id_tahun_ajaran").val();
    $('#konten').DataTable({
        "bDestroy": true,
        "scrollX": true,
        "ajax": {
            "url": "/guru/view-wali-kelas",
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
            {
               extend: 'excelHtml5',
               title: 'Sistem Informasi Sekolah - DATA SISWA ',             
               orientation: 'landscape',
               pageSize: 'A4',
            },
            {
               extend: 'csvHtml5',
               title: 'Sistem Informasi Sekolah - DATA SISWA ',             
               orientation: 'landscape',
               pageSize: 'A4',
            },
            {
               extend: 'pdfHtml5',
               title: 'Sistem Informasi Sekolah - DATA SISWA ',             
               orientation: 'landscape',
               pageSize: 'A4',
            },
        ],
        "columns": [
            {
                "data": "nisn"
            },
            {
                "data": "nama_siswa"
            },
            {
                "data": "email"
            },
            {
                "data": "gender"
            },
            {
                "data": "tanggal_lahir"
            },
            {
                "data": "agama"
            },
            {
                "data": "alamat"
            },
            {
                "data": "jumlah_saudara"
            },
            {
                "data": "no_hp"
            },
            {
                "data": "kelas"
            },
            {
                "data": "orang_tua"
            },
        ]
    });
}
</script>