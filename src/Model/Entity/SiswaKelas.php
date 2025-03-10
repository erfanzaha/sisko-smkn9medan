<?php

namespace App\Model\Entity;

use Cake\ORM\Entity;

class SiswaKelas extends Entity
{
    protected $_accessible = [
        "id"         => true,
        "id_kelas"   => true,
        "id_siswa"   => true,        
        "created_at" => true,
        "updated_at" => true
    ];
}