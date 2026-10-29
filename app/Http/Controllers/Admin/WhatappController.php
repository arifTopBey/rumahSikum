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


    public function send2(Request $request)
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

    public function send(Request $request)
    {
        $request->validate([
            'no_wa' => 'required',
            'message' => 'required'
        ]);

        // pisahkan nomor
        $phones = explode(';', $request->no_wa);

        DB::beginTransaction();

        try {

            foreach ($phones as $phone) {

                $phone = trim($phone);

                if (!$phone)
                    continue;

                $uuid = (string) Str::uuid();

                $payload = [
                    'data' => [
                        [
                            'phone' => $phone,
                            'message' => $request->message,
                            'secret' => false,
                            'retry' => false,
                            'isGroup' => false
                        ]
                    ]
                ];

                $response = Http::withHeaders([
                    'Authorization' => 'q2xheMei52wWml9tL7MR7QaMIwz6BiDXNMxaQWGkUH3EAUdTKVQ510I.11OYjU6x',
                    'Content-Type' => 'application/json'
                ])->post('https://solo.wablas.com/api/v2/send-message', $payload);

                // ✅ INSERT PER NOMOR
                DB::table('whatapp')->insert([
                    'no_wa' => $phone,
                    'message' => $request->message,
                    'status' => $response->successful() ? 'Terkirim' : 'Gagal',
                    'id_message' => $uuid,
                    // 'created_at' => now()
                ]);
            }

            DB::commit();

            return redirect()->route('admin.whatapp.index')
                ->with('success', 'Pesan berhasil dikirim ke semua nomor');

        } catch (Exception $e) {
            DB::rollBack();

            return back()->with('error', 'Gagal kirim: ' . $e->getMessage());
        }
    }

    public function resend($id)
    {
        $wa = DB::table('whatapp')->where('id', $id)->first();

        if (!$wa) {
            return back()->with('error', 'Data tidak ditemukan');
        }

        $uuid = (string) Str::uuid();

        $payload = [
            'data' => [
                [
                    'phone' => $wa->no_wa,
                    'message' => $wa->message,
                    'secret' => false,
                    'retry' => false,
                    'isGroup' => false
                ]
            ]
        ];

        try {
            $response = Http::withHeaders([
                'Authorization' => 'q2xheMei52wWml9tL7MR7QaMIwz6BiDXNMxaQWGkUH3EAUdTKVQ510I.11OYjU6x',
                'Content-Type' => 'application/json'
            ])->post('https://solo.wablas.com/api/v2/send-message', $payload);

            // ✅ update data lama ATAU insert baru (pilih salah satu)

            // 🔥 OPSI 1: UPDATE (replace status lama)
            DB::table('whatapp')->where('id', $id)->update([
                'status' => $response->successful() ? 'success' : 'failed',
                'id_message' => $uuid,
                'created_at' => now()
            ]);

            // 🔥 OPSI 2 (LEBIH BAGUS): INSERT LOG BARU
            /*
            DB::table('whatapp')->insert([
                'no_wa' => $wa->no_wa,
                'message' => $wa->message,
                'status' => $response->successful() ? 'success' : 'failed',
                'id_message' => $uuid,
                'created_at' => now()
            ]);
            */

            return back()->with('success', 'Pesan berhasil di-resend');

        } catch (Exception $e) {
            return back()->with('error', 'Gagal resend: ' . $e->getMessage());
        }
    }
}
