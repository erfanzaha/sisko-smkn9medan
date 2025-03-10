<?php

namespace App\Model\Entity;

use Cake\ORM\Entity;

class Admin extends Entity
{
    protected $_accessible = [
        "id"            => true,
        "id_auth"       => true,
        "nama_admin"    => true,
        "email"         => true,
        "created_at"    => true,
        "updated_at"    => true
    ];
}