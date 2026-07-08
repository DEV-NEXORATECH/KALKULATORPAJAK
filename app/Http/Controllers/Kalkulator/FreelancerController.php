<?php

namespace App\Http\Controllers\Kalkulator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FreelancerController extends Controller
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
        return view('kalkulator.freelancer');
    }

    public function calculate(Request $request)
    {
        $request->validate([
            'pendapatan_per_project' => 'required|numeric|min:0',
            'jumlah_project_per_tahun' => 'required|integer|min:1',
            'npwp' => 'required|boolean',
            'ptkp_status' => 'required|string|in:TK0,K0,K1,K2,K3',
            'judul' => 'nullable|string|max:255',
        ]);

        $pendapatanPerProject = $request->pendapatan_per_project;
        $jumlahProject = $request->jumlah_project_per_tahun;
        $totalPendapatan = $pendapatanPerProject * $jumlahProject;
        $ptkpValue = $this->ptkp[$request->ptkp_status] ?? 54000000;

        if (!$request->npwp) {
            $ptkpValue = 0;
        }

        $pkp = max(0, $totalPendapatan - $ptkpValue);
        $taxResult = $this->calculateProgressive($pkp);

        $result = [
            'pendapatan_per_project' => $pendapatanPerProject,
            'jumlah_project' => $jumlahProject,
            'total_pendapatan' => $totalPendapatan,
            'ptkp' => $ptkpValue,
            'pkp' => $pkp,
            'pph21_tahunan' => $taxResult['total'],
            'pph21_per_project' => $taxResult['total'] / $jumlahProject,
            'npwp' => $request->npwp,
            'breakdown' => $taxResult['layers'],
        ];

        $calculation = new \App\Models\Calculation();
        $calculation->user_id = auth()->id();
        $calculation->profile_id = session('active_profile_id');
        $calculation->kalkulator_type = 'freelancer';
        $calculation->judul = $request->input('judul', 'Kalkulasi Freelancer ' . now()->format('d/m/Y'));
        $calculation->input_data = $request->only(['pendapatan_per_project', 'jumlah_project_per_tahun', 'npwp', 'ptkp_status']);
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
