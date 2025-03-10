<?php

namespace App\Model\Table;

use Cake\ORM\Table;

class KegiatanTable extends Table
{
    public function initialize(array $config): void
    {
        $this->setTable("kegiatan");        
    }
}