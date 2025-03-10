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
    $.get("/admin/view-tahun-ajaran", function(data) {
        $('#id_tahun_ajaran_konfirmasi_kelas').empty();
        $('#id_tahun_ajaran_konfirmasi_kelas').append('<option value="">Pilih Tahun Ajaran</option>');
        const json = data;
        const arr = JSON.parse(json);
        $.each(arr, function() {
            $.each(this, function(index, obj) {
                $('#id_tahun_ajaran_konfirmasi_kelas').append('<option value="' + obj.id +
                    '" data-id="' + obj
                    .id +
                    '">' +
                    obj.tahun_ajaran.toUpperCase() + '</option>');
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

    var table = $('#konten').DataTable({
        "bDestroy": true,
        "scrollX": true,
        "language": {
            "searchPlaceholder": 'Pencarian',
            "sSearch": '',
            "lengthMenu": '_MENU_ items/page',
        },
        "ajax": "/admin/view-siswa",
        dom: 'Bfrtip',
        buttons: [
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5'
        ],
        "columns": [{
                "data": null,
                "render": function(data) {
                    return '<div class="btn-group dropright"> ' +
                        '<a type="button" class="btn btn-default  dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">' +
                        data.nisn +
                        '</a>' +
                        '<div class="dropdown-menu">' +
                        '<a class="dropdown-item" href="#" onclick=detail("' + data.id_auth +
                        '");>Detail</a>' +
                        '<a class="dropdown-item" href="#" onclick=edit("' + data.id_auth +
                        '");>Edit</a>' +
                        '<a class="dropdown-item" href="#" onclick=hapus("' + data.id_auth +
                        '");>Hapus</a>' +
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
            // {
            //     "data": "jumlah_saudara"
            // },
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
});

function show() {
    $('#modalNewData').modal({
        backdrop: 'static',
        keyboard: false
    }, 'show');
    // $('#modalDetail').modal({
    //     backdrop: 'static',
    //     keyboard: false
    // }, 'show');
    $('#exampleModalCenterTitle').text('Tambah Siswa');
    // $('#exampleModalCenterTitle2').text('Detail Siswa');
    $("#form-add-new-data").attr('style', 'display:block');
    $("#form-detail-data").attr('style', 'display:block');
    $("#form-konfirmasi-kenaikan-kelas").attr('style', 'display:none');
}

function tutup() {
    $('#modalNewData').modal('hide');
    $('#modalDetail').modal('hide');
    $('#form-add-new-data').trigger("reset");
    $('#form-detail-data').trigger("reset");
    $('#form-konfirmasi-kenaikan-kelas').trigger("reset");
    $('#exampleModalCenterTitle').text('Tambah Siswa');
    $('#exampleModalCenterTitle2').text('Detail Siswa');

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


$("#form-konfirmasi-kenaikan-kelas input").on("change invalid", function() {
    var kelas = $(this).get(0);
    kelas.setCustomValidity("");

    if (!kelas.validity.valid) {
        kelas.setCustomValidity("Opss.. harus diisi !");
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
        url: "/admin/save-siswa",
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
                url: "/admin/delete-siswa",
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

function edit(id) {
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
                $("#form-add-new-data").attr('style', 'display:block');
                $("#form-konfirmasi-kenaikan-kelas").attr('style', 'display:none');
                $('#id').val(res.id);
                $('#id_auth').val(res.id_auth);
                $('#nisn').val(res.nisn);
                $('#nipd').val(res.nipd);
                $('#nama_siswa').val(res.nama_siswa);
                $('#email').val(res.email);
                $('#gender').val(res.gender);
                $('#tanggal_lahir').val(res.tanggal_lahir);
                $('#tempat_lahir').val(res.tempat_lahir);
                $('#agama').val(res.agama);
                $('#kewarganegaraan').val(res.kewarganegaraan);
                $('#anak_ke').val(res.anak_ke);
                $('#jlh_saudara_kandung').val(res.jlh_saudara_kandung);
                $('#jlh_saudara_tiri').val(res.jlh_saudara_tiri);
                $('#jlh_saudara_angkat').val(res.jlh_saudara_angkat);
                $('#anak_yatim_piatu').val(res.anak_yatim_piatu);
                $('#bahasa_dirumah').val(res.bahasa_dirumah);
                $('#tinggal_dengan').val(res.tinggal_dengan);
                $('#jrk_tgl_ke_sklh').val(res.jrk_tgl_ke_sklh);
                $('#gol_darah').val(res.gol_darah);
                $('#penyakit').val(res.penyakit);
                $('#kelainan_jasmani').val(res.kelainan_jasmani);
                $('#tinggi_badan').val(res.tinggi_badan);
                $('#berat_badan').val(res.berat_badan);
                $('#asal_sekolah').val(res.asal_sekolah);
                $('#tgl_no_sttb').val(res.tgl_no_sttb);
                $('#lama_bljr').val(res.lama_bljr);
                $('#diterima_dikelas').val(res.diterima_dikelas);
                $('#diterima_tgl').val(res.diterima_tgl);
                $('#jurusan').val(res.jurusan);
                $('#kesenian').val(res.kesenian);
                $('#olahraga').val(res.olahraga);
                $('#organisasi').val(res.organisasi);
                $('#lain_lain').val(res.lain_lain);
                $('#no_hp').val(res.no_hp);
                $('#id_siswa_kelas').val(res.id_siswa_kelas);

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
                                    obj.kelas.toUpperCase() +
                                    '</option>');
                            } else {
                                $('#id_kelas').append('<option value="' + obj.id +
                                    '" data-id="' + obj
                                    .id +
                                    '">' +
                                    obj.kelas.toUpperCase() +
                                    '</option>');
                            }
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

                            if (obj.id == res.id_tahun_ajaran) {
                                $('#id_tahun_ajaran').append('<option value="' + obj
                                    .id +
                                    '" data-id="' + obj
                                    .id +
                                    '" selected>' +
                                    obj.tahun_ajaran.toUpperCase() +
                                    '</option>');
                            } else {
                                $('#id_tahun_ajaran').append('<option value="' + obj
                                    .id +
                                    '" data-id="' + obj
                                    .id +
                                    '">' +
                                    obj.tahun_ajaran.toUpperCase() +
                                    '</option>');
                            }
                        });
                    });
                });


                $('#alamat').val(res.alamat);
                $('#username').val(res.username);

                $('#div-password').attr('style', 'display:none;');
                $('#btnSimpan').attr('type', 'submit');
                $('#btnSimpan').attr('class', 'btn btn-primary');
                $('#password').removeAttr('required', 'required');
                $('#confirm').removeAttr('required', 'required');

                $('#exampleModalCenterTitle').text('Edit Siswa');
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
                $('#modalDetail').modal({
                    backdrop: 'static',
                    keyboard: false
                }, 'show');
                $("#form-detail-data").attr('style', 'display:block');
                $("#form-konfirmasi-kenaikan-kelas").attr('style', 'display:none');
                $('#id2').val(res.id);
                $('#id_auth2').val(res.id_auth);
                $('#nisn2').val(res.nisn);
                $('#nipd2').val(res.nipd);
                $('#nama_siswa2').val(res.nama_siswa);
                $('#email2').val(res.email);
                $('#gender2').val(res.gender);
                $('#tanggal_lahir2').val(res.tanggal_lahir);
                $('#tempat_lahir2').val(res.tempat_lahir);
                $('#agama2').val(res.agama);
                $('#kewarganegaraan2').val(res.kewarganegaraan);
                $('#anak_ke2').val(res.anak_ke);
                $('#jlh_saudara_kandung2').val(res.jlh_saudara_kandung);
                $('#jlh_saudara_tiri2').val(res.jlh_saudara_tiri);
                $('#jlh_saudara_angkat2').val(res.jlh_saudara_angkat);
                $('#anak_yatim_piatu2').val(res.anak_yatim_piatu);
                $('#bahasa_dirumah2').val(res.bahasa_dirumah);
                $('#tinggal_dengan2').val(res.tinggal_dengan);
                $('#jrk_tgl_ke_sklh2').val(res.jrk_tgl_ke_sklh);
                $('#gol_darah2').val(res.gol_darah);
                $('#penyakit2').val(res.penyakit);
                $('#kelainan_jasmani2').val(res.kelainan_jasmani);
                $('#tinggi_badan2').val(res.tinggi_badan);
                $('#berat_badan2').val(res.berat_badan);
                $('#asal_sekolah2').val(res.asal_sekolah);
                $('#tgl_no_sttb2').val(res.tgl_no_sttb);
                $('#lama_bljr2').val(res.lama_bljr);
                $('#diterima_dikelas2').val(res.diterima_dikelas);
                $('#diterima_tgl2').val(res.diterima_tgl);
                $('#jurusan2').val(res.jurusan);
                $('#kesenian2').val(res.kesenian);
                $('#olahraga2').val(res.olahraga);
                $('#organisasi2').val(res.organisasi);
                $('#lain_lain2').val(res.lain_lain);
                $('#no_hp2').val(res.no_hp);
                $('#id_siswa_kelas2').val(res.id_siswa_kelas);

                $.get("/admin/view-all-kelas", function(data) {
                    $('#id_kelas2').empty();
                    $('#id_kelas2').append('<option value="">Pilih Kelas</option>');
                    const json = data;
                    const arr = JSON.parse(json);
                    $.each(arr, function() {
                        $.each(this, function(index, obj) {

                            if (obj.id == res.id_kelas) {
                                $('#id_kelas2').append('<option value="' + obj.id +
                                    '" data-id="' + obj
                                    .id +
                                    '" selected>' +
                                    obj.kelas.toUpperCase() +
                                    '</option>');
                            } else {
                                $('#id_kelas2').append('<option value="' + obj.id +
                                    '" data-id="' + obj
                                    .id +
                                    '">' +
                                    obj.kelas.toUpperCase() +
                                    '</option>');
                            }
                        });
                    });
                });

                $.get("/admin/view-tahun-ajaran", function(data) {
                    $('#id_tahun_ajaran2').empty();
                    $('#id_tahun_ajaran2').append('<option value="">Pilih Tahun Ajaran</option>');
                    const json = data;
                    const arr = JSON.parse(json);
                    $.each(arr, function() {
                        $.each(this, function(index, obj) {

                            if (obj.id == res.id_tahun_ajaran) {
                                $('#id_tahun_ajaran2').append('<option value="' + obj
                                    .id +
                                    '" data-id="' + obj
                                    .id +
                                    '" selected>' +
                                    obj.tahun_ajaran.toUpperCase() +
                                    '</option>');
                            } else {
                                $('#id_tahun_ajaran2').append('<option value="' + obj
                                    .id +
                                    '" data-id="' + obj
                                    .id +
                                    '">' +
                                    obj.tahun_ajaran.toUpperCase() +
                                    '</option>');
                            }
                        });
                    });
                });


                $('#alamat2').val(res.alamat);
                $('#username2').val(res.username);

                $('#exampleModalCenterTitle2').text('Detail Siswa');
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
</script>