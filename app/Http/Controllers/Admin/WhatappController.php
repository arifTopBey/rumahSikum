<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WhatappController extends Controller
{
    public function index(){

        return view('admin.whatApp.index');
    }

    public function create(){


        return view('admin.whatApp.create');

    }
}
