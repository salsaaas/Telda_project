<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Kalkulator Paket - Pots</title>
    <style>
        * { box-sizing: border-box; }
        html, body {
            margin: 0;
            padding: 18px;
            font-family: Arial, Helvetica, sans-serif;
            font-size: 9px;
            color: #000;
        }

        @page {
            size: A4 landscape;
            margin: 10mm;
        }

        h2 {
            text-align: center;
            margin: 16px 0 8px 0;
            font-size: 16px;
            border-bottom: 1px solid #1e3a8a;
            padding-bottom: 10px;   
        }

        p.meta {
            margin: 0 0 12px 0;
        }

        table {
            width: 100%;
            table-layout: auto;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th {
            background-color: #1e3a8a; /* Biru tua */
            color: white;              /* Teks putih */
            font-weight: bold;
            font-size: 9px;
            padding: 6px;
            border: 1px solid #ccc;
            text-align: center;
            vertical-align: middle;
            word-break: break-word;
            overflow-wrap: break-word;
            white-space: normal;
        }

        td {
            background-color: white;
            color: black;
            font-size: 7px;
            padding: 4px;
            border: 1px solid #ccc;
            text-align: center;
            vertical-align: middle;
            word-break: break-word;
            overflow-wrap: break-word;
            white-space: normal;
        }

        .text-left {
            text-align: left;
        }

        .text-right {
            text-align: right;
        }

        .footer {
            margin-top: 40px;
            padding-top: 8px;
            border-top: 1px solid #1e3a8a;
            text-align: center;
            font-size: 8px;
            color: #555;
            clear: both;
        }

        .grand-total-box {
            margin-top: 12px;
            padding: 10px 20px;
            display: inline-block;
            float: right;
            border: 2px solid #1e3a8a;
            color: #1e3a8a;
            font-weight: bold;
            font-size: 12px;
        }
        </style>
    </head>
    <body>
    <h2>RINCIAN BIAYA PAKET</h2>
    <p class="meta"><strong>Tanggal Cetak:</strong> {{ \Carbon\Carbon::now()->format('d-m-Y H:i:s') }}</p>
    <strong>Total Item:</strong> {{ count($items) }}
    <table>
        <thead>
            <tr>
                <th style="width: 1mm;">No</th>
                <th style="width: 15mm;">Category</th>
                <th style="width: 45mm;">Product Name</th>
                <th style="width: 12mm;">OTC Category</th>
                <th style="width: 5mm;">Price (Rp)</th>
                <th style="width: 5mm;">OTC (Rp)</th>
                <th style="width: 5mm;">Duration (Bulan)</th>
                <th style="width: 5mm;">Nomimal PPN (%)</th>
                <th style="width: 15mm;">Price + PPN (Rp)</th>
                <th style="width: 12mm;">Price + Duration (Rp)</th>
                <th style="width: 12mm;">Final Price no PPN (Rp)</th>
                <th style="width: 5mm;">Final Price (Rp)</th>
            </tr>
        </thead>
        <tbody>
                @php
                    $rupiah = fn($v) => number_format((float)$v, 0, ',', '.');
                @endphp

                @foreach($items as $i => $row)
                    <tr>
                        <td>{{ $i+1 }}</td>
                        <td>{{ $row['category_name'] }}</td>
                        <td class="text-left">{{ $row['product_name'] }}</td>
                        <td>{{ $row['otc_category'] }}</td>
                        <td class="text-right">{{ $rupiah($row['price']) }}</td>
                        <td class="text-right">{{ $rupiah($row['otc_price']) }}</td>
                        <td>{{ (int)$row['duration'] }}</td>
                        <td>{{ (int)$row['ppn_rate_pct'] }}%</td>
                        <td class="text-right">{{ $rupiah($row['price_with_ppn']) }}</td>
                        <td class="text-right">{{ $rupiah($row['price_duration']) }}</td>
                        <td class="text-right">{{ $rupiah($row['final_price_no_ppn']) }}</td>
                        <td class="text-right">{{ $rupiah($row['final_price']) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    <div class="grand-total-box">
        GRAND TOTAL: Rp {{ $rupiah($grand_total ?? 0) }}
    </div>

    <div class="footer">
        Dokumen ini digenerate otomatis oleh sistem Kalkulator Non-Pots pada {{ \Carbon\Carbon::now()->format('d/m/Y H:i:s') }}<br>
        &copy; 2025 Kalkulator Non-Pots. All rights reserved.
    </div>

</body>
</html>
