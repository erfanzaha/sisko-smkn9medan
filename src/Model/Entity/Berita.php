<?php

namespace App\Model\Entity;

use Cake\ORM\Entity;

class Berita extends Entity
{
    protected $_accessible = [
        "id"         => true,
        "title"      => true,
        "tanggal"    => true,
        "isi_berita" => true,
        "admin"      => true,
        "gambar"     => true,
        "created_at" => true,
        "updated_at" => true
    ];
}