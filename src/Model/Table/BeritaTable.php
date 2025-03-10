<?php

namespace App\Model\Table;

use Cake\ORM\Table;

class BeritaTable extends Table
{
    public function initialize(array $config): void
    {
        $this->setTable("berita");        
    }
}