<?php

namespace App\Http\Controllers;

use App\Models\FlipBook;
use Illuminate\Http\Request;

class FeFlipBookController extends Controller
{
    public function index(Request $request)
    {
        $query = FlipBook::query();

        // Filter Pencarian Judul / Deskripsi
        if ($request->has('search') && $request->search != '') {
            $query->where('judul', 'like', '%' . $request->search . '%')
                  ->orWhere('deskripsi', 'like', '%' . $request->search . '%');
        }

        $flipbooks = $query->latest()->paginate(12);

        return view('frontend.flipbook.index', compact('flipbooks'));
    }

    public function show($id)
{
    $flipbook = FlipBook::findOrFail($id);
    return view('frontend.flipbook.show', compact('flipbook'));
}
}
