<script type="text/javascript">
function checkPass() {
    var newPass = $('#password').val();
    var confirmPass = $('#confirm').val();
    if (newPass == confirmPass && newPass != "" && confirmPass != "" && newPass.length >= 8) {
        $('#btnSimpan').attr('type', 'submit');
        $('#btnSimpan').attr('class', 'btn btn-primary');
        $('#msg-pass').attr('style', 'display:block;');
        $('#msg-pass').attr('class', 'alert alert-success ');
        $('#msg-pass span').html('Password sesuai');
    } else {
        $('#msg-pass').attr('style', 'display:block;');
        $('#msg-pass').attr('class', 'alert alert-danger ');
        if (newPass != confirmPass) {
            $('#msg-pass span').html('Password tidak sama');
        } else if (newPass.length < 8) {
            $('#msg-pass span').html('Panjang password kurang dari 8');
        }
        $('#btnSimpan').attr('type', 'button');
        $('#btnSimpan').attr('class', 'btn disbled');
    }
}

$(document).ready(function() {

    var table = $('#konten').DataTable({
        "bDestroy": true,
        "scrollX" : true,
        "language": {
            "searchPlaceholder": 'Pencarian',
            "sSearch": '',
            "lengthMenu": '_MENU_ items/page',
        },
        "ajax": "/admin/view-orang-tua",
        "columns": [{
                "data": null,
                "render": function(data) {
                    return '<div class="btn-group dropright"> ' +
                        '<a type="button" class="btn btn-default  dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">' +
                        data.nisn +
                        '</a>' +
                        '<div class="dropdown-menu">' +
                        '<a class="dropdown-item" href="#" onclick=edit("' + data.id +
                        '");>Edit</a>' +
                        '<a class="dropdown-item" href="#" onclick=detail("' + data.id +
                        '");>Detail</a>' +
                        '</div> </div > ';
                }
            },
            {
                "data": "nama_siswa"
            },
            {
                "data": "nama_ayah"
            },
            {
                "data": "nama_ibu"
            },
            {
                "data": "no_hp_ayah"
            },
            {
                "data": "no_hp_ibu"
            },
            {
                "data": "pekerjaan_ayah"
            },
            {
                "data": "pekerjaan_ibu"
            },
            {
                "data": "agama_ayah"
            },
            {
                "data": "agama_ibu"
            },
        ]
    });
});

function tutup() {
    $('#modalNewData').modal('hide');
    $('#modalDetail').modal('hide');
    $('#form-add-new-data').trigger("reset");
    $('#form-detail-data').trigger("reset");
    $('#exampleModalCenterTitle').text('Tambah Orang Tua');

    $('#msg-pass').attr('style', 'display:none;');
    $('#div-password').removeAttr('style', 'display:none;');
    $('#btnSimpan').attr('type', 'button');
    $('#btnSimpan').attr('class', 'btn disbled');
    $('option').removeAttr('selected', 'selected');
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
        url: "/admin/save-orang-tua",
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

function edit(id) {
    $.ajax({
        url: "/admin/get-orang-tua",
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
                $('#id_siswa').val(id);
                $('#id_auth').val(res.id_auth);
                $('#nama_ayah').val(res.nama_ayah);
                $('#tmpt_lhr_ayah').val(res.tmpt_lhr_ayah);
                $('#tanggal_lahir_ayah').val(res.tanggal_lahir_ayah);
                $('#agama_ayah').val(res.agama_ayah);
                $('#pendidikan_ayah').val(res.pendidikan_ayah);
                $('#pekerjaan_ayah').val(res.pekerjaan_ayah);
                $('#penghasilan_ayah').val(res.penghasilan_ayah);
                $('#no_hp_ayah').val(res.no_hp_ayah);
                $('#alamat_ayah').val(res.alamat_ayah);
                $('#hidup_meninggal_ayah').val(res.hidup_meninggal_ayah);
                $('#nama_ibu').val(res.nama_ibu);
                $('#tmpt_lhr_ibu').val(res.tmpt_lhr_ibu);
                $('#tanggal_lahir_ibu').val(res.tanggal_lahir_ibu);
                $('#agama_ibu').val(res.agama_ibu);
                $('#pendidikan_ibu').val(res.pendidikan_ibu);
                $('#pekerjaan_ibu').val(res.pekerjaan_ibu);
                $('#penghasilan_ibu').val(res.penghasilan_ibu);
                $('#no_hp_ibu').val(res.no_hp_ibu);
                $('#alamat_ibu').val(res.alamat_ibu);
                $('#hidup_meninggal_ibu').val(res.hidup_meninggal_ibu);
                $('#nama_wali').val(res.nama_wali);
                $('#tmpt_lhr_wali').val(res.tmpt_lhr_wali);
                $('#tanggal_lahir_wali').val(res.tanggal_lahir_wali);
                $('#agama_wali').val(res.agama_wali);
                $('#pendidikan_wali').val(res.pendidikan_wali);
                $('#pekerjaan_wali').val(res.pekerjaan_wali);
                $('#penghasilan_wali').val(res.penghasilan_wali);
                $('#no_hp_wali').val(res.no_hp_wali);
                $('#alamat_wali').val(res.alamat_wali);
                $('#username').val(res.username);

                $('#div-password').attr('style', 'display:none;');
                $('#btnSimpan').attr('type', 'submit');
                $('#btnSimpan').attr('class', 'btn btn-primary');
                $('#password').removeAttr('required', 'required');
                $('#confirm').removeAttr('required', 'required');

                $('#exampleModalCenterTitle').text('Edit Orang Tua');
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
function detail(id) {
    $.ajax({
        url: "/admin/get-orang-tua",
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
                $('#modalDetail').modal({
                    backdrop: 'static',
                    keyboard: false
                }, 'show');
                $("#form-detail-data").attr('style', 'display:block');
                $('#id2').val(res.id);
                $('#id_siswa2').val(id);
                $('#id_auth2').val(res.id_auth);
                $('#nama_ayah2').val(res.nama_ayah);
                $('#tmpt_lhr_ayah2').val(res.tmpt_lhr_ayah);
                $('#tanggal_lahir_ayah2').val(res.tanggal_lahir_ayah);
                $('#agama_ayah2').val(res.agama_ayah);
                $('#pendidikan_ayah2').val(res.pendidikan_ayah);
                $('#pekerjaan_ayah2').val(res.pekerjaan_ayah);
                $('#penghasilan_ayah2').val(res.penghasilan_ayah);
                $('#no_hp_ayah2').val(res.no_hp_ayah);
                $('#alamat_ayah2').val(res.alamat_ayah);
                $('#hidup_meninggal_ayah2').val(res.hidup_meninggal_ayah);
                $('#nama_ibu2').val(res.nama_ibu);
                $('#tmpt_lhr_ibu2').val(res.tmpt_lhr_ibu);
                $('#tanggal_lahir_ibu2').val(res.tanggal_lahir_ibu);
                $('#agama_ibu2').val(res.agama_ibu);
                $('#pendidikan_ibu2').val(res.pendidikan_ibu);
                $('#pekerjaan_ibu2').val(res.pekerjaan_ibu);
                $('#penghasilan_ibu2').val(res.penghasilan_ibu);
                $('#no_hp_ibu2').val(res.no_hp_ibu);
                $('#alamat_ibu2').val(res.alamat_ibu);
                $('#hidup_meninggal_ibu2').val(res.hidup_meninggal_ibu);
                $('#nama_wali2').val(res.nama_wali);
                $('#tmpt_lhr_wali2').val(res.tmpt_lhr_wali);
                $('#tanggal_lahir_wali2').val(res.tanggal_lahir_wali);
                $('#agama_wali2').val(res.agama_wali);
                $('#pendidikan_wali2').val(res.pendidikan_wali);
                $('#pekerjaan_wali2').val(res.pekerjaan_wali);
                $('#penghasilan_wali2').val(res.penghasilan_wali);
                $('#no_hp_wali2').val(res.no_hp_wali);
                $('#alamat_wali2').val(res.alamat_wali);
                $('#username2').val(res.username);

                $('#exampleModalCenterTitle').text('Detail Orang Tua');
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