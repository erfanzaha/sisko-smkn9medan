<?php

namespace App\Model\Entity;

use Cake\ORM\Entity;

class MataPelajaran extends Entity
{
    protected $_accessible = [
        "id"            => true,
        "mata_pelajaran"    => true,
        "created_at"        => true,
        "updated_at"        => true
    ];
}