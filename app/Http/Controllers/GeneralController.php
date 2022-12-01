<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GeneralController extends Controller
{
    public function index()
    {
        return view('pages.dashboard');
    }

    public function checkPermission()
    {
        // code
    }

    public function noAuth()
    {
        // code
    }

    public function encrypsi(Request $request)
    {
        $encrypted = encrypsi($request->data);
        return response()->json([
            'status' => 'success',
            'data' => $encrypted
        ]);
    }

    public function decrypsi(Request $request)
    {
        $decrypted = decrypsi($request->data);
        return response()->json([
            'status' => 'success',
            'data' => $decrypted
        ]);
    }
}
