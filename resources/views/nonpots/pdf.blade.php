<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Kalkulator Paket - Non-Pots</title>
    <style>
        * { box-sizing: border-box; }
        html, body { margin:0; padding:18px; font-family: Arial, Helvetica, sans-serif; font-size:12px; color:#000; }
        h2 { text-align:center; margin:0 0 8px 0; font-size:18px; }
        h3 { margin:18px 0 8px 0; font-size:14px; }
        p.meta { margin:0 0 12px 0; }
        table { width:100%; border-collapse:collapse; table-layout:fixed; font-size:12px; }
        th, td { border:1px solid #000; padding:6px; text-align:center; vertical-align:middle; word-wrap:break-word; }
        th { background:#f2f2f2; font-weight:bold; }
        .text-left  { text-align:left; }
        .text-right { text-align:right; }
        .total-row { font-weight:bold; background:#f9f9f9; }
        /* lebar kolom tabel 1 (Quotation) */
        .q col:nth-child(1){width:12%}
        .q col:nth-child(2){width:22%}
        .q col:nth-child(3){width:12%}
        .q col:nth-child(4){width:6%}
        .q col:nth-child(5){width:8%}
        .q col:nth-child(6){width:10%}
        .q col:nth-child(7){width:8%}
        .q col:nth-child(8){width:12%}
        .q col:nth-child(9){width:10%}
        .q col:nth-child(10){width:8%}
        .q col:nth-child(11){width:12%}
        /* lebar kolom tabel 2 (Rincian) */
        .r col:nth-child(1){width:18%}
        .r col:nth-child(2){width:15%}
        .r col:nth-child(3){width:12%}
        .r col:nth-child(4){width:12%}
        .r col:nth-child(5){width:7%}
        .r col:nth-child(6){width:12%}
        .r col:nth-child(7){width:12%}
        .r col:nth-child(8){width:12%}
        .no-border td { border:0!important; }
    </style>
</head>
<body>

    <h2>Quotation</h2>
    <p class="meta"><strong>Tanggal Cetak:</strong> {{ \Carbon\Carbon::now()->format('d-m-Y H:i') }}</p>

    {{-- ===================== TABEL 1: QUOTATION ===================== --}}
    <table>
        <colgroup class="q"><col><col><col><col><col><col><col><col><col><col><col></colgroup>
        <thead>
        <tr>
            <th>Kategori</th>
            <th>Produk</th>
            <th>Skema</th>
            <th>Qty</th>
            <th>Durasi</th>
            <th>Harga</th>
            <th>Diskon</th>
            <th>OTC Kategori</th>
            <th>OTC Harga</th>
            <th>OTC Diskon</th>
            <th>Total</th>
        </tr>
        </thead>
        <tbody>
        @php
            $grandTotalQuotation = 0;
            $rupiah = fn($v) => number_format((float)$v, 0, ',', '.');
        @endphp

        @forelse($items as $row)
            @php
                $ppnRate       = isset($row['ppn_rate']) ? (float)$row['ppn_rate'] : ($ppn_rate ?? 11); // %
                $category      = $row['category_name']  ?? $row['category'] ?? '-';
                $product       = $row['product_name']   ?? $row['product'] ?? '-';
                $schema        = $row['schema']         ?? $row['skema'] ?? '-';
                $qty           = (int)   ($row['qty'] ?? 1);
                $duration      = (int)   ($row['duration'] ?? 1);

                $price         = (float) ($row['price'] ?? 0);           // harga bulanan sebelum diskon
                $discount      = (float) ($row['discount'] ?? 0);        // %
                $otcCategory   = $row['otc_category'] ?? $row['otc_kategori'] ?? '-';
                $otcPrice      = (float) ($row['otc_price'] ?? $row['otc_harga'] ?? 0);
                $otcDiscount   = (float) ($row['otc_discount'] ?? $row['otc_diskon'] ?? 0);

                // nilai yang mungkin sudah disediakan frontend:
                $priceAfterDiscProvided = $row['price_after_discount'] ?? null;       // alias "price_x_discount"
                $otcAfterDiscProvided   = $row['otc_after_discount']   ?? null;       // alias "otc_x_discount"
                $monthlyWithPpnProvided = $row['monthly_with_ppn']     ?? null;
                $finalWithPpnProvided   = $row['final_with_ppn']       ?? null;

                // fallback perhitungan standar (aman default)
                $priceAfterDisc = is_numeric($priceAfterDiscProvided)
                                  ? (float)$priceAfterDiscProvided
                                  : $price * (1 - $discount/100);

                $otcAfterDisc   = is_numeric($otcAfterDiscProvided)
                                  ? (float)$otcAfterDiscProvided
                                  : $otcPrice * (1 - $otcDiscount/100);

                $monthlyWithPPN = is_numeric($monthlyWithPpnProvided)
                                  ? (float)$monthlyWithPpnProvided
                                  : $priceAfterDisc * (1 + $ppnRate/100);

                $totalQuotation = is_numeric($finalWithPpnProvided)
                                  ? (float)$finalWithPpnProvided
                                  : ($monthlyWithPPN * $duration * $qty) + $otcAfterDisc;

                $grandTotalQuotation += $totalQuotation;
            @endphp
            <tr>
                <td>{{ $category }}</td>
                <td class="text-left">{{ $product }}</td>
                <td>{{ $schema }}</td>
                <td>{{ $qty }}</td>
                <td>{{ $duration }}</td>
                <td class="text-right">{{ $rupiah($price) }}</td>
                <td>{{ rtrim(rtrim(number_format($discount,2,',','.'), '0'), ',') }}%</td>
                <td>{{ $otcCategory }}</td>
                <td class="text-right">{{ $rupiah($otcPrice) }}</td>
                <td>{{ rtrim(rtrim(number_format($otcDiscount,2,',','.'), '0'), ',') }}%</td>
                <td class="text-right">{{ $rupiah($totalQuotation) }}</td>
            </tr>
        @empty
            <tr><td colspan="11" class="text-left">Tidak ada item.</td></tr>
        @endforelse

        <tr class="total-row">
            <td colspan="10" class="text-right">Grand Total</td>
            <td class="text-right">{{ $rupiah($grandTotalQuotation) }}</td>
        </tr>
        </tbody>
    </table>

    {{-- ===================== TABEL 2: RINCIAN PERHITUNGAN NON-POTS ===================== --}}
    <h3>Rincian Perhitungan Non-Pots</h3>
    <table>
        <colgroup class="r"><col><col><col><col><col><col><col><col></colgroup>
        <thead>
        <tr>
            <th>Price x Discount</th>
            <th>OTC x Discount</th>
            <th>Duration (Bulan)</th>
            <th>OTC (setelah disc)</th>
            <th>Monthly Price</th>
            <th>Monthly Price with PPN</th>
            <th>Year Price</th>
            <th>Final Price with PPN</th>
        </tr>
        </thead>
        <tbody>
        @php $grandTotalFinal = 0; @endphp
        @forelse($items as $row)
            @php
                $ppnRate  = isset($row['ppn_rate']) ? (float)$row['ppn_rate'] : ($ppn_rate ?? 11);
                $qty      = (int)   ($row['qty'] ?? 1);
                $duration = (int)   ($row['duration'] ?? 1);
                $price    = (float) ($row['price'] ?? 0);
                $discount = (float) ($row['discount'] ?? 0);
                $otc      = (float) ($row['otc_price'] ?? $row['otc_harga'] ?? 0);
                $odisc    = (float) ($row['otc_discount'] ?? $row['otc_diskon'] ?? 0);

                $priceDisc = is_numeric($row['price_after_discount'] ?? null)
                             ? (float)$row['price_after_discount']
                             : $price * (1 - $discount/100);

                $otcDisc   = is_numeric($row['otc_after_discount'] ?? null)
                             ? (float)$row['otc_after_discount']
                             : $otc * (1 - $odisc/100);

                $monthly   = $priceDisc * $qty;
                $monthlyPPN= is_numeric($row['monthly_with_ppn'] ?? null)
                             ? (float)$row['monthly_with_ppn']
                             : $monthly * (1 + $ppnRate/100);

                $yearPrice = $monthly * 12;

                $finalPPN  = is_numeric($row['final_with_ppn'] ?? null)
                             ? (float)$row['final_with_ppn']
                             : ($monthlyPPN * $duration) + $otcDisc;

                $grandTotalFinal += $finalPPN;
            @endphp
            <tr>
                <td class="text-right">{{ $rupiah($priceDisc) }}</td>
                <td class="text-right">{{ $rupiah($otcDisc) }}</td>
                <td>{{ $duration }}</td>
                <td class="text-right">{{ $rupiah($otcDisc) }}</td>
                <td class="text-right">{{ $rupiah($monthly) }}</td>
                <td class="text-right">{{ $rupiah($monthlyPPN) }}</td>
                <td class="text-right">{{ $rupiah($yearPrice) }}</td>
                <td class="text-right">{{ $rupiah($finalPPN) }}</td>
            </tr>
        @empty
            <tr><td colspan="8" class="text-left">Tidak ada item.</td></tr>
        @endforelse
        <tr class="total-row">
            <td colspan="7" class="text-right">Total Keseluruhan</td>
            <td class="text-right">{{ $rupiah($grandTotalFinal) }}</td>
        </tr>
        </tbody>
    </table>

    {{-- Opsional: judul kalkulasi (kalau dikirim dari form) --}}
    @if(!empty($title))
        <table class="no-border" style="margin-top:10px;">
            <tr class="no-border"><td class="no-border text-left"><strong>Judul Kalkulasi:</strong> {{ $title }}</td></tr>
        </table>
    @endif

</body>
</html>
