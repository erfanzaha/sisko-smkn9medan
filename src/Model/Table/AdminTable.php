<?php

namespace App\Model\Table;

use Cake\ORM\Table;

class AdminTable extends Table
{
    public function initialize(array $config): void
    {
        $this->setTable("admin");        
    }
}