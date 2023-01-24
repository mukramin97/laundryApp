<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Payment;
use Carbon\Carbon;

use Illuminate\Http\Request;

use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $month = $request->input('month');
        $year = $request->input('year');

        //$year = Carbon::now()->year -1; if u want to get last year, change null below with $year
        $start_of_month = Carbon::createFromDate($year, $month, 1)->startOfMonth();
        $end_of_month = Carbon::createFromDate($year, $month, 1)->endOfMonth();
        $totalOrder = Order::whereBetween('date_placed', [$start_of_month, $end_of_month])->count();
        $totalPayment = Payment::whereBetween('date_payment', [$start_of_month, $end_of_month])->count();
        $totalGross = floatval(Payment::whereBetween('date_payment', [$start_of_month, $end_of_month])->sum('amount_paid'));
        $estimatedActual = floatval(Payment::selectRaw('SUM(amount_paid - cost) as difference')
            ->whereBetween('date_payment', [$start_of_month, $end_of_month])
            ->first()
            ->difference);

        if ($request->input('month')) {
            $s_month = intval($month);
            $s_year = intval($year);
        }
        else{
            $s_month = Carbon::now()->month;
            $s_year = Carbon::now()->year;
        }

        return Inertia::render('Dashboard/Home', [
            'totalOrder' => $totalOrder,
            'totalGross' => $totalGross,
            'totalPayment' => $totalPayment,
            'estimatedActual' => $estimatedActual,
            's_month' => $s_month,
            's_year' => $s_year,
        ]);
    }
}
