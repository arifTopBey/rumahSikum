<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WhatApp;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class WhatappController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;
        $whatApps = WhatApp::orderBy('id', 'desc')->search($search)->paginate(10)->withQueryString();
        return view('admin.whatApp.index', compact('whatApps'));
    }

    public function create()
    {


        return view('admin.whatApp.create');
    }


    public function send(Request $request)
    {
        $request->validate([
            'no_wa' => 'required',
            'message' => 'required'
        ]);

        $payload = [
            'data' => [
                [
                    'phone' => $request->no_wa,
                    'message' => $request->message,
                    'secret' => false,
                    'retry' => false,
                    'isGroup' => false
                ]
            ]
        ];
        $idMessage = Str::uuid();
        DB::beginTransaction();

        try {
                $response = Http::withHeaders([
                    'Authorization' => 'q2xheMei52wWml9tL7MR7QaMIwz6BiDXNMxaQWGkUH3EAUdTKVQ510I.11OYjU6x',
                    'Content-Type' => 'application/json'
                ])->post('https://solo.wablas.com/api/v2/send-message', $payload);

                DB::table('whatapp')->insert([
                    'no_wa' => $request->no_wa,
                    'message' => $request->message,
                    'status' => $response->successful() ? 'success' : 'failed',
                    'id_message' => $idMessage,
                    'created_at' => now()
                ]);
            DB::commit();
            // return back()->with('success', 'Pesan berhasil dikirim');
            return redirect()->route('admin.whatapp.index')->with('success', 'Pesan berhasil dikirim');

        } catch (Exception $e) {
            DB::rollBack();
            // throw new Exception($e->getMessage());
            return back()->with('error', 'Gagal kirim: ' . $e->getMessage());

        }
    }
}
