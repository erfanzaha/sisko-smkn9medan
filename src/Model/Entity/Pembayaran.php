<?php

namespace App\Model\Entity;

use Cake\ORM\Entity;

class Pembayaran extends Entity
{
    protected $_accessible = [
        "id"                    => true,
        "id_jadwal_pembayaran"  => true,
        "id_siswa"              => true,
        "status_pembayaran"     => true,
        "jumlah_pembayaran"     => true,
        "tanggal_pembayaran"    => true,
        "status_kembalian"      => true,
        "created_at"            => true,
        "updated_at"            => true
    ];
}