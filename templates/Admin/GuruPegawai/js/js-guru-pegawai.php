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
    $.get("/admin/view-mata-pelajaran", function(data) {
        $('#id_mapel').empty();
        $('#id_mapel').append('<option value="">Pilih Mata Pelajaran</option>');
        const json = data;
        const arr = JSON.parse(json);
        $.each(arr, function() {
            $.each(this, function(index, obj) {
                $('#id_mapel').append('<option value="' + obj.id + '" data-id="' + obj
                    .id +
                    '">' +
                    obj.mata_pelajaran.toUpperCase() + '</option>');
            });
        });
    });

    var table = $('#konten').DataTable({
        "bDestroy": true,
        "scrollX":true,
        "language": {
            "searchPlaceholder": 'Pencarian',
            "sSearch": '',
            "lengthMenu": '_MENU_ items/page',
        },
        "ajax": "/admin/view-guru-pegawai",
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
                        data.nip+
                        '</a>' +
                        '<div class="dropdown-menu">'+
                            '<a class="dropdown-item" href="#" onclick=detail("' +data.id_auth + '");>Detail</a>'+
                            '<a class="dropdown-item" href="#" onclick=edit("' +data.id_auth + '");>Edit</a>'+
                            '<a class="dropdown-item" href="#" onclick=hapus("' +data.id_auth + '");>Hapus</a>'+
                        '</div> </div > ';
                }
            }, {
                "data": "nama_guru"
            },
            {
                "data": "gender"
            },
            {
                "data": "mata_pelajaran"
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
                "data": "jabatan"
            },
            {
                "data": "no_hp"
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
    $("#form-add-new-data").attr('style', 'display:block');
    $("#form-detail-data").attr('style', 'display:block');
}

function tutup() {
    $('#modalNewData').modal('hide');
    $('#modalDetail').modal('hide');
    $('#form-add-new-data').trigger("reset");
    $('#form-detail-data').trigger("reset");
    $('#exampleModalCenterTitle').text('Tambah Guru dan Pegawai');
    $('#detailModalCenterTitle').text('Detail Guru dan Pegawai');

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
        url: "/admin/save-guru-pegawai",
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
                url: "/admin/delete-guru-pegawai",
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
        url: "/admin/get-guru-pegawai",
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
                $("#form-add-new-data-wali-kelas").attr('style', 'display:none');
                $('#id').val(res.id);
                $('#id_auth').val(res.id_auth);
                $('#nip').val(res.nip);
                $('#npwp').val(res.npwp);
                $('#nuptk').val(res.nuptk);
                $('#nama_guru').val(res.nama_guru);
                $('#gender').val(res.gender);
                $('#tmpt_lhr').val(res.tmpt_lhr);
                $('#tanggal_lahir').val(res.tanggal_lahir);
                $('#agama').val(res.agama);
                $('#jabatan').val(res.jabatan);
                $('#tmt_jabatan').val(res.tmt_jabatan);
                $('#pangkat').val(res.pangkat);
                $('#tmt_pangkat').val(res.tmt_pangkat);
                $('#no_hp').val(res.no_hp);
                $('#nama_pt').val(res.nama_pt);
                $('#jurusan_di_pt').val(res.jurusan_di_pt);
                $('#tamat_thn_di_pt').val(res.tamat_thn_di_pt);
                $('#sts_keguruan').val(res.sts_keguruan);
                $('#tmt_tugas_di_sklh').val(res.tmt_tugas_di_sklh);
                $('#masa_kerja_keseluruhan').val(res.masa_kerja_keseluruhan);
                $('#cttn_mutasi_kepeg').val(res.cttn_mutasi_kepeg);
                $('#tgl_lulus_sertifikasi').val(res.tgl_lulus_sertifikasi);
                $('#pensiun_tmt').val(res.pensiun_tmt);
                $('#kenaikan_gaji_berkala').val(res.kenaikan_gaji_berkala);

                $.get("/admin/view-mata-pelajaran", function(data) {
                    $('#id_mapel').empty();
                    $('#id_mapel').append('<option value="">Pilih Mata Pelajaran</option>');
                    const json = data;
                    const arr = JSON.parse(json);
                    $.each(arr, function() {
                        $.each(this, function(index, obj) {

                            if (obj.id == res.id_mapel) {
                                $('#id_mapel').append('<option value="' + obj.id +
                                    '" data-id="' + obj
                                    .id +
                                    '" selected>' +
                                    obj.mata_pelajaran.toUpperCase() +
                                    '</option>');
                            } else {
                                $('#id_mapel').append('<option value="' + obj.id +
                                    '" data-id="' + obj
                                    .id +
                                    '">' +
                                    obj.mata_pelajaran.toUpperCase() +
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

                $('#exampleModalCenterTitle').text('Edit Guru dan Pegawai');
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
        url: "/admin/get-guru-pegawai",
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
                $("#form-add-new-data-wali-kelas").attr('style', 'display:none');
                $('#id2').val(res.id);
                $('#id_auth2').val(res.id_auth);
                $('#nip2').val(res.nip);
                $('#npwp2').val(res.npwp);
                $('#nuptk2').val(res.nuptk);
                $('#nama_guru2').val(res.nama_guru);
                $('#gender2').val(res.gender);
                $('#tmpt_lhr2').val(res.tmpt_lhr);
                $('#tanggal_lahir2').val(res.tanggal_lahir);
                $('#agama2').val(res.agama);
                $('#jabatan2').val(res.jabatan);
                $('#tmt_jabatan2').val(res.tmt_jabatan);
                $('#pangkat2').val(res.pangkat);
                $('#tmt_pangkat2').val(res.tmt_pangkat);
                $('#no_hp2').val(res.no_hp);
                $('#nama_pt2').val(res.nama_pt);
                $('#jurusan_di_pt2').val(res.jurusan_di_pt);
                $('#tamat_thn_di_pt2').val(res.tamat_thn_di_pt);
                $('#sts_keguruan2').val(res.sts_keguruan);
                $('#tmt_tugas_di_sklh2').val(res.tmt_tugas_di_sklh);
                $('#masa_kerja_keseluruhan2').val(res.masa_kerja_keseluruhan);
                $('#cttn_mutasi_kepeg2').val(res.cttn_mutasi_kepeg);
                $('#tgl_lulus_sertifikasi2').val(res.tgl_lulus_sertifikasi);
                $('#pensiun_tmt2').val(res.pensiun_tmt);
                $('#kenaikan_gaji_berkala2').val(res.kenaikan_gaji_berkala);

                $.get("/admin/view-mata-pelajaran", function(data) {
                    $('#id_mapel2').empty();
                    $('#id_mapel2').append('<option value="">Pilih Mata Pelajaran</option>');
                    const json = data;
                    const arr = JSON.parse(json);
                    $.each(arr, function() {
                        $.each(this, function(index, obj) {

                            if (obj.id == res.id_mapel) {
                                $('#id_mapel2').append('<option value="' + obj.id +
                                    '" data-id="' + obj
                                    .id +
                                    '" selected>' +
                                    obj.mata_pelajaran.toUpperCase() +
                                    '</option>');
                            } else {
                                $('#id_mapel2').append('<option value="' + obj.id +
                                    '" data-id="' + obj
                                    .id +
                                    '">' +
                                    obj.mata_pelajaran.toUpperCase() +
                                    '</option>');
                            }
                        });
                    });
                });


                $('#alamat2').val(res.alamat);
                $('#username2').val(res.username);
                $('#detailModalCenterTitle').text('Detail Guru dan Pegawai');
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