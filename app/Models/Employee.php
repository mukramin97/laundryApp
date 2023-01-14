<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $table = 'employees';

    protected $fillable = [
        'name',
        'email',
        'password',
        'branch_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function branch(){
        return $this->belongsTo(Branch::class);
    }

    //

    public function order(){
        return $this->hasMany(Order::class);
    }

    public function payment(){
        return $this->hasMany(Payment::class);
    }

}
