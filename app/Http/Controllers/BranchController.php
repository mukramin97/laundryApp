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
            'branch_name' => [
                'required',
                'max:100',
                'min:3',
                'unique:branchs,branch_name'
            ],
            'phone_number' => [
                'required',
                'regex:/^([0-9\s\-\+\(\)]*)$/',
                'min:10'
            ],
        ]);

        $currentDateTime = Carbon::now();
        $dateOnly = $currentDateTime->format('Y-m-d');

        Branch::create([
            'branch_name' => $request->branch_name,
            'phone_number' => $request->phone_number,
            'established' => $dateOnly,
        ]);

        return Redirect::route('branch.index')->with('success', $request->branch_name . ' Branch created successfully!');
    }

    public function edit($id)
    {
        $branch = Branch::find($id);

        return Inertia::render('Branch/Edit', [
            'branch' => $branch,
            'users' => $branch->user()->orderBy('name')->get()->map->only('id', 'name', 'email'),
        ]);
    }

    public function update(Request $request, $id)
    {
        $branch = Branch::find($id);

        $validated = $request->validate([
            'branch_name' => [
                'required',
                'max:100',
                'min:3',
                Rule::unique('branchs')->ignore($branch)
            ],
            'phone_number' => [
                'required',
                'regex:/^([0-9\s\-\+\(\)]*)$/',
                'min:10'
            ],
        ]);

        $branch->branch_name = $request->branch_name;
        $branch->phone_number = $request->phone_number;
        $branch->save();

        return Redirect::route('branch.index')->with('success', $request->branch_name . ' Branch updated successfully!');
    }

    public function destroy($id)
    {
        $branch = Branch::findOrFail($id);
        $branch->delete();

        return Redirect::route('branch.index')->with('success', $branch->branch_name . ' deleted successfully!');
    }
}
