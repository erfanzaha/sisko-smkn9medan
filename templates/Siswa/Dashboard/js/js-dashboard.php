<script type="text/javascript">
$(document).ready(function() {
    $('#konten').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5'
        ],
    });
});


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
        url: "/siswa/save-siswa",
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
        url: "/siswa/get-siswa",
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
                $('#id_auth').val(res.id_auth);
                $('#nisn').val(res.nisn);
                $('#nama_siswa').val(res.nama_siswa);
                $('#email').val(res.email);
                $('#gender').val(res.gender);
                $('#tanggal_lahir').val(res.tanggal_lahir);
                $('#agama').val(res.agama);
                $('#status').val(res.status);
                $('#jumlah_saudara').val(res.jumlah_saudara);
                $('#no_hp').val(res.no_hp);
                $('#id_siswa_kelas').val(res.id_siswa_kelas);

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
</script>