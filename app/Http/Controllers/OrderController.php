<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Category;
use App\Models\Payment;


use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Inertia\Inertia;

class OrderController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        return Inertia::render('Order/Order', [
            'orders' => Order::with(['category' => function ($query) {
                $query->withTrashed();
            }])->where('branch_id', $user->branch_id)
                ->orderBy('status', 'DESC')
                ->orderBy('date_completed', 'ASC')
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
        $duration = Category::where('id', $request->category_id)->value('duration');

        Order::create([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'weight' => $request->weight,
            'date_placed' => $now,
            'date_completed' => Carbon::parse($now)->addHour($duration),
            'status' => 'In Progress',
            'user_id' => $user->id,
            'branch_id' => $user->branch_id,
        ]);

        return Redirect::route('order.index')->with('success', $request->name . ' order created successfully!');
    }

    public function edit($id)
    {
        $order = Order::with(['user' => function ($query) {
            $query->withTrashed();
        }])->with(['category' => function ($query) {
            $query->withTrashed();
        }])->where('id', $id)->first();
        $categories = Category::all();

        $paymentData = Payment::where('order_id', $order->id)->with(['user' => function ($query) {
            $query->withTrashed();
        }])->first();

        if ($paymentData === null) {
            $paymentData = null;
        } else {
            $paymentData = [
                'id' => $paymentData->id,
                'method' => $paymentData->method,
                'cost' => $paymentData->cost,
                'amount_paid' => $paymentData->amount_paid,
                'date_payment' => $paymentData->date_payment,
                'user' => $paymentData->user
            ];
        }

        return Inertia::render('Order/Edit', [
            'order' => $order,
            'categories' => $categories,
            'payment' => $paymentData,
        ]);
    }

    public function update($id, Request $request)
    {
        $user = Auth::user();
        $order = Order::find($id);

        if ($order->status == "Collected") {
            return redirect()->back()->with('error', 'Order completed, order data cannot be changed!');
        }

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

        if ($request->amount_paid) {
            Payment::create([
                'cost' => $request->cost,
                'amount_paid' => $request->amount_paid,
                'date_payment' => $now,
                'order_id' => $order->id,
                'user_id' => $user->id,
            ]);

            $order->status = 'Collected';
            $order->date_completed = $now;
            $order->save();

            return Redirect::route('order.index')->with('success', $request->name . ' order payment successfully!');
        } else if ($user->id === $order->user_id or $user->is_superadmin == true) {
            $order->name = $request->name;
            $order->category_id = $request->category_id;
            $order->user_id = $user->id;
            $order->weight = $request->weight;
            $order->save();

            return Redirect::route('order.index')->with('success', $request->name . ' order updated successfully!');
        } else {
            return redirect()->back()->with('error', 'Order cannot be changed exclude by person who handled it!');
        }
    }

    public function updatepayment($id, Request $request)
    {
        $payment = Payment::find($id);

        $validated = $request->validate([
            'amount_paid' => [
                'required',
            ]
        ]);

        $payment->amount_paid = $request->amount_paid;
        $payment->save();

        return redirect()->back()->with('success', 'Payment updated successfully!');
    }

    public function destroy($id)
    {
        $user = Auth::user();

        $order = Order::findOrFail($id);
        $order->delete();

        return Redirect::route('order.index')->with('success', $order->name . ' order deleted successfully!');
    }

    public function destroypayment($id)
    {
        $user = Auth::user();

        $payment = Payment::findOrFail($id);
        $order = Order::where('id', $payment->order_id)->first();
        $order->status = "Completed";
        $order->save();
        $payment->delete();

        return redirect()->back()->with('success', 'Payment order deleted successfully!');
    }
}
