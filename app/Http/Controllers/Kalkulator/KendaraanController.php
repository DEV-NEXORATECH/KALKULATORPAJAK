<?php

namespace App\Http\Controllers\Kalkulator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class KendaraanController extends Controller
{
    public function index()
    {
        return view('kalkulator.kendaraan');
    }

    public function calculate(Request $request)
    {
        $request->validate([
            'jenis' => 'required|string|in:motor,mobil',
            'tahun_kendaraan' => 'required|integer|min:2000|max:2099',
            'tahun_sekarang' => 'nullable|integer|min:2000|max:2099',
            'nilai_jual' => 'required|numeric|min:0',
            'pkb_sebelumnya' => 'nullable|numeric|min:0',
            'judul' => 'nullable|string|max:255',
        ]);

        $jenis = $request->jenis;
        $tahunKendaraan = $request->tahun_kendaraan;
        $tahunSekarang = $request->input('tahun_sekarang', (int) now()->format('Y'));
        $nilaiJual = $request->nilai_jual;
        $pkbSebelumnya = $request->input('pkb_sebelumnya', 0);

        // PKB = 2% of nilai jual (approximate)
        $pkb = $nilaiJual * 0.02;

        // SWDKLLJ
        $swdkllj = ($jenis === 'motor') ? 35000 : 143000;

        // Total pajak pokok
        $totalPajak = $pkb + $swdkllj;

        // Denda if late
        $denda = 0;
        $bulanTelat = 0;
        $tahunTelat = $tahunSekarang - $tahunKendaraan;

        // If vehicle age > 1 year, assume potential late payment
        // Denda dihitung jika telat bayar
        // Simplified: telat dihitung dari bulan Januari tahun berjalan
        $pkbTerutang = $pkbSebelumnya > 0 ? $pkbSebelumnya : $pkb;

        // If pkb_sebelumnya > 0, calculate penalty
        if ($request->has('pkb_sebelumnya') && $pkbSebelumnya > 0) {
            // Assume 1 year late as default
            $bulanTelat = 12;
        } elseif ($tahunTelat > 1) {
            $bulanTelat = min(($tahunTelat - 1) * 12, 48);
        }

        if ($bulanTelat > 0) {
            $dendaPkb = 0.25 * $pkbTerutang * ($bulanTelat / 12);
            $dendaSwdkllj = ($jenis === 'motor') ? 32000 : 100000;
            $denda = $dendaPkb + $dendaSwdkllj;
        }

        $totalKeseluruhan = $totalPajak + $denda;

        $result = [
            'jenis' => $jenis,
            'tahun_kendaraan' => $tahunKendaraan,
            'tahun_sekarang' => $tahunSekarang,
            'nilai_jual' => $nilaiJual,
            'pkb' => $pkb,
            'swdkllj' => $swdkllj,
            'total_pajak' => $totalPajak,
            'denda' => $denda,
            'bulan_telat' => $bulanTelat,
            'total_keseluruhan' => $totalKeseluruhan,
            'breakdown' => [
                'pkb' => [
                    'persentase' => '2%',
                    'nilai' => $pkb,
                ],
                'swdkllj' => [
                    'jenis' => $jenis === 'motor' ? 'Motor (Rp35.000)' : 'Mobil (Rp143.000)',
                    'nilai' => $swdkllj,
                ],
                'denda' => $denda > 0 ? [
                    'bulan_telat' => $bulanTelat,
                    'denda_pkb' => $dendaPkb ?? 0,
                    'denda_swdkllj' => $dendaSwdkllj ?? 0,
                ] : null,
            ],
        ];

        $calculation = new \App\Models\Calculation();
        $calculation->user_id = auth()->id();
        $calculation->profile_id = session('active_profile_id');
        $calculation->kalkulator_type = 'kendaraan';
        $calculation->judul = $request->input('judul', 'Kalkulasi Pajak Kendaraan ' . now()->format('d/m/Y'));
        $calculation->input_data = $request->only(['jenis', 'tahun_kendaraan', 'tahun_sekarang', 'nilai_jual', 'pkb_sebelumnya']);
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
