<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Branch;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Carbon\Carbon;

class EmployeeController extends Controller
{
    public function create($branch_id_s, $branch_name)
    {
        $branch_id = intval($branch_id_s);

        return Inertia::render('Employee/Create', [
            'branch_id' => $branch_id,
            'branch_name' => $branch_name,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:100|min:3',
            'email' => 'required',
            'password' => 'required',
            'branch_id' => 'required',
        ]);

        $currentDateTime = Carbon::now();
        $dateOnly = $currentDateTime->format('Y-m-d');

        Employee::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'remember_token' => Str::random(60),
            'branch_id' => $request->branch_id,
            
        ]);

        return Redirect::route('branch.index')->with('success', 'Employee data added successfully!');
    }
}
