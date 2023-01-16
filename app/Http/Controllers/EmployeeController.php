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
use Alert;


class EmployeeController extends Controller
{
    public function create($branch_id_s, $branch_name)
    {
        $branch_id = intval($branch_id_s);
        $branchs = Branch::all();

        return Inertia::render('Employee/Create', [
            'branch_id' => $branch_id,
            'branch_name' => $branch_name,
            'branchs' => $branchs,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'max:100',
                'min:3'
            ],
            'email' => [
                'required',
                'unique:employees,email'
            ],
            'password' => [
                'required',
                'min:8',
                'max:50'
            ],
            'branch_id' => [
                'required'
            ],
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

        $strbranch_id = strval($request->branch_id);

        return Redirect::route('branch.edit', $strbranch_id)->with('success', $request->name . ' data created successfully!');
    }

    public function edit($id)
    {

        $employee = Employee::find($id);
        $branchs = Branch::all();

        return Inertia::render('Employee/Edit', [
            'branchs' => $branchs,
            'employee' => $employee,
        ]);
    }

    public function update(Request $request, $id)
    {
        $employee = Employee::find($id);

        $validated = $request->validate([
            'name' => [
                'required',
                'max:100',
                'min:3'
            ],
            'email' => [
                'required',
                Rule::unique('employees')->ignore($employee)
            ],
            'password' => [
                'min:8',
                'max:50'
            ],
            'branch_id' => [
                'required'
            ],
        ]);

        $employee->name = $request->name;
        $employee->email = $request->email;
        $employee->password = bcrypt($request->password);
        $employee->branch_id = $request->branch_id;
        $employee->save();

        $strbranch_id = strval($request->branch_id);

        return Redirect::route('branch.edit', $strbranch_id)->with('success', $request->name . ' data updated successfully!');
    }
}