<?php

namespace App\Http\Controllers\Kalkulator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PPNController extends Controller
{
    public function index()
    {
        return view('kalkulator.ppn');
    }

    public function calculate(Request $request)
    {
        $request->validate([
            'jenis' => 'required|string|in:jual,beli',
            'nilai' => 'required|numeric|min:0',
            'tarif_ppn' => 'nullable|numeric|min:0|max:100',
            'include_ppn' => 'required|boolean',
            'judul' => 'nullable|string|max:255',
        ]);

        $nilai = $request->nilai;
        $tarif = $request->input('tarif_ppn', 11);
        $includePpn = $request->include_ppn;
        $jenis = $request->jenis;

        if ($includePpn) {
            $dpp = $nilai / (1 + ($tarif / 100));
            $ppn = $nilai - $dpp;
            $total = $nilai;
        } else {
            $dpp = $nilai;
            $ppn = $nilai * ($tarif / 100);
            $total = $nilai + $ppn;
        }

        $result = [
            'jenis' => $jenis,
            'nilai' => $nilai,
            'dpp' => $dpp,
            'tarif' => $tarif,
            'ppn' => $ppn,
            'total' => $total,
            'include_ppn' => $includePpn,
            'ppn_per_bulan' => $ppn,
        ];

        $calculation = new \App\Models\Calculation();
        $calculation->user_id = auth()->id();
        $calculation->profile_id = session('active_profile_id');
        $calculation->kalkulator_type = 'ppn';
        $calculation->judul = $request->input('judul', 'Kalkulasi PPN ' . now()->format('d/m/Y'));
        $calculation->input_data = $request->only(['jenis', 'nilai', 'tarif_ppn', 'include_ppn']);
        $calculation->result_data = $result;
        $calculation->session_id = session()->getId();
        $calculation->save();

        return response()->json([
            'success' => true,
            'result' => $result,
            'calculation_id' => $calculation->id,
        ]);
    }
}
