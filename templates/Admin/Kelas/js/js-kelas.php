<script type="text/javascript">
$(document).ready(function() {
    $.get("/admin/view-tahun-ajaran", function(data) {
        $('#id_tahun_ajaran').empty();
        $('#id_tahun_ajaran').append('<option value="" disabled selected>Pilih Tahun Ajaran</option>');
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
        $('#id_tahun_ajaran_wali_kelas').empty();
        $('#id_tahun_ajaran_wali_kelas').append('<option value="" disabled selected>Pilih Tahun Ajaran</option>');
        const json = data;
        const arr = JSON.parse(json);
        $.each(arr, function() {
            $.each(this, function(index, obj) {
                $('#id_tahun_ajaran_wali_kelas').append('<option value="' + obj.id +
                    '" data-id="' + obj
                    .id +
                    '">' +
                    obj.tahun_ajaran.toUpperCase() + '</option>');
            });
        });
    });

    $.get("/admin/view-all-kelas", function(data) {
        $('#id_kelas').empty();
        $('#id_kelas').append('<option value="" disabled selected>Pilih Kelas</option>');
        const json = data;
        const arr = JSON.parse(json);
        $.each(arr, function() {
            $.each(this, function(index, obj) {
                $('#id_kelas').append('<option value="' + obj.id + '" data-id="' + obj
                    .id +
                    '">' +
                    obj.kelas.toUpperCase() + '</option>');
            });
        });
    });

    $.get("/admin/view-guru-pegawai", function(data) {
        $('#id_guru').empty();
        $('#id_guru').append('<option value="" disabled selected>Pilih Guru</option>');
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

    var table = $('#konten').DataTable({});
});

function show(param) {
    if (param == "kelas") {
        $('#modalNewData').modal({
            backdrop: 'static',
            keyboard: false
        }, 'show');
        $("#form-add-new-data").attr('style', 'display:block;');
        $("#form-wali-kelas").attr('style', 'display:none;');
        $('#exampleModalCenterTitle').text('Tambah Kelas');
    } else if (param == "waliKelas") {
        $('#modalNewData').modal({
            backdrop: 'static',
            keyboard: false
        }, 'show');
        $("#form-add-new-data").attr('style', 'display:none;');
        $("#form-wali-kelas").attr('style', 'display:block;');
        $('#exampleModalCenterTitle').text('Tambah Wali Kelas');
    }

}

function showTahunAjaran() {
    var id_tahun_ajaran = $("#id_tahun_ajaran").val();
    $('#konten').DataTable({
        "bDestroy": true,
        "scrollX": true,
        "ajax": {
            "url": "/admin/view-kelas",
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
        "columns": [
            {
                "data": "jurusan"
            },
            {
                "data": "kelas"
            },
            {
                "data": "wali_kelas"
            },
            {
                "data": "tahun_ajaran"
            },
            {
                "data": null,
                "render": function(data) {
                    if (data.wali_kelas == "") {
                        return '<button title="Edit" class="btn btn-warning btn-sm"  onclick=edit("' +
                            data.id + '");><i class="anticon anticon-edit"></i></button> ' +
                            '<button title="Hapus" class="btn btn-danger btn-sm" onclick=hapus("' +
                            data
                            .id + '");><i class="anticon anticon-delete"></i></button> ';
                    } else {
                        return '<button title="Edit" class="btn btn-warning btn-sm"  onclick=edit("' +
                            data.id + '");><i class="anticon anticon-edit"></i></button> ' +
                            '<button title="Hapus" class="btn btn-danger btn-sm" onclick=hapus("' +
                            data
                            .id + '");><i class="anticon anticon-delete"></i></button> ' +
                            '<button title="Edit Walikelas" class="btn btn-info btn-sm" onclick=changeWaliKelas("' +
                            data
                            .id_wali_kelas +
                            '");><i class="anticon anticon-user"></i></button> ';
                    }
                }
            },
        ]
    });
}

function tutup() {
    $('#modalNewData').modal('hide');
    $('#form-add-new-data').trigger("reset");
    $('#form-wali-kelas').trigger("reset");
    $('#exampleModalCenterTitle').text('Tambah Kelas');
    $("#form-add-new-data").removeAttr('style');
    $("#form-wali-kelas").removeAttr('style');
}

$("#form-add-new-data input").on("change invalid", function() {
    var pasar = $(this).get(0);
    pasar.setCustomValidity("");

    if (!pasar.validity.valid) {
        pasar.setCustomValidity("Opss.. harus diisi !");
    }
});

$("#form-wali-kelas      input").on("change invalid", function() {
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
        url: "/admin/save-kelas",
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
                    // $('#konten').DataTable().ajax.reload();
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

var ins2 = $('#form-wali-kelas').on('submit', function(e) {
    e.preventDefault();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
    $.ajax({
        url: "/admin/save-wali-kelas",
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
                    // $('#konten').DataTable().ajax.reload();
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

function hapus(id) {
    swal({
        title: "Peringatan",
        icon: "warning",
        text: "Yakin ingin menghapus data ini?",
        dangerMode: true,
        buttons: {
            cancel: "Batal",
            confirm: "Hapus",
        }
    }).then((ok) => {
        if (ok) {
            $.ajax({
                url: "/admin/delete-kelas",
                type: "POST",
                dataType: "JSON",
                data: {
                    id: id,
                },
                success: function(r) {
                    swal({
                        title: "Berhasil",
                        icon: r.icon,
                        text: r.msg,
                        dangerMode: false,
                        buttons: {
                            confirm: "Ok",
                        }
                    }).then((ok) => {
                        tutup();
                        // $('#konten').DataTable().ajax.reload();
                    });
                }
            });
        } else {
            swal({
                title: "Dibatalkan",
                text: "Data Batal Dihapus",
                icon: "info"
            });
        }
    });
}

function edit(id) {
    $.ajax({
        url: "/admin/get-kelas",
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
                $("#form-add-new-data").attr('style', 'display:block');
                $("#form-wali-kelas").attr('style', 'display:none');
                $('#id').val(id);
                $('#jurusan').val(res.jurusan);
                $('#kelas').val(res.kelas);
                $('#exampleModalCenterTitle').text('Edit Kelas');
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

function changeWaliKelas(id) {
    $.ajax({
        url: "/admin/get-wali-kelas",
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
                $("#form-add-new-data").attr('style', 'display:none');
                $("#form-wali-kelas").attr('style', 'display:block');
                $('#id_wali_kelas').val(id);

                $.get("/admin/view-kelas", function(data) {
                    $('#id_kelas').empty();
                    $('#id_kelas').append('<option value="">Pilih Kelas</option>');
                    const json = data;
                    const arr = JSON.parse(json);
                    $.each(arr, function() {
                        $.each(this, function(index, obj) {

                            if (obj.id == res.id_kelas) {
                                $('#id_kelas').append('<option value="' + obj.id +
                                    '" data-id="' + obj
                                    .id +
                                    '" selected>' +
                                    obj.kelas.toUpperCase() + '</option>');
                            } else {
                                $('#id_kelas').append('<option value="' + obj.id +
                                    '" data-id="' + obj
                                    .id +
                                    '">' +
                                    obj.kelas.toUpperCase() + '</option>');
                            }
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

                            if (obj.id == res.id_guru) {
                                $('#id_guru').append('<option value="' + obj.id +
                                    '" data-id="' + obj
                                    .id +
                                    '" selected>' +
                                    obj.nama_guru.toUpperCase() + '</option>');
                            } else {
                                $('#id_guru').append('<option value="' + obj.id +
                                    '" data-id="' + obj
                                    .id +
                                    '">' +
                                    obj.nama_guru.toUpperCase() + '</option>');
                            }
                        });
                    });
                });

                $('#exampleModalCenterTitle').text('Edit Wali Kelas');
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