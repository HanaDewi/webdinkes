<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SinikimasController extends Controller
{
    public function sinikimas()
    {
        // Logika untuk menampilkan halaman "Sinikimas"
        return view('sinikimas.sinikimas');
    }
}
