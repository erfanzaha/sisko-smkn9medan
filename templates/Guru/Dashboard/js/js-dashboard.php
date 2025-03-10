<script type="text/javascript">
$("#form-add-new-data input").on("change invalid", function() {
    var pasar = $(this).get(0);
    pasar.setCustomValidity("");

    if (!pasar.validity.valid) {
        pasar.setCustomValidity("Opss.. harus diisi !");
    }
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
    $('#exampleModalCenterTitle').text('Tambah Administrator');

    $('#msg-pass').attr('style', 'display:none;');
    $('#div-password').removeAttr('style', 'display:none;');
    $('#btnSimpan').attr('type', 'button');
    $('#btnSimpan').attr('class', 'btn disbled');
    $('option').removeAttr('selected', 'selected');
}

var ins = $('#form-add-new-data').on('submit', function(e) {
    e.preventDefault();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
    $.ajax({
        url: "/guru/save-guru",
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

function edit() {
    var id = '<?= $id_user ?>';
    $.ajax({
        url: "/guru/get-guru",
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
                $('#id').val(id);
                $("#form-add-new-data").attr('style', 'display:block');
                $("#form-add-new-data-wali-kelas").attr('style', 'display:none');
                $('#id').val(res.id);
                $('#id_auth').val(res.id_auth);
                $('#nip').val(res.nip);
                $('#nama_guru').val(res.nama_guru);
                $('#email').val(res.email);
                $('#gender').val(res.gender);
                $('#tanggal_lahir').val(res.tanggal_lahir);
                $('#agama').val(res.agama);
                $('#status').val(res.status);
                $('#jabatan').val(res.jabatan);
                $('#no_hp').val(res.no_hp);
                $('#kategori').val(res.kategori);

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