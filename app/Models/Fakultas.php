<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Fakultas extends Model
{
    use HasFactory;

    protected $table = 'fakultas';

    public function prodi() : HasMany {
        return $this->hasMany(ProgramStudi::class, 'id_fakultas', 'id_fakultas');
    }
}
