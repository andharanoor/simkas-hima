<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user->role == 'bendahara') {
            return view('dashboard.bendahara');
        }

        if ($user->role == 'ketua') {
            return view('dashboard.ketua');
        }

        if ($user->role == 'anggota') {
            return view('dashboard.anggota');
        }

        abort(403);
    }
}