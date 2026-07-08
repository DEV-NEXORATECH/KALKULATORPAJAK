<?php

namespace App\Http\Controllers\Kalkulator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PropertiController extends Controller
{
    public function index()
    {
        return view('kalkulator.properti');
    }

    public function calculate(Request $request)
    {
        $request->validate([
            'jenis' => 'required|string|in:jual,sewa',
            'nilai_transaksi' => 'required|numeric|min:0',
            'luas_tanah' => 'nullable|numeric|min:0',
            'luas_bangunan' => 'nullable|numeric|min:0',
            'njop_tanah_per_m2' => 'nullable|numeric|min:0',
            'njop_bangunan_per_m2' => 'nullable|numeric|min:0',
            'judul' => 'nullable|string|max:255',
        ]);

        $jenis = $request->jenis;
        $nilaiTransaksi = $request->nilai_transaksi;
        $luasTanah = $request->input('luas_tanah', 0);
        $luasBangunan = $request->input('luas_bangunan', 0);
        $njopTanahPerM2 = $request->input('njop_tanah_per_m2', 0);
        $njopBangunanPerM2 = $request->input('njop_bangunan_per_m2', 0);

        if ($jenis === 'jual') {
            // BPHTB = 5% * (NPOP - NPOPTKP)
            // NPOPTKP varies by region, default Rp60.000.000
            $npop = $nilaiTransaksi;
            $npoptkp = 60000000;
            $npopKenaPajak = max(0, $npop - $npoptkp);
            $bphtb = 0.05 * $npopKenaPajak;

            // PBB (tahunan approximation)
            $njopTanah = $luasTanah * $njopTanahPerM2;
            $njopBangunan = $luasBangunan * $njopBangunanPerM2;
            $njop = $njopTanah + $njopBangunan;
            $njkp = 0.20 * $njop; // NJKP for PBB >= 1B
            if ($njop < 1000000000) {
                $njkp = 0.20 * $njop;
            }
            $pbb = 0.005 * $njkp;

            // PPh Final penjual (if penjual is OP)
            $pphFinalPenjual = 0.025 * $nilaiTransaksi;

            $result = [
                'jenis' => 'jual',
                'nilai_transaksi' => $nilaiTransaksi,
                'npop' => $npop,
                'npoptkp' => $npoptkp,
                'npop_kena_pajak' => $npopKenaPajak,
                'bphtb' => $bphtb,
                'njop' => $njop,
                'njkp' => $njkp,
                'pbb' => $pbb,
                'pph_final_penjual' => $pphFinalPenjual,
                'total' => $bphtb + $pbb,
                'breakdown' => [
                    'bphtb' => [
                        'tarif' => '5%',
                        'dasar' => $npopKenaPajak,
                        'nilai' => $bphtb,
                    ],
                    'pbb' => [
                        'tarif' => '0.5%',
                        'njkp' => $njkp,
                        'nilai' => $pbb,
                    ],
                    'pph_final_penjual' => [
                        'tarif' => '2.5%',
                        'nilai' => $pphFinalPenjual,
                    ],
                ],
            ];
        } else {
            // Sewa
            // PPh Final = 10% of nilai sewa
            $pphFinal = 0.10 * $nilaiTransaksi;

            // PPN = 11% of nilai sewa (if penyewa adalah PKP)
            $ppn = 0.11 * $nilaiTransaksi;

            $result = [
                'jenis' => 'sewa',
                'nilai_sewa' => $nilaiTransaksi,
                'pph_final' => $pphFinal,
                'ppn' => $ppn,
                'total' => $nilaiTransaksi + $pphFinal + $ppn,
                'breakdown' => [
                    'pph_final' => [
                        'tarif' => '10%',
                        'dasar' => $nilaiTransaksi,
                        'nilai' => $pphFinal,
                    ],
                    'ppn' => [
                        'tarif' => '11%',
                        'dasar' => $nilaiTransaksi,
                        'nilai' => $ppn,
                    ],
                ],
            ];
        }

        $calculation = new \App\Models\Calculation();
        $calculation->user_id = auth()->id();
        $calculation->profile_id = session('active_profile_id');
        $calculation->kalkulator_type = 'properti';
        $calculation->judul = $request->input('judul', 'Kalkulasi Pajak Properti ' . now()->format('d/m/Y'));
        $calculation->input_data = $request->only(['jenis', 'nilai_transaksi', 'luas_tanah', 'luas_bangunan', 'njop_tanah_per_m2', 'njop_bangunan_per_m2']);
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
