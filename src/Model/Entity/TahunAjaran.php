<?php

namespace App\Model\Entity;

use Cake\ORM\Entity;

class Kelas extends Entity
{
    protected $_accessible = [
        "id"            => true,
        "tingkat "      => true,
        "kelas  "       => true,
        "created_at"    => true,
        "updated_at"    => true
    ];
}