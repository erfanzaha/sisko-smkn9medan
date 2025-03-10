<script type="text/javascript">
$(document).ready(function() {
    $.get("/admin/view-all-kelas", function(data) {
        $('#id_kelas').empty();
        $('#id_kelas').append('<option value="">Pilih Kelas</option>');
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

    var table = $('#konten').DataTable({
        "bDestroy": true,
        "scrollX": true,
        "language": {
            "searchPlaceholder": 'Pencarian',
            "sSearch": '',
            "lengthMenu": '_MENU_ items/page',
        },
        "ajax": "/admin/view-kelas-yang-diajar",
        "columns": [{
                "data": "nama_guru"
            },
            {
                "data": "kelas"
            },
            {
                "data": "tahun_ajaran"
            },
            {
                "data": null,
                "render": function(data) {

                    return '<button title="edit" class="btn btn-warning btn-sm"  onclick=edit("' +
                        data.id + '");><i class="anticon anticon-edit"></i></button> ' +
                        '<button title="hapus" class="btn btn-danger btn-sm" onclick=hapus("' +
                        data
                        .id + '");><i class="anticon anticon-delete"></i></button> ';
                }
            },
        ]
    });
});

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
    $('#id').val("");
    $('#exampleModalCenterTitle').text('Tambah Kelas yang Diajar');
}

$("#form-add-new-data input").on("change invalid", function() {
    var pasar = $(this).get(0);
    pasar.setCustomValidity("");

    if (!pasar.validity.valid) {
        pasar.setCustomValidity("Opss.. harus diisi !");
    }
});

$("#form-wali-kelas input").on("change invalid", function() {
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
        url: "/admin/save-kelas-yang-diajar",
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
                url: "/admin/delete-kelas-yang-diajar",
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
                        $('#konten').DataTable().ajax.reload();
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
        url: "/admin/get-kelas-yang-diajar",
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

                $.get("/admin/view-tahun-ajaran", function(data) {
                    $('#id_tahun_ajaran').empty();
                    $('#id_tahun_ajaran').append('<option value="">Pilih Tahun Ajaran</option>');
                    const json = data;
                    const arr = JSON.parse(json);
                    $.each(arr, function() {
                        $.each(this, function(index, obj) {
                            if (obj.id == res.id_tahun_ajaran) {
                                $('#id_tahun_ajaran').append('<option value="' + obj
                                    .id +
                                    '" data-id="' + obj
                                    .id +
                                    '" selected>' +
                                    obj.tahun_ajaran.toUpperCase() + '</option>'
                                    );
                            } else {
                                $('#id_tahun_ajaran').append('<option value="' + obj
                                    .id +
                                    '" data-id="' + obj
                                    .id +
                                    '">' +
                                    obj.tahun_ajaran.toUpperCase() + '</option>'
                                    );
                            }
                        });
                    });
                });

                $.get("/admin/view-all-kelas", function(data) {
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

                $('#exampleModalCenterTitle').text('Edit Kelas Yang Diajar');
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