<?php

namespace App\Model\Entity;

use Cake\ORM\Entity;

class Nilai extends Entity
{
    protected $_accessible = [
        "id"                => true,
        "id_mapel"          => true,
        "id_guru"           => true,
        "id_kelas"          => true,
        "id_siswa"          => true,
        "nilai_tugas"       => true,
        "nilai_mid"         => true,
        "nilai_uas"         => true,
        "id_tahun_ajaran"   => true,
        "created_at"        => true,
        "updated_at"        => true
    ];
}