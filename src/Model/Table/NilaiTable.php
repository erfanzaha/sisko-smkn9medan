<?php

namespace App\Model\Table;

use Cake\ORM\Table;

class NilaiTable extends Table
{
    public function initialize(array $config): void
    {
        $this->setTable("nilai");
    }
}