<?php

namespace App\Http\Controllers\System;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['role_or_permission:sudo|user list'])->only('index');
        $this->middleware(['role_or_permission:sudo|user update'])->only('edit');
    }

    public function index()
    {
        return view('system.users.index');
    }

    public function edit(User $user)
    {
        return view('system.users.edit', compact('user'));
    }
}
