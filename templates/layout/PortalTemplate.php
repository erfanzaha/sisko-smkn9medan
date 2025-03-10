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
    
    <?= $this->Html->css(['portal/css/bootstrap.min', 'portal/css/style.css', 'portal/css/responsive.css']) ?>
</head>

<body>
    <div class="wrapper">
        <div class="preloader"></div>
        <?php
        echo $this->element('Portal/header');
        echo $this->Flash->render();
        echo $this->fetch('content');
        echo $this->element('portal/footer');
        ?>
        <a class="scrollToHome home3" href="#"><i class="flaticon-up-arrow-1"></i></a>
    </div>
    <?= $this->Html->script([ "portal/js/jquery-3.3.1.js",
    "portal/js/jquery-migrate-3.0.0.min.js",
    "portal/js/popper.min.js",
    "portal/js/bootstrap.min.js",
    "portal/js/jquery.mmenu.all.js",
    "portal/js/ace-responsive-menu.js",
    "portal/js/bootstrap-select.min.js",
    "portal/js/isotop.js",
    "portal/js/snackbar.min.js",
    "portal/js/simplebar.js",
    "portal/js/parallax.js",
    "portal/js/scrollto.js",
    "portal/js/jquery-scrolltofixed-min.js",
    "portal/js/jquery.counterup.js",
    "portal/js/wow.min.js",
    "portal/js/progressbar.js",
    "portal/js/slider.js",
    "portal/js/timepicker.js",
    "portal/js/script.js"]) ?>
</body>

</html>