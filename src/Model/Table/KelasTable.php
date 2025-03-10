<?php

namespace App\Model\Table;

use App\Model\Entity\Kelas;
use Cake\ORM\Table;
use Cake\ORM\Query;


class KelasTable extends Table
{
    public function initialize(array $config): void
    {
        $this->setTable("kelas");
        $this->hasOne('WaliKelas', [
                    'foreignKey' => 'id_kelas',
                    'joinType' => 'LEFT'
                ]);        
        $this->hasOne('SiswaKelas', [
                    'foreignKey' => 'id_kelas',
                    'joinType' => 'LEFT'
                ]);
    }

}