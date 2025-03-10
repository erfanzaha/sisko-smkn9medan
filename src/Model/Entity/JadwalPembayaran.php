<?php

namespace App\Model\Entity;

use Cake\ORM\Entity;

class JadwalPembayaran extends Entity
{
    protected $_accessible = [
        "id"                    => true,
        "keterangan"            => true,
        "tanggal_jatuh_tempo"   => true,
        "jumlah_tagihan"        => true,        
        "created_at"            => true,
        "updated_at"            => true
    ];
}