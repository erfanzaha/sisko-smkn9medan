<script type="text/javascript">
function showKelas(id_kelas, konten,tahunAjaran) {
    $('#konten' + konten).DataTable({
        "bDestroy": true,
        "ajax": {
            "url": "/guru/view-nilai",
            "type": "POST",
            "data": {
                "id_kelas": id_kelas,
                "id_tahun_ajaran":tahunAjaran
            },
        },
        "scrollX": true,
        "language": {
            "searchPlaceholder": 'Pencarian',
            "sSearch": '',
            "lengthMenu": '_MENU_ items/page',
        },
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
                        data.nama_siswa +
                        '</a>' +
                        '<div class="dropdown-menu">' +
                        '<a class="dropdown-item" href="#" onclick=nilai("' + data.id_siswa + '","' +
                        id_kelas + '","' +
                        tahunAjaran + '");>Nilai</a>' +
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
        url: "/guru/save-nilai",
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

function nilai(id_siswa, id_kelas, tahunAjaran) {
    $.ajax({
        url: "/guru/get-nilai",
        type: "POST",
        dataType: "JSON",
        data: {
            id_siswa: id_siswa,
            id_kelas: id_kelas,
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
                $('#id_tahun_ajaran').val(tahunAjaran);
                $('#id_kelas').val(id_kelas);
                $('#id_siswa').val(id_siswa);
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