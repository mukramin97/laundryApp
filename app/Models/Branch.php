<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory;

    protected $table = 'branchs';

    protected $fillable = [
        'branch_name',
        'phone_number',
        'owner_id',
    ];

    public function owner(){
        return $this->belongsTo(Owner::class);
    }

    //

    public function employee(){
        return $this->hasMany(Employee::class);
    }

    public function order(){
        return $this->hasMany(Order::class);
    }

}
