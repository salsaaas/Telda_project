<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 10px;
            margin: 20px;
            color: #333;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #1e3a8a;
            padding-bottom: 15px;
        }
        .header h1 {
            color: #1e3a8a;
            margin: 0;
            font-size: 18px;
        }
        .header h2 {
            color: #666;
            margin: 5px 0;
            font-size: 14px;
            font-weight: normal;
        }
        .info-section {
            margin-bottom: 20px;
        }
        .info-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 5px;
        }
        .info-label {
            font-weight: bold;
            color: #1e3a8a;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th {
            background-color: #1e3a8a;
            color: white;
            padding: 8px 5px;
            text-align: center;
            font-size: 8px;
            border: 1px solid #ddd;
        }
        td {
            padding: 6px 5px;
            text-align: center;
            border: 1px solid #ddd;
            font-size: 8px;
        }
        .text-left { text-align: left; }
        .text-right { text-align: right; }
        .text-center { text-align: center; }
        
        .total-section {
            margin-top: 20px;
            text-align: right;
        }
        .grand-total {
            font-size: 14px;
            font-weight: bold;
            color: #1e3a8a;
            background-color: #f8f9fa;
            padding: 10px;
            border: 2px solid #1e3a8a;
            display: inline-block;
            margin-top: 10px;
        }
        .footer {
            margin-top: 30px;
            text-align: center;
            color: #666;
            font-size: 8px;
            border-top: 1px solid #ddd;
            padding-top: 10px;
        }
        .currency {
            font-family: 'Courier New', monospace;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>RINCIAN BIAYA PAKET</h1>
        <h2>{{ $title }}</h2>
    </div>

    <div class="info-section">
        <div class="info-row">
            <span class="info-label">Tanggal Cetak:</span>
            <span>{{ $generated_at }}</span>
        </div>
        <div class="info-row">
            <span class="info-label">Total Item:</span>
            <span>{{ count($items) }} Produk</span>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 4%;">No</th>
                <th style="width: 10%;">Category</th>
                <th style="width: 20%;">Product Name</th>
                <th style="width: 10%;">OTC Category</th>
                <th style="width: 9%;">Harga (Rp)</th>
                <th style="width: 9%;">OTC (Rp)</th>
                <th style="width: 7%;">Durasi</th>
                <th style="width: 10%;">Harga + PPN (Rp)</th>
                <th style="width: 10%;">Harga x Durasi (Rp)</th>
                <th style="width: 11%;">Final Price no PPN (Rp)</th>
                <th style="width: 11%;">Final Price (Rp)</th>
            </tr>
        </thead>
        <tbody>
            @foreach($items as $index => $item)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td class="text-left">{{ $item['category_name'] }}</td>
                <td class="text-left">{{ $item['product_name'] }}</td>
                <td class="text-center">{{ $item['otc_category'] }}</td>
                <td class="text-right currency">{{ number_format($item['price'], 0, ',', '.') }}</td>
                <td class="text-right currency">{{ number_format($item['otc'], 0, ',', '.') }}</td>
                <td class="text-center">{{ $item['duration'] }} bln</td>
                <td class="text-right currency">{{ number_format($item['price_with_ppn'], 0, ',', '.') }}</td>
                <td class="text-right currency">{{ number_format($item['price_duration'], 0, ',', '.') }}</td>
                <td class="text-right currency" style="font-weight: bold; background-color: #fff3cd;">
                    {{ number_format($item['final_price_no_ppn'], 0, ',', '.') }}
                </td>
                <td class="text-right currency" style="font-weight: bold; background-color: #f8f9fa;">
                    {{ number_format($item['final_price'], 0, ',', '.') }}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="total-section">
        <div class="grand-total">
            GRAND TOTAL: Rp {{ number_format($grand_total, 0, ',', '.') }}
        </div>
    </div>

    <div class="footer">
        <p>Dokumen ini digenerate otomatis oleh sistem Kalkulator Indibiz pada {{ $generated_at }}</p>
        <p>© {{ date('Y') }} Kalkulator Indibiz. All rights reserved.</p>
    </div>
</body>
</html>