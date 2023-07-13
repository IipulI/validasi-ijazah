<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Mahasiswa extends Model
{
    use HasFactory;

    protected $table='mahasiswa';

    public function fakultas() : HasOne {
        return $this->hasOne(Fakultas::class, 'id_fakultas', 'id_fakultas');
    }

    public function prodi() : HasOne {
        return $this->hasOne(ProgramStudi::class, 'id_program_studi', 'id_prodi');
    }

    public function ijazah() : BelongsTo {
        return $this->belongsTo(Ijazah::class, 'npm', 'npm');
    }
}
