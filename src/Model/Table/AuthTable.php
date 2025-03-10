<?php

namespace App\Model\Table;

use Cake\ORM\Table;

class AuthTable extends Table
{
    public function initialize(array $config): void
    {
        $this->setTable("auth");
        $this->hasOne('Guru', [
                        'foreignKey' => 'id_auth',
                        'joinType' => 'INNER'
                    ]);
        $this->hasOne('Admin', [
                        'foreignKey' => 'id_auth',
                        'joinType' => 'INNER'
                    ]);
        $this->hasOne('Siswa', [
                        'foreignKey' => 'id_auth',
                        'joinType' => 'INNER'
                    ]);
    }
}