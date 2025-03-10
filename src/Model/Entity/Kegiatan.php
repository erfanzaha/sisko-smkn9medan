<?php

namespace App\Model\Entity;

use Cake\ORM\Entity;

class Kegiatan extends Entity
{
    protected $_accessible = [
        "id"            => true,
        "gambar"        => true,
        "keterangan"    => true,
        "tanggal"       => true,
        "created_at"    => true,
        "updated_at"    => true
    ];
}