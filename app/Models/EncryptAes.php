<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EncryptAes extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'nama_file',
        'enkrip_file',
        'enkrip_key',
        'description',
    ];
}
