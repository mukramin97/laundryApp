<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Member extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'members';

    protected $fillable = [
        'nama',
        'phone_number',
    ];
}
