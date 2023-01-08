<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    protected $fillable = [
        'nama',
        'item',
        'weight',
        'status',
        'branch_id',
        'category_id',
        'employee_id',
        'date_placed',
        'date_completed',
    ];

    public function branch(){
        return $this->belongsTo(Branch::class);
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function employee(){
        return $this->belongsTo(Employee::class);
    }

    //

    public function payment(){
        return $this->hasMany(Payment::class);
    }

}
