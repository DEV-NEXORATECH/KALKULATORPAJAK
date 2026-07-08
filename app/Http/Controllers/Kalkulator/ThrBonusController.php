<?php

namespace App\Http\Controllers\Kalkulator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ThrBonusController extends Controller
{
    protected $ptkp = [
        'TK0' => 54000000,
        'K0'  => 58500000,
        'K1'  => 63000000,
        'K2'  => 67500000,
        'K3'  => 72000000,
    ];

    protected function calculateProgressive($pkp)
    {
        $layers = [];
        $remaining = $pkp;
        $totalTax = 0;

        $brackets = [
            ['limit' => 60000000, 'rate' => 0.05],
            ['limit' => 250000000, 'rate' => 0.15],
            ['limit' => 500000000, 'rate' => 0.25],
            ['limit' => 5000000000, 'rate' => 0.30],
            ['limit' => PHP_FLOAT_MAX, 'rate' => 0.35],
        ];

        $lower = 0;
        foreach ($brackets as $bracket) {
            if ($remaining <= 0) break;

            $upper = $bracket['limit'];
            $range = $upper - $lower;
            $taxable = min($remaining, $range);
            $tax = $taxable * $bracket['rate'];
            $totalTax += $tax;

            if ($taxable > 0) {
                $layers[] = [
                    'pkp' => $taxable,
                    'rate' => $bracket['rate'] * 100 . '%',
                    'pph' => $tax,
                ];
            }

            $remaining -= $range;
            $lower = $upper;
        }

        return ['total' => $totalTax, 'layers' => $layers];
    }

    public function index()
    {
        return view('kalkulator.thr-bonus');
    }

    public function calculate(Request $request)
    {
        $request->validate([
            'gaji_bulanan' => 'required|numeric|min:0',
            'thr_bonus' => 'required|numeric|min:0',
            'ptkp_status' => 'required|string|in:TK0,K0,K1,K2,K3',
            'npwp' => 'required|boolean',
            'jumlah_bulan_kerja' => 'nullable|integer|min:1|max:12',
            'judul' => 'nullable|string|max:255',
        ]);

        $gajiBulanan = $request->gaji_bulanan;
        $thr = $request->thr_bonus;
        $bulanKerja = $request->input('jumlah_bulan_kerja', 12);
        $ptkpValue = $this->ptkp[$request->ptkp_status] ?? 54000000;

        if (!$request->npwp) {
            $ptkpValue = 0;
        }

        // PPh 21 without THR
        $gajiNormalTahunan = $gajiBulanan * $bulanKerja;
        $pkpNormal = max(0, $gajiNormalTahunan - $ptkpValue);
        $taxNormal = $this->calculateProgressive($pkpNormal);

        // PPh 21 with THR
        $gajiDenganThrTahunan = $gajiNormalTahunan + $thr;
        $pkpDenganThr = max(0, $gajiDenganThrTahunan - $ptkpValue);
        $taxDenganThr = $this->calculateProgressive($pkpDenganThr);

        // PPh 21 on THR = difference
        $pph21Thr = $taxDenganThr['total'] - $taxNormal['total'];
        $thrBersih = $thr - $pph21Thr;

        $result = [
            'gaji_bulanan' => $gajiBulanan,
            'thr' => $thr,
            'jumlah_bulan_kerja' => $bulanKerja,
            'penghasilan_normal_setahun' => $gajiNormalTahunan,
            'penghasilan_dengan_thr' => $gajiDenganThrTahunan,
            'ptkp' => $ptkpValue,
            'pkp_normal' => $pkpNormal,
            'pkp_dengan_thr' => $pkpDenganThr,
            'pph21_normal' => $taxNormal['total'],
            'pph21_normal_per_bulan' => $taxNormal['total'] / 12,
            'pph21_dengan_thr' => $taxDenganThr['total'],
            'pph21_thr' => $pph21Thr,
            'thr_bersih' => $thrBersih,
            'npwp' => $request->npwp,
            'breakdown' => [
                'pph21_normal_layers' => $taxNormal['layers'],
                'pph21_dengan_thr_layers' => $taxDenganThr['layers'],
            ],
        ];

        $calculation = new \App\Models\Calculation();
        $calculation->user_id = auth()->id();
        $calculation->profile_id = session('active_profile_id');
        $calculation->kalkulator_type = 'thr_bonus';
        $calculation->judul = $request->input('judul', 'Kalkulasi THR/Bonus ' . now()->format('d/m/Y'));
        $calculation->input_data = $request->only(['gaji_bulanan', 'thr_bonus', 'ptkp_status', 'npwp', 'jumlah_bulan_kerja']);
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
