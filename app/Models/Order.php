<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    protected $fillable = [
        'name',
        'item',
        'weight',
        'status',
        'branch_id',
        'category_id',
        'user_id',
        'date_placed',
        'date_completed',
    ];

    public function branch(){
        return $this->belongsTo(Branch::class);
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    //

    public function payment(){
        return $this->hasMany(Payment::class);
    }

}
