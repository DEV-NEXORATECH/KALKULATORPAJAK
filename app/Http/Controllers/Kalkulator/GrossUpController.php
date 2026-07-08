<?php

namespace App\Http\Controllers\Kalkulator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GrossUpController extends Controller
{
    protected $ptkp = [
        'TK0' => 54000000,
        'K0'  => 58500000,
        'K1'  => 63000000,
        'K2'  => 67500000,
        'K3'  => 72000000,
    ];

    protected function getEffectiveRate($pkp)
    {
        $brackets = [
            ['limit' => 60000000, 'rate' => 0.05],
            ['limit' => 250000000, 'rate' => 0.15],
            ['limit' => 500000000, 'rate' => 0.25],
            ['limit' => 5000000000, 'rate' => 0.30],
            ['limit' => PHP_FLOAT_MAX, 'rate' => 0.35],
        ];

        $remaining = $pkp;
        $totalTax = 0;

        $lower = 0;
        foreach ($brackets as $bracket) {
            if ($remaining <= 0) break;

            $range = $bracket['limit'] - $lower;
            $taxable = min($remaining, $range);
            $totalTax += $taxable * $bracket['rate'];

            $remaining -= $range;
            $lower = $bracket['limit'];
        }

        if ($pkp <= 0) return 0;

        return $totalTax / $pkp;
    }

    public function index()
    {
        return view('kalkulator.gross-up');
    }

    public function calculate(Request $request)
    {
        $request->validate([
            'target_take_home_pay' => 'required|numeric|min:0',
            'ptkp_status' => 'required|string|in:TK0,K0,K1,K2,K3',
            'npwp' => 'required|boolean',
            'judul' => 'nullable|string|max:255',
        ]);

        $targetThp = $request->target_take_home_pay;
        $targetThpTahunan = $targetThp * 12;
        $ptkpValue = $this->ptkp[$request->ptkp_status] ?? 54000000;

        if (!$request->npwp) {
            $ptkpValue = 0;
        }

        // Iterative gross-up calculation
        $gajiBruto = $targetThpTahunan;
        $maxIterations = 50;
        $tolerance = 1000;

        for ($i = 0; $i < $maxIterations; $i++) {
            $pkp = max(0, $gajiBruto - $ptkpValue);
            $effectiveRate = $this->getEffectiveRate($pkp);

            $newGajiBruto = $targetThpTahunan;
            if ($effectiveRate < 1) {
                $newGajiBruto = $targetThpTahunan / (1 - $effectiveRate);
            }

            if (abs($newGajiBruto - $gajiBruto) < $tolerance) {
                $gajiBruto = $newGajiBruto;
                break;
            }

            $gajiBruto = $newGajiBruto;
        }

        $pkpFinal = max(0, $gajiBruto - $ptkpValue);
        $effectiveRate = $this->getEffectiveRate($pkpFinal);
        $pph21 = $gajiBruto - $targetThpTahunan;

        $result = [
            'target_thp_bulanan' => $targetThp,
            'target_thp_tahunan' => $targetThpTahunan,
            'gaji_bruto_tahunan' => $gajiBruto,
            'gaji_bruto_bulanan' => $gajiBruto / 12,
            'ptkp' => $ptkpValue,
            'pkp' => $pkpFinal,
            'pph21_tahunan' => $pph21,
            'pph21_bulanan' => $pph21 / 12,
            'effective_rate' => $effectiveRate,
            'total_biaya' => $gajiBruto,
            'npwp' => $request->npwp,
            'breakdown' => [
                'target_thp' => $targetThp,
                'gaji_bruto_bulanan' => $gajiBruto / 12,
                'pph21_bulanan' => $pph21 / 12,
                'total_bulanan' => $gajiBruto / 12,
            ],
        ];

        $calculation = new \App\Models\Calculation();
        $calculation->user_id = auth()->id();
        $calculation->profile_id = session('active_profile_id');
        $calculation->kalkulator_type = 'gross_up';
        $calculation->judul = $request->input('judul', 'Kalkulasi Gross Up ' . now()->format('d/m/Y'));
        $calculation->input_data = $request->only(['target_take_home_pay', 'ptkp_status', 'npwp']);
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
