<?php

namespace App\Model\Entity;

use Cake\ORM\Entity;

class WaliKelas extends Entity
{
    protected $_accessible = [
        "id"                 => true,
        "id_kelas"           => true,
        "id_guru"            => true,
        "id_tahun_ajaran"    => true,
        "created_at"         => true,
        "updated_at"         => true
    ];
}