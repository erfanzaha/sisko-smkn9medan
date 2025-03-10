<?php

namespace App\Model\Table;

use Cake\ORM\Table;

class OrangTuaTable extends Table
{
    public function initialize(array $config): void
    {
        $this->setTable("orang_tua");
    }
}