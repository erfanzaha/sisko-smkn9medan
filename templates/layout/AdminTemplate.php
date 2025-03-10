<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 * @var \App\View\AppView $this
 */
?>
<!DOCTYPE html>
<html>

<head>
    <?= $this->Html->charset() ?>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        <?= $cakeDescription = "Sistem Informasi Sekolah"; ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <?= $this->Html->css(['admin/css/app.min.css','admin/css/dataTables.bootstrap.min.css','admin/css/buttons.bootstrap4.min.css','admin/css/dataTables.bootstrap4.min.css']) ?>
    <style>
    .swal-text {
        text-align: center
    }
    </style>
</head>

<body>
    <div class="app">
        <div class="layout">
            <?php
            echo $this->element('Admin/header');
            echo $this->element('Admin/sidebar');
            ?>
            <!-- Page Container START -->
            <div class="page-container">
                <!-- Content Wrapper START -->
                <div class="main-content">
                    <?php
                        echo $this->element('Admin/breadcum');
                        echo $this->Flash->render();
                        echo $this->fetch('content'); 
                    ?>
                </div>
                <!-- Content Wrapper END -->
                <!-- Footer START -->
                <?= $this->element('Admin/footer'); ?>
                <!-- Footer END -->
            </div>
            <!-- Page Container END -->
        </div>
    </div>
    <?php 
        echo $this->Html->script([ "admin/js/vendors.min.js",
        "admin/js/app.min.js",
        "admin/js/sweetalert.min.js",
        "admin/vendors/datatables/jquery.dataTables.min.js",
        "admin/vendors/datatables/dataTables.bootstrap.min.js",
        "admin/vendors/datatables/dataTables.buttons.min.js",
        "admin/vendors/datatables/buttons.html5.min.js",
        "admin/vendors/datatables/jszip.min.js",
        "admin/vendors/datatables/pdfmake.min.js",
        "admin/vendors/datatables/vfs_fonts.js",
        "admin/vendors/ckeditor/ckeditor.js"]);
        echo $this->element('Admin/js'); 
    ?>
    <script>
    <?php if($level == "admin"): ?>
    $(document).ready(function() {
        let timerId = setTimeout(function tick() {
            <?php 
            $tgl1 = new DateTime(date('d-m-Y'));  
            
            foreach ($jadwalPembayaran as $key => $value) : 
                $tgl2 = new DateTime($value->tanggal_jatuh_tempo);
                $d    = $tgl2->diff($tgl1)->days + 1;
                if($d <= 7):
            ?>
            $.ajax({
                url: "/admin/send-mail-dashboard",
                contentType: false,
                cache: false,
                processData: false,
            });
            <?php endif; endforeach; ?>
            timerId = setTimeout(tick, 86400000);
        }, 86400000);
    });
    <?php endif; ?>

    function keluar() {
        swal({
            title: "Peringatan",
            icon: "warning",
            text: "Apakah anda yakin ingin keluar ?",
            dangerMode: true,
            buttons: {
                cancel: "Batal",
                confirm: "Keluar",
            }
        }).then((ok) => {
            if (ok) {
                $.ajax({
                    url: "/auth/logout",
                    type: "POST",
                    dataType: "JSON",
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
                            window.location.href = "/";
                        });
                    }
                });
            } else {
                swal({
                    title: "Dibatalkan",
                    text: "Batal keluar",
                    icon: "info"
                });
            }
        });
    }
    </script>
</body>

</html>