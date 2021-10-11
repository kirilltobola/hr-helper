<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminUsersController extends Controller
{

    public function index()
    {
        return view(
            'admin.auth.index',
            [
                'users' => User::all(),
                'attributes' => ['id', 'name', 'email', 'is_admin'],
            ]
        );
    }

    public function create()
    {
        return view(
            'admin.auth.create',
            [
                'attributes' => ['name', 'email', 'is_admin']
            ]
        );
    }

    public function store(Request $request)
    {
        User::create($request->except('_token'));
        return redirect()->route('admin.users.index');
    }

    public function show(User $user)
    {
        return '$user';
    }

    public function edit(User $user)
    {
        return view('admin.auth.edit',
            [
                'attributes' => ['name', 'email', 'is_admin'],
                'user' => $user,
            ]
        );
    }

    public function update(Request $request, User $user)
    {
        $user->update($request->except('_token'));
        return redirect()->route('admin.users.index');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index');
    }
}
