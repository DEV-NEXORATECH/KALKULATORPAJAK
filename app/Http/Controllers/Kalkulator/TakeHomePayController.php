<?php

namespace App\Http\Controllers\Kalkulator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TakeHomePayController extends Controller
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
                    'lapisan' => 'Rp ' . number_format($lower, 0, ',', '.') . ' - Rp ' . number_format($upper === PHP_FLOAT_MAX ? $remaining + $lower : $upper, 0, ',', '.'),
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
        return view('kalkulator.take-home-pay');
    }

    public function calculate(Request $request)
    {
        $request->validate([
            'gaji_bulanan' => 'required|numeric|min:0',
            'ptkp_status' => 'required|string|in:TK0,K0,K1,K2,K3',
            'npwp' => 'required|boolean',
            'bpjs_kesehatan' => 'required|boolean',
            'bpjs_ketenagakerjaan' => 'required|boolean',
            'judul' => 'nullable|string|max:255',
        ]);

        $gajiBulanan = $request->gaji_bulanan;
        $gajiTahunan = $gajiBulanan * 12;
        $ptkpValue = $this->ptkp[$request->ptkp_status] ?? 54000000;

        if (!$request->npwp) {
            $ptkpValue = 0;
        }

        $pkp = max(0, $gajiTahunan - $ptkpValue);
        $taxResult = $this->calculateProgressive($pkp);
        $pph21Tahunan = $taxResult['total'];
        $pph21Bulanan = $pph21Tahunan / 12;

        $bpjsKesehatan = 0;
        if ($request->bpjs_kesehatan) {
            $bpjsKesehatan = min($gajiBulanan, 12000000) * 0.01;
        }

        $bpjsKetenagakerjaan = 0;
        if ($request->bpjs_ketenagakerjaan) {
            $jht = $gajiBulanan * 0.02;
            $jp = $gajiBulanan * 0.01;
            $bpjsKetenagakerjaan = $jht + $jp;
        }

        $totalPotongan = $pph21Bulanan + $bpjsKesehatan + $bpjsKetenagakerjaan;
        $takeHomePay = $gajiBulanan - $totalPotongan;

        $result = [
            'gaji_bulanan' => $gajiBulanan,
            'gaji_tahunan' => $gajiTahunan,
            'ptkp' => $ptkpValue,
            'pkp' => $pkp,
            'pph21_tahunan' => $pph21Tahunan,
            'potongan_pph21' => $pph21Bulanan,
            'potongan_bpjs_kesehatan' => $bpjsKesehatan,
            'potongan_bpjs_ketenagakerjaan' => $bpjsKetenagakerjaan,
            'total_potongan' => $totalPotongan,
            'take_home_pay' => $takeHomePay,
            'npwp' => $request->npwp,
            'breakdown' => [
                'pph21_layers' => $taxResult['layers'],
                'bpjs' => [
                    'kesehatan' => $bpjsKesehatan,
                    'jht' => $gajiBulanan * 0.02,
                    'jp' => $gajiBulanan * 0.01,
                ],
            ],
        ];

        $calculation = new \App\Models\Calculation();
        $calculation->user_id = auth()->id();
        $calculation->profile_id = session('active_profile_id');
        $calculation->kalkulator_type = 'take_home_pay';
        $calculation->judul = $request->input('judul', 'Kalkulasi Take Home Pay ' . now()->format('d/m/Y'));
        $calculation->input_data = $request->only(['gaji_bulanan', 'ptkp_status', 'npwp', 'bpjs_kesehatan', 'bpjs_ketenagakerjaan']);
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
