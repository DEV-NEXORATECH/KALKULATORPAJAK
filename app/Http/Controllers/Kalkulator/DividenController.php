<?php

namespace App\Http\Controllers\Kalkulator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DividenController extends Controller
{
    public function index()
    {
        return view('kalkulator.dividen');
    }

    public function calculate(Request $request)
    {
        $request->validate([
            'jumlah_dividen' => 'required|numeric|min:0',
            'npwp' => 'required|boolean',
            'is_wpln' => 'required|boolean',
            'judul' => 'nullable|string|max:255',
        ]);

        $jumlah = $request->jumlah_dividen;
        $isWpln = $request->is_wpln;

        if ($isWpln) {
            $tarif = 20;
            $pphDividen = $jumlah * 0.20;
            $keterangan = 'Wajib Pajak Luar Negeri: tarif 20%';
        } else {
            if (!$request->npwp) {
                $tarif = 12;
                $pphDividen = $jumlah * 0.12;
                $keterangan = 'WP Dalam Negeri tanpa NPWP: tarif 12% (10% + 20% lebih tinggi)';
            } else {
                $tarif = 10;
                $pphDividen = $jumlah * 0.10;
                $keterangan = 'WP Dalam Negeri: tarif 10% final';
            }
        }

        $dividenBersih = $jumlah - $pphDividen;

        $result = [
            'jumlah_dividen' => $jumlah,
            'tarif' => $tarif,
            'pph_dividen' => $pphDividen,
            'dividen_bersih' => $dividenBersih,
            'is_wpln' => $isWpln,
            'npwp' => $request->npwp,
            'keterangan' => $keterangan,
        ];

        $calculation = new \App\Models\Calculation();
        $calculation->user_id = auth()->id();
        $calculation->profile_id = session('active_profile_id');
        $calculation->kalkulator_type = 'dividen';
        $calculation->judul = $request->input('judul', 'Kalkulasi Dividen ' . now()->format('d/m/Y'));
        $calculation->input_data = $request->only(['jumlah_dividen', 'npwp', 'is_wpln']);
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
