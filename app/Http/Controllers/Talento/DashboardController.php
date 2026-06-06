<?php

namespace App\Http\Controllers\Talento;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('talento.dashboard');
    }
}
