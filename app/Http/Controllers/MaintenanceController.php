<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MaintenanceController extends Controller
{
    public function index()
    {
        return view('Pages.Maintenance');
    }

    public function profile()
    {
        return view('Pages.Profile');
    }
}
