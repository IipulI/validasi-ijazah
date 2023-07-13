<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Ijazah extends Model
{
    use HasFactory;

    protected $table='ijazah';

    public $timestamps = false;

    public function mahasiswa() : HasOne {
        return $this->hasOne(Mahasiswa::class,'npm', 'npm');
    }

    public function fakultas() : HasOne {
        return $this->hasOne(Fakultas::class, 'id_fakultas', 'id_fakultas');
    }

    public function rektor() : HasOne {
        return $this->hasOne(Rektor::class, 'id_rektor', 'id_rektor');
    }
}
