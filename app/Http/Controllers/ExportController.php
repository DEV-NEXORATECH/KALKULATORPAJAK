<?php

namespace App\Http\Controllers;

use App\Models\Calculation;
use Barryvdh\DomPDF\Facade\Pdf;

class ExportController extends Controller
{
    public function pdf(Calculation $calculation)
    {
        abort_if($calculation->user_id !== auth()->id(), 403);
        $pdf = Pdf::loadView('exports.calculation-pdf', compact('calculation'));
        return $pdf->download('kalkulasi-' . $calculation->id . '.pdf');
    }

    public function excel(Calculation $calculation)
    {
        abort_if($calculation->user_id !== auth()->id(), 403);

        $headers = [
            'Content-Type' => 'text/csv; charset=utf-8',
            'Content-Disposition' => 'attachment; filename="kalkulasi-' . $calculation->id . '.csv"',
        ];

        $callback = function () use ($calculation) {
            $file = fopen('php://output', 'w');
            fputs($file, "\xEF\xBB\xBF");

            fputcsv($file, ['Detail Perhitungan Pajak']);
            fputcsv($file, ['Judul', $calculation->judul]);
            fputcsv($file, ['Tipe Kalkulator', $calculation->kalkulator_type]);
            fputcsv($file, ['Tanggal', $calculation->created_at->format('d/m/Y H:i')]);
            fputcsv($file, []);

            fputcsv($file, ['Input']);
            foreach ($calculation->input_data as $key => $value) {
                fputcsv($file, [$key, is_bool($value) ? ($value ? 'Ya' : 'Tidak') : $value]);
            }
            fputcsv($file, []);

            fputcsv($file, ['Hasil']);
            foreach ($calculation->result_data as $key => $value) {
                if (is_array($value)) {
                    fputcsv($file, [$key, json_encode($value)]);
                } else {
                    fputcsv($file, [$key, $value]);
                }
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function excelAll()
    {
        $calculations = Calculation::where('user_id', auth()->id())->latest()->get();

        $headers = [
            'Content-Type' => 'text/csv; charset=utf-8',
            'Content-Disposition' => 'attachment; filename="semua-kalkulasi.csv"',
        ];

        $callback = function () use ($calculations) {
            $file = fopen('php://output', 'w');
            fputs($file, "\xEF\xBB\xBF");

            fputcsv($file, ['ID', 'Judul', 'Tipe', 'Tanggal', 'Total Pajak', 'Input Data', 'Result Data']);

            foreach ($calculations as $calc) {
                $totalPajak = '';
                if (isset($calc->result_data['pph21_tahunan'])) {
                    $totalPajak = $calc->result_data['pph21_tahunan'];
                } elseif (isset($calc->result_data['total'])) {
                    $totalPajak = $calc->result_data['total'];
                } elseif (isset($calc->result_data['ppn'])) {
                    $totalPajak = $calc->result_data['ppn'];
                }

                fputcsv($file, [
                    $calc->id,
                    $calc->judul,
                    $calc->kalkulator_type,
                    $calc->created_at->format('d/m/Y H:i'),
                    $totalPajak,
                    json_encode($calc->input_data),
                    json_encode($calc->result_data),
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
