<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $table = 'payments';

    protected $fillable = [
        'method',
        'amount',
        'date_payment',
        'order_id',
        'employee_id',
    ];

    public function order(){
        return $this->belongsTo(Order::class);
    }

    public function employee(){
        return $this->belongsTo(Employee::class);
    }
}
