<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\ORM\Query;


class TahunAjaranTable extends Table
{
    public function initialize(array $config): void
    {
        $this->setTable("tahun_ajaran");
    }

}