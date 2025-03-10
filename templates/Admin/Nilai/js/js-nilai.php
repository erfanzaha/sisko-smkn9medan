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

    $('#id_tahun_ajaran').on('change', function(e) {
        var id_tahun_ajaran = $(this).find('option:selected').data('id');
        $.post("/admin/view-kelas",{
            id_tahun_ajaran: id_tahun_ajaran,
        }, function(data) {
            $('#id_kelas').empty();
            $('#id_kelas').append('<option value="">Pilih Kelas</option>');
            const json = data;
            const arr = JSON.parse(json);
            $.each(arr, function() {
                $.each(this, function(index, obj) {
                    $('#id_kelas').append('<option value="' + obj.id_kelas + '" data-id="' + obj
                        .id_kelas +
                        '">' +
                        obj.kelas.toUpperCase() + '</option>');
                });
            });
        });
    });

    $.get("/admin/view-guru-pegawai", function(data) {
        $('#id_guru').empty();
        $('#id_guru').append('<option value="">Pilih Guru</option>');
        const json = data;
        const arr = JSON.parse(json);
        $.each(arr, function() {
            $.each(this, function(index, obj) {
                $('#id_guru').append('<option value="' + obj.id + '" data-id="' + obj
                    .id +
                    '">' +
                    obj.nama_guru.toUpperCase() + '</option>');
            });
        });
    });
});

function showKelas() {
    $('#div-table').attr('style', 'display:block;');
    var id_kelas = $("#id_kelas").val();
    var id_guru  = $("#id_guru").val();
    var id_tahun_ajaran  = $("#id_tahun_ajaran").val();
    $('#konten').DataTable({
        "bDestroy": true,
        "scrollX":true,
        "ajax": {
            "url": "/admin/view-nilai",
            "type": "POST",
            "data": {
                "id_kelas": id_kelas,
                "id_guru": id_guru,
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
                        data.nama_siswa +
                        '</a>' +
                        '<div class="dropdown-menu">' +
                        '<a class="dropdown-item" href="#" onclick=nilai("' + data.id_siswa + '","' +id_kelas + '","' +data.id_guru + '");>Nilai</a>' +
                        '</div> </div > ';
                }
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

function show(param) {
    $('#modalNewData').modal({
        backdrop: 'static',
        keyboard: false
    }, 'show');
    $("#form-add-new-data").attr('style', 'display:block;');

}

function tutup() {
    $('#modalNewData').modal('hide');
    $('#form-add-new-data').trigger("reset");
    $('#exampleModalCenterTitle').text('Form Nilai');
    $("#form-add-new-data").removeAttr('style');
}

$("#form-add-new-data input").on("change invalid", function() {
    var pasar = $(this).get(0);
    pasar.setCustomValidity("");

    if (!pasar.validity.valid) {
        pasar.setCustomValidity("Opss.. harus diisi !");
    }
});

var ins = $('#form-add-new-data').on('submit', function(e) {
    e.preventDefault();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
    $.ajax({
        url: "/admin/save-nilai",
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
                    window.location.reload();
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

function nilai(id_siswa, id_kelas,id_guru) {
    $.ajax({
        url: "/admin/get-nilai",
        type: "POST",
        dataType: "JSON",
        data: {
            id_siswa: id_siswa,
            id_kelas: id_kelas,
            id_guru: id_guru,
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
                $('#id').val(res.id);
                $('#id_kelas_nilai').val(id_kelas);
                $('#id_siswa').val(id_siswa);
                $('#id_guru_nilai').val(id_guru);
                $('#nilai_tugas').val(res.nilai_tugas);
                $('#nilai_mid').val(res.nilai_mid);
                $('#nilai_uas').val(res.nilai_uas);
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