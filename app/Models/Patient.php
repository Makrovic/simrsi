<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $table = 'patients';
    protected $fillable = [
        'nama_pasien',
        'jenis_kelamin',
        'tgl_lahir_pasien',
        'alamat_pasien',
    ];
    protected $casts = [
        'tgl_lahir_pasien' => 'date',
    ];
}
