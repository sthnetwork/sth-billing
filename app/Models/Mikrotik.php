<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mikrotik extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama', 'ip_address', 'port_api', 'username', 'password', 'koneksi', 'catatan', 'status'
    ];
}
