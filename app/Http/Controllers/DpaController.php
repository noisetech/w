<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DpaController extends Controller
{
    public function index()
    {
        return view('pages.dpa.dpa.index');
    }

    public function h_tambah(){
        return view('pages.dpa.dpa.create');
    }

    public function listUrusan(Request $request){

    }
}
