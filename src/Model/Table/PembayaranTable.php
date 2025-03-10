<?php

namespace App\Model\Table;

use Cake\ORM\Table;

class PembayaranTable extends Table
{
    public function initialize(array $config): void
    {
        $this->setTable("pembayaran");
    }
}