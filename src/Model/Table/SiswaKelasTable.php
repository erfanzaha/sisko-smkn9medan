<?php

namespace App\Model\Table;

use App\Model\Entity\Kelas;
use Cake\ORM\Table;
use Cake\ORM\Query;


class SiswaKelasTable extends Table
{
    public function initialize(array $config): void
    {
        $this->setTable("siswa_kelas");        
    }

}