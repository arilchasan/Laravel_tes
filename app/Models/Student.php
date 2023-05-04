<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'umur',
        'description',
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    protected $table = 'students';
}
