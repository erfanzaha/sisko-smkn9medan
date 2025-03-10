<?php

namespace App\Model\Entity;

use Cake\ORM\Entity;

class TahunAjaran extends Entity
{
    protected $_accessible = [
        "id"            => true,
        "tahun_ajaran " => true,
        "created_at"    => true,
        "updated_at"    => true
    ];
}