<?php

namespace App\Model\Table;

use Cake\ORM\Table;

class GuruTable extends Table
{
    public function initialize(array $config): void
    {
        $this->setTable("guru");
    }
}