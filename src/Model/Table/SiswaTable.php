<?php

namespace App\Model\Table;

use Cake\ORM\Table;

class SiswaTable extends Table
{
    public function initialize(array $config): void
    {
        $this->setTable("siswa");
        $this->hasOne('SiswaKelas', [
            'foreignKey' => 'id_siswa',
            'joinType' => 'LEFT'
        ]);
    }
}