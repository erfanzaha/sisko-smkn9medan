<?php

namespace App\Model\Table;

use Cake\ORM\Table;

class JadwalPembayaranTable extends Table
{
    public function initialize(array $config): void
    {
        $this->setTable("jadwal_pembayaran");
    }
}