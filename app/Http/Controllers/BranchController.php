<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Inertia\Inertia;
use App\Models\Branch;

class BranchController extends Controller
{
    public function index()
    {

        $branchs = Branch::all();

        return Inertia::render('Branch/Branch', [
            'branchs' => $branchs,
        ]);
    }
}
