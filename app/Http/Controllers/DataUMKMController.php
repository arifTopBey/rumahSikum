<?php

namespace App\Http\Controllers;

use App\Interface\UmkmInterface;
use Illuminate\Http\Request;

class DataUMKMController extends Controller
{

    Protected $umkmRepo;

    public function __construct(UmkmInterface $umkmRepo)
    {
        $this->umkmRepo = $umkmRepo;
    }
    public function index(){

        $data = $this->umkmRepo->getKeuangan();

        // $data = $this->umkmRepo->getData(10, 1, 1);

        return view('admin.informasi_data_umkm.index', compact('data'));
    }

    public function list_umkm(){

        $data = $this->umkmRepo->getData(10, 1, 1);
        $data = $data['data'];


        return view('admin.umkm.index', compact('data'));
    }

    public function show(int $id){

        $data = $this->umkmRepo->getFullDetail($id);

        // dd($data);

        return view('admin.umkm.show', compact('data'));
    }
}
