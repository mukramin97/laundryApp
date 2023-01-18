<?php

namespace App\Http\Controllers;

Use App\Models\Order;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Inertia\Inertia;

class OrderController extends Controller
{
    public function index()
    {
        return Inertia::render('Order/Order', [
            'orders' => Order::paginate(15)->through(fn($order)=>[
                'id' => $order->id,
                'name' => $order->name,
                'weight' => $order->weight,
                'status' => $order->status,
                'branch' => $order->branch,
                'category' => $order->category,
                'user' => $order->user,
                'date_placed' => $order->date_placed,
                'date_completed' => $order->date_completed,
            ]),
        ]);
    }
}
