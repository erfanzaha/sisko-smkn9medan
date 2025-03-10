<?php

namespace App\Model\Table;

use App\Model\Entity\Kelas;
use Cake\ORM\Table;
use Cake\ORM\Query;


class ProfilSekolahTable extends Table
{
    public function initialize(array $config): void
    {
        $this->setTable("profil_sekolah");
    }

}