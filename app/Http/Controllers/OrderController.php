<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Inertia\Inertia;
use PDO;

class OrderController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        return Inertia::render('Order/Order', [
            'orders' => Order::where('branch_id', $user->id)
                ->orderByRaw("IFNULL(date_completed, '9999-12-31') DESC")
                ->orderBy('date_placed', 'asc')
                ->paginate(15)
                ->through(fn ($order) => [
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

    public function create()
    {
        $categories = Category::all();

        return Inertia::render('Order/Create', [
            'categories' => $categories
        ]);
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name' => [
                'required',
                'max:100',
                'min:3',
            ],
            'category_id' => [
                'required',
            ],
            'weight' => [
                'required'
            ]
        ]);

        $now = Carbon::now();

        Order::create([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'weight' => $request->weight,
            'date_placed' => $now,
            'status' => 'Proses',
            'user_id' => $user->id,
            'branch_id' => $user->branch_id,
        ]);

        return Redirect::route('order.index')->with('success', $request->name . ' order created successfully!');
    }

    public function edit($id, Request $request)
    {
        $getCost = floatval($request->getCost);
        $order = Order::find($id);
        $categories = Category::all();

        return Inertia::render('Order/Edit', [
            'order' => $order,
            'categories' => $categories,
            'getCost' => $getCost,
        ]);
    }

    public function update($id, Request $request)
    {
        $user = Auth::user();
        $order = Order::find($id);

        $validated = $request->validate([
            'name' => [
                'required',
                'max:100',
                'min:3',
            ],
            'category_id' => [
                'required',
            ],
            'weight' => [
                'required'
            ]
        ]);

        $now = Carbon::now();

        $order->name = $request->name;
        $order->category_id = $request->category_id;
        $order->weight = $request->weight;
        $order->save();

        return Redirect::route('order.index')->with('success', $request->name . ' order updated successfully!');
    }
}
