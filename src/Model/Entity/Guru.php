<?php

namespace App\Model\Entity;

use Cake\ORM\Entity;

class Guru extends Entity
{
    protected $_accessible = [
        "id"            => true,
        "id_auth"       => true,
        "id_mapel"      => true,
        "nip"           => true,
        "nama_guru"     => true,
        "email"         => true,
        "gender"        => true,
        "tanggal_lahir" => true,
        "alamat"        => true,
        "agama"         => true,
        "status"        => true,
        "jabatan"       => true,
        "no_hp"         => true,
        "kategori"      => true,
        "created_at"    => true,
        "updated_at"    => true
    ];
}