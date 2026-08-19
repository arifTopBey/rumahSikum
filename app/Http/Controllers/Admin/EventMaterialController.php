<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EventMaterial;
use Illuminate\Http\Request;

class EventMaterialController extends Controller
{
    public function index($id){

        $materi = EventMaterial::where('event_organizer_id', $id)->first();

        return view('admin.elearning.materi.index', compact('materi'));
    }
}
