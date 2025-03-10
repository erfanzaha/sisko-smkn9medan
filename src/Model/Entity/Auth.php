<?php

namespace App\Model\Entity;

use Cake\ORM\Entity;

class Auth extends Entity
{
    protected $_accessible = [
        "id"         => true,
        "username"   => true,
        "password"   => true,
        "level"      => true,
        "created_at" => true,
        "updated_at" => true
    ];
}