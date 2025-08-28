<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Kalkulator Paket - Non-Pots</title>
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
                <th style="width: 16mm;">Skema</th>
                <th style="width: 5mm;">Qty</th>
                <th style="width: 12mm;">Harga (Rp)</th>
                <th style="width: 12mm;">OTC (Rp)</th>
                <th style="width: 5mm;">Discount Price (%)</th>
                <th style="width: 5mm;">Discount OTC (%)</th>
                <th style="width: 5mm;">Price x Discount</th>
                <th style="width: 5mm;">OTC x Discount</th>
                <th style="width: 5mm;">Duration (Bulan)</th>
                <th style="width: 15mm;">OTC (setelah disc)</th>
                <th style="width: 12mm;">Monthly Price</th>
                <th style="width: 12mm;">Nominal PPN (%)</th>
                <th style="width: 15mm;">Monthly Price with PPN</th>
                <th style="width: 12mm;">Final Price with PPN</th>
            </tr>
        </thead>
        <tbody>
            @php
                $grandTotal = 0;
                $rupiah = fn($v) => number_format((float)$v, 0, ',', '.');
            @endphp

            @forelse($items as $i => $row)
                @php
                $ppnRate = !empty($row['ppn_rate']) 
    ? (float)$row['ppn_rate'] 
    : ((isset($ppn_rate) ? (float)$ppn_rate : 11)); 

                    $category = !empty($row['category_name']) ? $row['category_name'] : '-';
                    $product = $row['product_name'] ?? $row['product'] ?? '-';
                    $schema = $row['schema'] ?? $row['skema'] ?? '-';
                    $qty = (int) ($row['qty'] ?? 1);
                    $duration = (int) ($row['duration'] ?? 1);
                    $price = (float) ($row['price'] ?? 0);
                    $discount = (float) ($row['discount'] ?? 0);
                    $otc = (float) ($row['otc_price'] ?? $row['otc_harga'] ?? 0);
                    $odisc = (float) ($row['otc_discount'] ?? $row['otc_diskon'] ?? 0);

                    $priceDisc = $price * (1 - $discount / 100);
                    $otcDisc = $otc * (1 - $odisc / 100);
                    $monthly = $priceDisc * $qty;
                    $monthlyPPN = $monthly * (1 + $ppnRate / 100);
                    $totalPrice = $monthlyPPN * $duration;
                    $finalPrice = $totalPrice + $otcDisc;

                    $grandTotal += $finalPrice;
                @endphp
                <tr>
                <td>{{ $i + 1 }}</td>
                <td>{{ $row['category_name'] }}</td>
                <td class="text-left">{{ $product }}</td>
                <td>{{ $schema }}</td>
                <td>{{ $qty }}</td>
                <td class="text-right">{{ $rupiah($price) }}</td>
                <td class="text-right">{{ $rupiah($otc) }}</td>
                <td>{{ rtrim(rtrim(number_format($discount,2,',','.'), '0'), ',') }}</td>
                <td>{{ rtrim(rtrim(number_format($odisc,2,',','.'), '0'), ',') }}</td>
                <td class="text-right">{{ $rupiah($priceDisc) }}</td> <!-- Price x Discount -->
                <td class="text-right">{{ $rupiah($otcDisc) }}</td>   <!-- OTC x Discount -->
                <td>{{ $duration }}</td>
                <td class="text-right">{{ $rupiah($otcDisc) }}</td>   <!-- OTC setelah disc -->
                <td class="text-right">{{ $rupiah($monthly) }}</td>
                <td>{{ $ppnRate }}%</td>




                <td class="text-right">{{ $rupiah($monthlyPPN) }}</td>
                <td class="text-right">{{ $rupiah($finalPrice) }}</td>

                </tr>
            @empty
                <tr>
                    <td colspan="17" class="text-left">Tidak ada item.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="grand-total-box">
        GRAND TOTAL: Rp {{ $rupiah($grandTotal) }}
    </div>

    <div class="footer">
        Dokumen ini digenerate otomatis oleh sistem Kalkulator Non-Pots pada {{ \Carbon\Carbon::now()->format('d/m/Y H:i:s') }}<br>
        &copy; 2025 Kalkulator Non-Pots. All rights reserved.
    </div>

</body>
</html>
