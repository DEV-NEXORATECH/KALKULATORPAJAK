<?php

namespace App\Http\Controllers\Kalkulator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UMKMController extends Controller
{
    public function index()
    {
        return view('kalkulator.umkm');
    }

    public function calculate(Request $request)
    {
        $request->validate([
            'omzet_tahunan' => 'required|numeric|min:0',
            'npwp' => 'required|boolean',
            'judul' => 'nullable|string|max:255',
        ]);

        $omzet = $request->omzet_tahunan;
        $ppnTerutang = 0;
        $pphFinal = 0;
        $keterangan = '';

        // PPN: if omzet > 500jt, wajib PKP and charge PPN
        if ($omzet > 500000000) {
            $ppnTerutang = $omzet * 0.11;
        }

        // PPh Final UMKM: 0.5% of omzet, but exempt if omzet <= 500jt (UU HPP)
        if ($omzet <= 500000000) {
            $pphFinal = 0;
            $keterangan = 'Omzet di bawah Rp500jt, PPh Final UMKM = 0% (UU HPP Pasal 7)';
        } else {
            // For omzet > 500jt but < 4.8B: 0.5% of omzet (first 4 years)
            // Simplified: apply 0.5% to total omzet
            $pphFinal = $omzet * 0.005;
            $keterangan = 'Omzet di atas Rp500jt, PPh Final 0,5% dari omzet';
        }

        // If no NPWP, 20% higher
        if (!$request->npwp) {
            $pphFinal = $pphFinal * 1.2;
            $keterangan .= ' (tanpa NPWP: tarif 20% lebih tinggi)';
        }

        $result = [
            'omzet' => $omzet,
            'ppn_terutang' => $ppnTerutang,
            'pph_final' => $pphFinal,
            'total_pajak' => $ppnTerutang + $pphFinal,
            'npwp' => $request->npwp,
            'keterangan' => $keterangan,
            'breakdown' => [
                'omzet' => $omzet,
                'batas_pkp' => 500000000,
                'ppn_rate' => $ppnTerutang > 0 ? '11%' : '0%',
                'pph_final_rate' => $omzet <= 500000000 ? '0%' : '0.5%',
            ],
        ];

        $calculation = new \App\Models\Calculation();
        $calculation->user_id = auth()->id();
        $calculation->profile_id = session('active_profile_id');
        $calculation->kalkulator_type = 'umkm';
        $calculation->judul = $request->input('judul', 'Kalkulasi UMKM ' . now()->format('d/m/Y'));
        $calculation->input_data = $request->only(['omzet_tahunan', 'npwp']);
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
