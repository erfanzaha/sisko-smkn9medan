<?php

namespace App\Model\Table;

use Cake\ORM\Table;

class WaliKelasTable extends Table
{
    public function initialize(array $config): void
    {
        $this->setTable("wali_kelas");
        $this->hasOne('Guru', [
                        'foreignKey' => 'id_guru',
                        'joinType' => 'LEFT'
                    ]);
    }
}