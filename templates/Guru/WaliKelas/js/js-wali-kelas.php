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
        "columns": [{
                "data": null,
                "render": function(data) {
                    return '<div class="btn-group dropright"> ' +
                        '<a type="button" class="btn btn-default  dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">' +
                        data.nisn +
                        '</a>' +
                        '<div class="dropdown-menu">' +
                        '<a class="dropdown-item" href="#" onclick=naikKelas("' + data.id_auth +
                        '");>Naik Kekelas</a>' +
                        '<a class="dropdown-item" href="#" onclick=tinggalKelas("' + data
                        .id_auth +
                        '");>Tinggal Dikelas</a>' +
                        '</div> </div > '
                }
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

function tutup() {
    $('#modalNewData').modal('hide');
    $('#form-add-new-data').trigger("reset");
    $('#form-konfirmasi-kenaikan-kelas').trigger("reset");
    $('#exampleModalCenterTitle').text('Tambah Siswa');

    $('#msg-pass').attr('style', 'display:none;');
    $('#div-password').removeAttr('style', 'display:none;');
    $('#btnSimpan').attr('type', 'button');
    $('#btnSimpan').attr('class', 'btn disbled');
    $('option').removeAttr('selected', 'selected');
}

$("#form-konfirmasi-kenaikan-kelas input").on("change invalid", function() {
    var kelas = $(this).get(0);
    kelas.setCustomValidity("");

    if (!kelas.validity.valid) {
        kelas.setCustomValidity("Opss.. harus diisi !");
    }
});

var saving = $('#form-konfirmasi-kenaikan-kelas').on('submit', function(e) {
    e.preventDefault();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
    $.ajax({
        url: "/admin/save-konfirmasi-siswa",
        method: 'post',
        data: new FormData(this),
        dataType: "json",
        contentType: false,
        cache: false,
        processData: false,
        success: function(r) {
            if (r.icon == 'success') {
                swal({
                    title: "Success",
                    icon: r.icon,
                    text: r.msg,
                    dangerMode: false,
                    buttons: {
                        confirm: "Ok",
                    }
                }).then((ok) => {
                    tutup();
                    $('#konten').DataTable().ajax.reload();
                });
            } else {
                swal({
                    title: r.icon,
                    text: r.msg,
                    icon: r.icon
                });
            }
        }
    });
});

function naikKelas(id) {
    $.ajax({
        url: "/admin/get-siswa",
        type: "POST",
        dataType: "JSON",
        data: {
            id: id,
        },
        success: function(res) {
            if (res.icon != null && res.icon != '') {
                swal({
                    title: "Terjadi kesalahan",
                    text: res.msg,
                    icon: res.icon
                });
            } else {
                $('#modalNewData').modal({
                    backdrop: 'static',
                    keyboard: false
                }, 'show');
                $('#id_siswa').val(res.id);
                $('#exampleModalCenterTitle').text('Konfirmasi Kenaikan Kelas');
                $("#form-add-new-data").attr('style', 'display:none');
                $("#form-konfirmasi-kenaikan-kelas").attr('style', 'display:block');
            }
        },
        error: function() {
            swal({
                title: "Terjadi kesalahan",
                text: "Kesalahan dalam mengambil data",
                icon: "error"
            });
        }
    });
}

function tinggalKelas(id) {
    $.ajax({
        url: "/admin/get-siswa",
        type: "POST",
        dataType: "JSON",
        data: {
            id: id,
        },
        success: function(res) {
            if (res.icon != null && res.icon != '') {
                swal({
                    title: "Terjadi kesalahan",
                    text: res.msg,
                    icon: res.icon
                });
            } else {
                $('#modalNewData').modal({
                    backdrop: 'static',
                    keyboard: false
                }, 'show');
                $('#id_siswa').val(res.id);
                $('#exampleModalCenterTitle').text('Konfirmasi Tinggal Kelas');
                $("#form-add-new-data").attr('style', 'display:none');
                $("#form-konfirmasi-kenaikan-kelas").attr('style', 'display:block');
            }
        },
        error: function() {
            swal({
                title: "Terjadi kesalahan",
                text: "Kesalahan dalam mengambil data",
                icon: "error"
            });
        }
    });
}
</script>