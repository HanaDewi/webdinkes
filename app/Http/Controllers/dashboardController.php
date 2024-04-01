<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

class dashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.dashboard');
    }
}
