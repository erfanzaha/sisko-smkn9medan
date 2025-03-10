<?php

namespace App\Model\Table;

use Cake\ORM\Table;

class MataPelajaranTable extends Table
{
    public function initialize(array $config): void
    {
        $this->setTable("mata_pelajaran");
    }
}