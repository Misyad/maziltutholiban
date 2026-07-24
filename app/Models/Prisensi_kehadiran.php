<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prisensi_kehadiran extends Model
{
    protected $table = 'prisensi_kehadiran';

    protected $fillable = [
        'id_event',
        'id_tanggal',
        'id_anggota',
        'id_user',
        'tanggal_kehadiran',
        'jam_kehadiran',
    ];
}
