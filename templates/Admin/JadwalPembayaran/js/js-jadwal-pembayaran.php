<script type="text/javascript">
$(function() {
    'use strict';
});

$(document).ready(function() {

    var table = $('#konten').DataTable({
        "bDestroy": true,
        "scrollX":true,
        "language": {
            "searchPlaceholder": 'Pencarian',
            "sSearch": '',
            "lengthMenu": '_MENU_ items/page',
        },
        "ajax": "/admin/view-jadwal-pembayaran",
        "columns": [{
                "data": "keterangan"
            },
            {
                "data": "tanggal_jatuh_tempo"
            },
            {
                "data": null,
                "render": function(data) {
                    return "Rp. "+formatNumber(data.jumlah_tagihan);
                }
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

function formatNumber(num) {
    return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
}

function rupiahCurrency() {
    var rupiah = document.getElementById('jumlah_tagihan');
    var hasil = formatRupiah(rupiah.value, 'Rp. ');    
    $("#jumlah_tagihan").val(hasil);
}

function formatRupiah(angka, prefix) {
    var number_string = angka.replace(/[^,\d]/g, '').toString(),
        split = number_string.split(','),
        sisa = split[0].length % 3,
        rupiah = split[0].substr(0, sisa),
        ribuan = split[0].substr(sisa).match(/\d{3}/gi);


    if (ribuan) {
        separator = sisa ? '.' : '';
        rupiah += separator + ribuan.join('.');
    }

    rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
    return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
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
    $('#id').val("");
    $('#exampleModalCenterTitle').text('Tambah Jadwal Pembayaran');
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
        url: "/admin/save-jadwal-pembayaran",
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
                url: "/admin/delete-jadwal-pembayaran",
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
        url: "/admin/get-jadwal-pembayaran",
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
                $('#keterangan').val(res.keterangan);
                $('#jumlah_tagihan').val(res.jumlah_tagihan);
                $('#tanggal_jatuh_tempo').val(res.tanggal_jatuh_tempo);

                $('#exampleModalCenterTitle').text('Edit Jadwal Pembayaran');
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