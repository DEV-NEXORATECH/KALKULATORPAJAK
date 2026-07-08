<?php

namespace App\Http\Controllers\Kalkulator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BadanController extends Controller
{
    public function index()
    {
        return view('kalkulator.badan');
    }

    public function calculate(Request $request)
    {
        $request->validate([
            'omset_tahunan' => 'required|numeric|min:0',
            'biaya_operasional' => 'required|numeric|min:0',
            'npwp' => 'required|boolean',
            'judul' => 'nullable|string|max:255',
        ]);

        $omset = $request->omset_tahunan;
        $biaya = $request->biaya_operasional;
        $pkp = max(0, $omset - $biaya);

        // PPN: if omset > 4.8B, charge PPN
        $ppn = 0;
        $ppnKeterangan = '';
        if ($omset > 4800000000) {
            $ppn = $omset * 0.11;
            $ppnKeterangan = 'Wajib PKP, PPN 11% dari omset';
        } else {
            $ppnKeterangan = 'Omset di bawah 4.8M, tidak wajib PKP';
        }

        // PPh Badan: UMKM tariff 0.5% for first 3 years if omset < 4.8B
        // Then 22% of PKP (2024 rate)
        $pphBadan = 0;
        $tarifBadan = 0.22;

        if (!$request->npwp) {
            $tarifBadan *= 1.2;
        }

        // Simplified: For entities with omset < 4.8B, use 0.5% of omset (first 3 years regime)
        // For others, use 22% of PKP
        if ($omset <= 4800000000) {
            $pphBadan = $omset * 0.005;
            $keteranganPPh = 'Menggunakan PP 23/2018: 0,5% dari omset';
        } else {
            $pphBadan = $pkp * $tarifBadan;
            $keteranganPPh = 'Menggunakan tarif Pasal 17: ' . ($tarifBadan * 100) . '% dari PKP';
        }

        $totalPajak = $ppn + $pphBadan;

        $result = [
            'omset' => $omset,
            'biaya' => $biaya,
            'pkp' => $pkp,
            'ppn' => $ppn,
            'pph_badan' => $pphBadan,
            'total_pajak' => $totalPajak,
            'npwp' => $request->npwp,
            'tarif_badan' => $tarifBadan * 100 . '%',
            'breakdown' => [
                'pkp_calculation' => [
                    'omset' => $omset,
                    'biaya' => $biaya,
                    'pkp' => $pkp,
                ],
                'ppn' => [
                    'nilai' => $ppn,
                    'keterangan' => $ppnKeterangan,
                ],
                'pph_badan' => [
                    'nilai' => $pphBadan,
                    'keterangan' => $keteranganPPh,
                ],
            ],
        ];

        $calculation = new \App\Models\Calculation();
        $calculation->user_id = auth()->id();
        $calculation->profile_id = session('active_profile_id');
        $calculation->kalkulator_type = 'badan';
        $calculation->judul = $request->input('judul', 'Kalkulasi Pajak Badan ' . now()->format('d/m/Y'));
        $calculation->input_data = $request->only(['omset_tahunan', 'biaya_operasional', 'npwp']);
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
