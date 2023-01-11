<?php

namespace App\Http\Controllers;

use App\Models\Branch;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class BranchController extends Controller
{
    public function index()
    {

        $branchs = Branch::all();

        return Inertia::render('Branch/Branch', [
            'branchs' => $branchs,
        ]);
    }

    public function edit($id)
    {
        $branch = Branch::find($id);

        return Inertia::render('Branch/Edit', [
            'branch' => $branch
        ]);

    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'branch_name' => 'required|max:100',
            'phone_number' => 'required',
        ]);

        $branch = Branch::find($id);

        $branch->branch_name = $request->branch_name;
        $branch->phone_number = $request->phone_number;
        $branch->save();
        
        return Redirect::route('branch.index')->with('success', 'Branch data updated successfully!');
    }
}
