<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PromosiController extends Controller
{
    public function index(){

        return view('dashboard.promosi.index');
    }
}
