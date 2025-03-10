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
        "ajax": "/admin/view-pembayaran",
        "columns": [
            {
                "data": null,
                "render": function(data) {
                    if(data.status_pembayaran == 'sudah dibayar'){
                        return '<div class="btn-group dropright"> ' +
                        '<a type="button" class="btn btn-default  dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">' +
                        data.nama_siswa+
                        '</a>' +
                        '<div class="dropdown-menu">'+
                            '<a class="dropdown-item" href="#" onclick=konfirmasi("' +data.id + '");>Edit Pembayaran</a>'+
                            '<a class="dropdown-item" href="/admin/cetak-pembayaran/'+data.id+'" >Cetak Bukti Pembayaran</a>'+
                        '</div> </div > ';
                    }else{
                        return '<div class="btn-group dropright"> ' +
                        '<a type="button" class="btn btn-default  dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">' +
                        data.nama_siswa+
                        '</a>' +
                        '<div class="dropdown-menu">'+
                            '<a class="dropdown-item" href="#" onclick=konfirmasi("' +data.id + '");>Konfirmasi Pembayaran</a>'+
                        '</div> </div > ';
                    }
                }
            },
            {
                "data": "keterangan"
            },
            {
                "data": "status_pembayaran"
            },
            {
                "data": null,
                "render": function(data) {
                    return "Rp. "+formatNumber(data.jumlah_tagihan);
                }
            },
            {
                "data": "tanggal_pembayaran"
            },
            {
                "data": null,
                "render": function(data) {
                    return "Rp. "+formatNumber(data.jumlah_pembayaran);
                }
            },
        ]
    });
});

function formatNumber(num) {
    return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
}

function rupiahCurrency() {
    var rupiah = document.getElementById('jumlah_pembayaran');
    var hasil = formatRupiah(rupiah.value, 'Rp. ');    
    $("#jumlah_pembayaran").val(hasil);
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
    $('#exampleModalCenterTitle').text('Tambah Pembayaran');
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
        url: "/admin/save-pembayaran",
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

function konfirmasi(id) {
    $.ajax({
        url: "/admin/get-pembayaran",
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
                $('#tanggal_pembayaran').val(res.tanggal_pembayaran);
                $('#jumlah_pembayaran').val(res.jumlah_pembayaran);

                $('#exampleModalCenterTitle').text('Edit Pembayaran');
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