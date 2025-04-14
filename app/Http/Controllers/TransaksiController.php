<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function process(Request $request)
{
    return response()->json(['message' => 'Transaksi berhasil!']);
}

}
