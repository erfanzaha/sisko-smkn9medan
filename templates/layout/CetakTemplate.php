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
    <style>
    *{
        padding:0;
        margin:0;
    }
    table {
        border: dashed 1px;
        width: 100%;
    }
    img{
        width:60px;
    }
    h4{
        padding:5px 0px 5px 0px;
    }
    </style>
</head>

<body onload="window.print()">
    <?php
    echo $this->Flash->render();
    echo $this->fetch('content'); 
    ?>
</body>

</html>