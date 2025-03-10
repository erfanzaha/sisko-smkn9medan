<?php

namespace App\Model\Entity;

use Cake\ORM\Entity;

class Siswa extends Entity
{
    protected $_accessible = [
        "id"            => true,
        "id_auth"       => true,
        "nisn"          => true,
        "nama_siswa"    => true,
        "email"         => true,
        "gender"        => true,
        "tanggal_lahir" => true,
        "alamat"        => true,
        "agama"         => true,
        "jumlah_saudara"=> true,
        "no_hp"         => true,
        "created_at"    => true,
        "updated_at"    => true
    ];
}