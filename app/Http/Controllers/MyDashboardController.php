<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MyDashboardController extends Controller
{
    public function __invoke(Request $request)
    {
        $user = $request->user();

        return (strtolower($user->role ?? '') === 'admin')
            ? redirect()->route('admin.dashboard')
            : redirect()->route('user.dashboard'); // your existing user page
    }
}
