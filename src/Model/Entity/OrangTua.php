<?php

namespace App\Model\Entity;

use Cake\ORM\Entity;

class OrangTua extends Entity
{
    protected $_accessible = [
        "id"                 => true,
        "id_auth"            => true,
        "id_siswa"           => true,
        "nama_ayah"          => true,
        "email_ayah"         => true,
        "tanggal_lahir_ayah" => true,
        "agama_ayah"         => true,
        "pekerjaan_ayah"     => true,
        "no_hp_ayah"         => true,
        "nama_ibu"           => true,
        "email_ibu"          => true,
        "tanggal_lahir_ibu"  => true,
        "agama_ibu"          => true,
        "pekerjaan_ibu"      => true,
        "no_hp_ibu"          => true,
        "alamat"             => true,
        "created_at"         => true,
        "updated_at"         => true
    ];
}