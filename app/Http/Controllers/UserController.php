<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Branch;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Carbon\Carbon;


class UserController extends Controller
{
    public function create($branch_id_s, $branch_name)
    {
        $branch_id = intval($branch_id_s);
        $branchs = Branch::all();

        return Inertia::render('User/Create', [
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
                'unique:users,email'
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

        User::create([
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

        $user = User::find($id);
        $branchs = Branch::all();

        return Inertia::render('User/Edit', [
            'branchs' => $branchs,
            'user' => $user,
        ]);
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);

        $validated = $request->validate([
            'name' => [
                'required',
                'max:100',
                'min:3'
            ],
            'email' => [
                'required',
                Rule::unique('users')->ignore($user)
            ],
            'password' => [
                'min:8',
                'max:50'
            ],
            'branch_id' => [
                'required'
            ],
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->branch_id = $request->branch_id;
        $user->save();

        $strbranch_id = strval($request->branch_id);

        return Redirect::route('branch.edit', $strbranch_id)->with('success', $request->name . ' data updated successfully!');
    }
}