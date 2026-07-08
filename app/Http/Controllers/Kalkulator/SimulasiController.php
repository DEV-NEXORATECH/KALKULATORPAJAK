<?php

namespace App\Http\Controllers\Kalkulator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SimulasiController extends Controller
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
        return view('kalkulator.simulasi');
    }

    public function calculate(Request $request)
    {
        $request->validate([
            'scenarios' => 'required|array|min:1|max:10',
            'scenarios.*.penghasilan' => 'required|numeric|min:0',
            'scenarios.*.ptkp_status' => 'required|string|in:TK0,K0,K1,K2,K3',
            'scenarios.*.npwp' => 'required|boolean',
            'judul' => 'nullable|string|max:255',
        ]);

        $scenarios = $request->scenarios;
        $results = [];
        $labels = [];

        foreach ($scenarios as $index => $scenario) {
            $penghasilan = $scenario['penghasilan'];
            $ptkpValue = $this->ptkp[$scenario['ptkp_status']] ?? 54000000;

            if (!$scenario['npwp']) {
                $ptkpValue = 0;
            }

            $pkp = max(0, $penghasilan - $ptkpValue);
            $taxResult = $this->calculateProgressive($pkp);

            $effectiveRate = $pkp > 0 ? ($taxResult['total'] / $pkp) * 100 : 0;

            $label = 'Skenario ' . ($index + 1);
            $labels[] = $label;

            $results[] = [
                'label' => $label,
                'penghasilan' => $penghasilan,
                'ptkp_status' => $scenario['ptkp_status'],
                'npwp' => $scenario['npwp'],
                'ptkp' => $ptkpValue,
                'pkp' => $pkp,
                'pph21_tahunan' => $taxResult['total'],
                'pph21_bulanan' => $taxResult['total'] / 12,
                'effective_rate' => round($effectiveRate, 2),
                'breakdown' => $taxResult['layers'],
            ];
        }

        // Generate recommendation
        $rekomendasi = '';
        if (count($results) > 1) {
            $minTax = PHP_FLOAT_MAX;
            $bestScenario = null;

            foreach ($results as $r) {
                if ($r['pph21_tahunan'] < $minTax) {
                    $minTax = $r['pph21_tahunan'];
                    $bestScenario = $r['label'];
                }
            }

            $rekomendasi = $bestScenario
                ? 'Skenario dengan pajak terendah: ' . $bestScenario . ' (Rp ' . number_format($minTax, 0, ',', '.') . '/tahun)'
                : 'Semua skenario memiliki nilai pajak yang sama.';
        }

        $result = [
            'scenarios' => $results,
            'perbandingan' => [
                'labels' => $labels,
                'dataset' => $results,
            ],
            'rekomendasi' => $rekomendasi,
        ];

        $calculation = new \App\Models\Calculation();
        $calculation->user_id = auth()->id();
        $calculation->profile_id = session('active_profile_id');
        $calculation->kalkulator_type = 'simulasi';
        $calculation->judul = $request->input('judul', 'Simulasi Perbandingan PPh 21 ' . now()->format('d/m/Y'));
        $calculation->input_data = $request->only(['scenarios']);
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
