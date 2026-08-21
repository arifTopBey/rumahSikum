<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EventOrganizer;
use Illuminate\Http\Request;

class DaftarPesertaController extends Controller
{
    public function index(){

         $elearning = EventOrganizer::orderByDesc('id')->paginate(10);

        return view('admin.peserta.index', compact('elearning'));
    }
}
