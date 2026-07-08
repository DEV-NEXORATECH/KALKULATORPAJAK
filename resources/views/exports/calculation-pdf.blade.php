<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Hasil Kalkulasi - {{ $calculation->judul }}</title>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 12px;
            line-height: 1.6;
            color: #333;
        }
        .header {
            text-align: center;
            border-bottom: 2px solid #0F766E;
            padding-bottom: 15px;
            margin-bottom: 20px;
        }
        .header h1 {
            color: #0F766E;
            font-size: 20px;
            margin: 0 0 5px;
        }
        .header p {
            color: #666;
            margin: 0;
            font-size: 11px;
        }
        .section {
            margin-bottom: 20px;
        }
        .section h2 {
            background: #0F766E;
            color: white;
            padding: 8px 12px;
            font-size: 14px;
            margin: 0 0 10px;
            border-radius: 4px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table th, table td {
            padding: 6px 10px;
            text-align: left;
            border-bottom: 1px solid #eee;
        }
        table th {
            background: #f5f5f5;
            font-weight: 600;
            width: 40%;
        }
        .value {
            font-weight: 500;
        }
        .highlight {
            background: #f0fdfa;
            font-weight: 700;
            color: #0F766E;
        }
        .footer {
            text-align: center;
            color: #999;
            font-size: 10px;
            border-top: 1px solid #ddd;
            padding-top: 10px;
            margin-top: 30px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Hasil Kalkulasi Pajak</h1>
        <p>{{ $calculation->judul }}</p>
        <p>Dibuat: {{ $calculation->created_at->format('d/m/Y H:i') }} | Tipe: {{ strtoupper(str_replace('_', ' ', $calculation->kalkulator_type)) }}</p>
    </div>

    <div class="section">
        <h2>Data Input</h2>
        <table>
            @foreach ($calculation->input_data as $key => $value)
                <tr>
                    <th>{{ ucwords(str_replace('_', ' ', $key)) }}</th>
                    <td class="value">
                        @if (is_bool($value))
                            {{ $value ? 'Ya' : 'Tidak' }}
                        @elseif (is_numeric($value))
                            Rp {{ number_format($value, 0, ',', '.') }}
                        @else
                            {{ $value }}
                        @endif
                    </td>
                </tr>
            @endforeach
        </table>
    </div>

    <div class="section">
        <h2>Hasil Perhitungan</h2>
        <table>
            @foreach ($calculation->result_data as $key => $value)
                @if (!is_array($value))
                    <tr class="{{ in_array($key, ['pph21_tahunan', 'total', 'pph21_bulanan', 'take_home_pay', 'thr_bersih']) ? 'highlight' : '' }}">
                        <th>{{ ucwords(str_replace('_', ' ', $key)) }}</th>
                        <td class="value">
                            @if (is_bool($value))
                                {{ $value ? 'Ya' : 'Tidak' }}
                            @elseif (is_numeric($value) && $value > 100)
                                Rp {{ number_format($value, 0, ',', '.') }}
                            @elseif (is_numeric($value))
                                {{ number_format($value, 2, ',', '.') }}
                            @else
                                {{ $value }}
                            @endif
                        </td>
                    </tr>
                @endif
            @endforeach
        </table>
    </div>

    <div class="footer">
        <p>Dokumen ini dihasilkan oleh Kalkulator Pajak &copy; {{ date('Y') }}</p>
    </div>
</body>
</html>
