<?php

namespace App\Http\Controllers;

use App\Models\Branch;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Inertia\Inertia;
use Carbon\Carbon;

class BranchController extends Controller
{
    public function index()
    {

        $branchs = Branch::all();

        return Inertia::render('Branch/Branch', [
            'branchs' => $branchs,
        ]);
    }

    public function create()
    {
        return Inertia::render('Branch/Create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'branch_name' => 'required|max:100|min:3',
            'phone_number' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
        ]);

        $currentDateTime = Carbon::now();
        $dateOnly = $currentDateTime->format('Y-m-d');

        Branch::create([
            'branch_name' => $request->branch_name,
            'phone_number' => $request->phone_number,
            'established' => $dateOnly,
        ]);

        return Redirect::route('branch.index')->with('success', 'Branch data added successfully!');
    }

    public function edit($id)
    {
        $branch = Branch::find($id);

        return Inertia::render('Branch/Edit', [
            'branch' => $branch,
            'employees' => $branch->employee()->orderBy('name')->get()->map->only('id', 'name', 'email'),
        ]);

    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'branch_name' => 'required|max:100|min:3',
            'phone_number' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
        ]);

        $branch = Branch::find($id);

        $branch->branch_name = $request->branch_name;
        $branch->phone_number = $request->phone_number;
        $branch->save();
        
        return Redirect::route('branch.index')->with('success', 'Branch data updated successfully!');
    }
}
