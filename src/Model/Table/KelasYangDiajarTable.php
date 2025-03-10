<?php

namespace App\Model\Table;

use App\Model\Entity\Kelas;
use Cake\ORM\Table;
use Cake\ORM\Query;


class KelasYangDiajarTable extends Table
{
    public function initialize(array $config): void
    {
        $this->setTable("kelas_yang_diajar");
    }

}