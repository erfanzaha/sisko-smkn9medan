<?php

namespace App\Model\Entity;

use Cake\ORM\Entity;

class ProfilSekolah extends Entity
{
    protected $_accessible = [
        "id"         => true,
        "tipe"       => true,
        "title"      => true,
        "deskripsi"  => true,
        "created_at" => true,
        "updated_at" => true
    ];
}