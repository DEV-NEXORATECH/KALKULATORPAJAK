<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GuestController extends Controller
{
    public function index()
    {
        return view('guest.index');
    }

    public function kalkulator($type)
    {
        $view = match ($type) {
            'pph21' => 'kalkulator.pph21',
            'take-home-pay' => 'kalkulator.take-home-pay',
            'thr-bonus' => 'kalkulator.thr-bonus',
            'gross-up' => 'kalkulator.gross-up',
            'ppn' => 'kalkulator.ppn',
            'umkm' => 'kalkulator.umkm',
            'freelancer' => 'kalkulator.freelancer',
            'badan' => 'kalkulator.badan',
            'dividen' => 'kalkulator.dividen',
            'properti' => 'kalkulator.properti',
            'kendaraan' => 'kalkulator.kendaraan',
            'simulasi' => 'kalkulator.simulasi',
            default => abort(404),
        };
        return view($view);
    }
}
