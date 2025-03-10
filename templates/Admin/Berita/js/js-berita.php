<script type="text/javascript">
$(function() {
    'use strict';
});

$(document).ready(
    window.onload = function() {
        setTimeout(function() {
            CKEDITOR.replace('deskripsi');
            CKEDITOR.config.height = 500;
        }, 0);
    }
);

$(document).ready(function() {
    var table = $('#konten').DataTable({
        "bDestroy": true,
        "scrollX":true,
        "language": {
            "searchPlaceholder": 'Pencarian',
            "sSearch": '',
            "lengthMenu": '_MENU_ items/page',
        },
        "ajax": "/admin/view-berita",
        "columns": [{
                "data": "title"
            },
            {
                "data": "tanggal"
            },
            {
                "data": null,
                "render": function(data) {
                    return '<img src="/portal/images/blog/' + data.gambar +
                        '" class="img-thumbnail" style="width:100px;">';
                }
            },
            {
                "data": "tanggal"
            },
            {
                "data": null,
                "render": function(data) {
                    return '<button title="edit" class="btn btn-warning btn-sm"  onclick=edit("' +
                        data.id + '");><i class="anticon anticon-edit"></i></button> ' +
                        '<button title="hapus" class="btn btn-danger btn-sm" onclick=hapus("' +
                        data.id + '");><i class="anticon anticon-delete"></i></button> ';
                }
            },
        ]
    });
});

function show() {
    $('#modalNewData').modal({
        backdrop: 'static',
        keyboard: false
    }, 'show');
    $("#form-add-new-data").attr('style', 'display:block');
}

function tutup() {
    $('#modalNewData').modal('hide');
    $('#form-add-new-data').trigger("reset");
    $('#exampleModalCenterTitle').text('Tambah Berita');
    $('#gambar').attr('required', 'required');
    $('#id').val("");
    CKEDITOR.instances['deskripsi'].setData("")
}

$("#form-add-new-data input").on("change invalid", function() {
    var pasar = $(this).get(0);
    pasar.setCustomValidity("");

    if (!pasar.validity.valid) {
        pasar.setCustomValidity("Opss.. harus diisi !");
    }
});

var ins = $('#form-add-new-data button').on('click', function(e) {
    $('#deskripsi').val(CKEDITOR.instances.deskripsi.getData());
    e.preventDefault();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr(
                'content')
        }
    });
    $.ajax({
        url: "/admin/save-berita",
        method: 'post',
        data: new FormData($('#form-add-new-data')[0]),
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
                url: "/admin/delete-berita",
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
        url: "/admin/get-berita",
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
                $('#id').val(res.id);
                $('#title').val(res.title);
                $('#tanggal').val(res.tanggal);
                $('#gambar').removeAttr('required');
                CKEDITOR.instances['deskripsi'].setData(res.isi_berita)
                $('#exampleModalCenterTitle').text('Edit Berita');
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