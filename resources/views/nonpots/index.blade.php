@extends('layouts.app')

@section('content')
<div class="card shadow-sm mb-4">
    <div class="card-body mt-2">
        <div class="text-center position-relative mb-3">
            <h4 class="mb-0 fw-bold">Kalkulator Non-Pots</h4>
            <span class="badge bg-secondary position-absolute end-0 top-50 translate-middle-y">
                Total Produk: {{ count($products) }}
            </span>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="mb-3">
            <label class="form-label">Judul Kalkulasi</label>
            <input type="text" class="form-control" placeholder="Masukkan judul kalkulasi..." id="calculationTitle">
        </div>

        <form id="calculatorForm" method="POST" action="#">
            @csrf
            <div class="table-responsive" style="overflow-x: auto;">
                <table class="table table-bordered text-center" style="min-width: 2000px; width: 100%;">
                    <thead class="table-light">
                        <tr>
                            <th style="min-width: 150px;">Category Product</th>
                            <th style="min-width: 450px;">Product Name</th>
                            <th style="min-width: 180px;">Skema</th>
                            <th style="min-width: 80px;">Qty</th>
                            <th style="min-width: 120px;">Price (Rp)</th>
                            <th style="min-width: 120px;">OTC (Rp)</th>
                            <th style="min-width: 130px;">Discont Price (%)</th>
                            <th style="min-width: 130px;">Discont OTC (%)</th>
                            <th style="min-width: 150px;">Price x Discount</th>
                            <th style="min-width: 150px;">OTC x Discount</th>
                            <th style="min-width: 120px;">Duration (Bulan)</th>
                            <th style="min-width: 120px;">OTC (setelah disc)</th>
                            <th style="min-width: 150px;">Monthly Price</th>
                            <th style="min-width: 180px;">Monthly Price with PPN</th>
                            <th style="min-width: 150px;">Year Price</th>
                            <th style="min-width: 180px;">Final Price with PPN</th>
                            <th style="min-width: 100px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="calculatorRows">
                        <tr class="calculator-row">
                            <td>
                                <select name="items[0][category_id]" class="form-select category-select" required>
                                    <option value="">-</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->category_id }}">{{ $category->nama_category }}</option>
                                    @endforeach
                                </select>
                            </td>

                            <td>
                                <select name="items[0][product_id]" class="form-select product-select" required>
                                    <option value="">-</option>
                                    @foreach($products as $product)
                                        <option value="{{ $product->id }}"
                                            data-price="{{ $product->price }}"
                                            data-category="{{ $product->category_id }}">
                                            {{ $product->nama_product }}
                                        </option>
                                    @endforeach
                                </select>
                            </td>

                            <td>
                                <select name="items[0][skema]" class="form-select otc-select" required>
                                    <option value="">-</option>
                                    <option value="OTC KONTAN" data-price="2500000">OTC KONTAN</option>
                                    <option value="OTC PERBULAN" data-price="2500000">OTC PERBULAN</option>
                                </select>
                            </td>

                            <td>
                                <input type="number" name="items[0][qty]" class="form-control qty-input" value="1" min="1" required>
                            </td>

                            <td>
                                <span class="price-display">Rp 0</span>
                                <input type="hidden" name="items[0][price]" class="price-value" value="0">
                            </td>

                            <td>
                                <span class="otc-display">Rp 0</span>
                                <input type="hidden" name="items[0][otc]" class="otc-value" value="0">
                            </td>

                            <td>
                                <input type="number" name="items[0][disc_price]" class="form-control disc-price" value="0" min="0" max="100">
                            </td>
                            <td>
                                <input type="number" name="items[0][disc_otc]" class="form-control disc-otc" value="0" min="0" max="100">
                            </td>

                            <td><span class="price-times-discount">Rp 0</span></td>
                            <td><span class="otc-times-discount">Rp 0</span></td>

                            <td><input type="number" name="items[0][duration]" class="form-control duration-input" min="1" value="1" required style="width: 80px;"></td>

                            <td><span class="monthly-otc">Rp 0</span></td>
                            <td><span class="monthly-price">Rp 0</span></td>
                            <td><span class="monthly-price-ppn">Rp 0</span></td>
                            <td><span class="yearly-price">Rp 0</span></td>
                            <td><span class="final-price-ppn text-success">Rp 0</span></td>

                            <td>
                                <button type="button" class="btn btn-danger btn-sm remove-row">
                                    <i class="fas fa-trash"></i> Hapus
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <button type="button" class="btn btn-success btn-sm mt-2" id="addRowBtn">
                    <i class="fas fa-plus"></i> Tambah Baris
                </button>
            </div>

            <div class="d-flex align-items-center mt-3">
                <span class="me-3"><strong>Total Keseluruhan: <span id="grandTotal" class="text-danger">Rp 0</span></strong></span>
                <button type="button" class="btn btn-secondary me-2" id="resetBtn">
                    <i class="fas fa-undo"></i> Reset
                </button>
                <button type="button" class="btn btn-navy" id="printPdfBtn" data-print-url="{{ route('nonpots.print-pdf') }}">
                    <i class="fas fa-file-pdf"></i> Print PDF
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {

    // ---------- Utils ----------
    const fmt = n => 'Rp ' + new Intl.NumberFormat('id-ID').format(Math.round(n || 0));
    const withPPN = x => x * 1.11;
    const toPct = v => Math.min(100, Math.max(0, Number(v) || 0)) / 100;

    function resetRow(row) {
        // reset input nilai
        row.querySelectorAll('input[type="number"]').forEach(i => {
            if (i.classList.contains('qty-input') || i.classList.contains('duration-input')) i.value = 1;
            else i.value = 0;
        });
        row.querySelectorAll('input[type="hidden"]').forEach(i => i.value = 0);
        // reset select
        row.querySelectorAll('select').forEach(s => s.selectedIndex = 0);
        // reset display
        row.querySelectorAll('.price-display,.otc-display,.price-times-discount,.otc-times-discount,.monthly-otc,.monthly-price,.monthly-price-ppn,.yearly-price,.final-price-ppn')
           .forEach(el => el.textContent = fmt(0));
    }

    function renumberRows() {
        document.querySelectorAll('#calculatorRows .calculator-row').forEach((tr, idx) => {
            tr.querySelectorAll('select[name], input[name]').forEach(el => {
                el.name = el.name.replace(/\[\d+\]/, `[${idx}]`);
            });
        });
    }

    function updateGrandTotal() {
        let total = 0;
        document.querySelectorAll('#calculatorRows .calculator-row').forEach(row => {
            const qty        = parseInt(row.querySelector('.qty-input').value) || 1;
            const duration   = parseInt(row.querySelector('.duration-input').value) || 1;
            const basePrice  = parseFloat(row.querySelector('.price-value').value) || 0;
            const otc        = parseFloat(row.querySelector('.otc-value').value) || 0;
            const dPrice     = toPct(row.querySelector('.disc-price').value);
            const dOtc       = toPct(row.querySelector('.disc-otc').value);

            const priceAfterDisc = basePrice * (1 - dPrice);
            const otcAfterDisc   = otc * (1 - dOtc);

            const monthly = priceAfterDisc * qty;
            const oneTime = otcAfterDisc   * qty;

            total += withPPN(monthly) * duration + withPPN(oneTime);
        });
        document.getElementById('grandTotal').textContent = fmt(total);
    }

    function updateRow(row) {
        const qty        = parseInt(row.querySelector('.qty-input').value) || 1;
        const duration   = parseInt(row.querySelector('.duration-input').value) || 1;
        const basePrice  = parseFloat(row.querySelector('.price-value').value) || 0;
        const otc        = parseFloat(row.querySelector('.otc-value').value) || 0;
        const dPrice     = toPct(row.querySelector('.disc-price').value);
        const dOtc       = toPct(row.querySelector('.disc-otc').value);

        const priceAfterDisc = basePrice * (1 - dPrice);
        const otcAfterDisc   = otc * (1 - dOtc);

        const monthly    = priceAfterDisc * qty;           // biaya bulanan setelah diskon
        const monthlyPPN = withPPN(monthly);
        const oneTime    = otcAfterDisc * qty;             // OTC setelah diskon
        const finalPrice = (monthlyPPN * duration) + withPPN(oneTime);

        // tampilan dasar
        row.querySelector('.price-display').textContent        = fmt(basePrice * qty);
        row.querySelector('.otc-display').textContent          = fmt(otc * qty);

        // tampilan diskon
        row.querySelector('.price-times-discount').textContent = fmt(priceAfterDisc * qty);
        row.querySelector('.otc-times-discount').textContent   = fmt(otcAfterDisc   * qty);

        // tampilan ringkasan
        row.querySelector('.monthly-otc').textContent          = fmt(oneTime);
        row.querySelector('.monthly-price').textContent        = fmt(monthly);
        row.querySelector('.monthly-price-ppn').textContent    = fmt(monthlyPPN);
        row.querySelector('.yearly-price').textContent         = fmt(priceAfterDisc * qty * 12);
        row.querySelector('.final-price-ppn').textContent      = fmt(finalPrice);

        updateGrandTotal();
    }

    function filterProductsByCategory(row) {
        const categoryId   = row.querySelector('.category-select').value;
        const productSelect = row.querySelector('.product-select');

        // kosongkan pilihan saat kategori berubah
        productSelect.value = '';

        Array.from(productSelect.options).forEach(option => {
            if (option.value === '') {
                option.style.display = 'block';
                return;
            }
            option.style.display = (String(option.dataset.category) === String(categoryId)) ? 'block' : 'none';
        });
    }

    function attachRowEvents(row) {
        // Kategori -> filter product options
        row.querySelector('.category-select').addEventListener('change', () => {
            filterProductsByCategory(row);
            row.querySelector('.price-value').value = 0;
            updateRow(row);
        });

        // Product -> set price
        row.querySelector('.product-select').addEventListener('change', function () {
            const opt = this.selectedOptions[0];
            const price = parseFloat(opt?.dataset?.price || 0);
            row.querySelector('.price-value').value = price;
            updateRow(row);
        });

        // Skema/OTC -> set otc value
        row.querySelector('.otc-select').addEventListener('change', function () {
            const opt = this.selectedOptions[0];
            const otcPrice = parseFloat(opt?.dataset?.price || 0);
            row.querySelector('.otc-value').value = otcPrice;
            updateRow(row);
        });

        // Qty, Duration, Diskon
        row.querySelector('.qty-input').addEventListener('input', () => updateRow(row));
        row.querySelector('.duration-input').addEventListener('input', () => updateRow(row));
        row.querySelector('.disc-price').addEventListener('input', () => updateRow(row));
        row.querySelector('.disc-otc').addEventListener('input', () => updateRow(row));
    }

    // Delegasi klik HAPUS
    document.getElementById('calculatorRows').addEventListener('click', function (e) {
        const btn = e.target.closest('.remove-row');
        if (!btn) return;

        const row = btn.closest('tr.calculator-row');
        if (!row) return;

        const rows = document.querySelectorAll('#calculatorRows .calculator-row');
        if (rows.length === 1) {
            resetRow(row);
            updateGrandTotal();
            return;
        }

        row.remove();
        renumberRows();
        updateGrandTotal();
    });

    // Tambah baris
    document.getElementById('addRowBtn').addEventListener('click', () => {
        const templateRow = document.querySelector('#calculatorRows .calculator-row');
        const newRow = templateRow.cloneNode(true);

        // reset isi & index
        newRow.querySelectorAll('select[name], input[name]').forEach(el => {
            el.name = el.name.replace(/\[\d+\]/, '[9999]'); // placeholder
        });
        resetRow(newRow);

        document.getElementById('calculatorRows').appendChild(newRow);
        renumberRows();
        attachRowEvents(newRow);
        // pastikan product ter-filter sesuai kategori baris baru
        filterProductsByCategory(newRow);
        updateGrandTotal();
    });

    // Reset form
    document.getElementById('resetBtn').addEventListener('click', () => {
        if (!confirm('Apakah Anda yakin ingin reset semua data?')) return;

        const tbody = document.getElementById('calculatorRows');
        const rows = Array.from(tbody.querySelectorAll('.calculator-row'));
        rows.slice(1).forEach(r => r.remove());      // sisakan 1 baris
        resetRow(rows[0]);
        renumberRows();
        updateGrandTotal();
    });

    // Print PDF submit
    document.getElementById('printPdfBtn').addEventListener('click', function () {
        const form = document.getElementById('calculatorForm');
        const url  = this.dataset.printUrl;

        // kumpulkan payload sederhana (opsional—sesuaikan controller kamu)
        const items = [];
        document.querySelectorAll('#calculatorRows .calculator-row').forEach((row) => {
            const obj = {
                category_id : row.querySelector('.category-select').value || null,
                product_id  : row.querySelector('.product-select').value || null,
                skema       : row.querySelector('.otc-select').value || null,
                qty         : parseInt(row.querySelector('.qty-input').value) || 1,
                duration    : parseInt(row.querySelector('.duration-input').value) || 1,
                price       : parseFloat(row.querySelector('.price-value').value) || 0,
                otc         : parseFloat(row.querySelector('.otc-value').value) || 0,
                disc_price  : Number(row.querySelector('.disc-price').value) || 0,
                disc_otc    : Number(row.querySelector('.disc-otc').value) || 0,
            };
            items.push(obj);
        });

        // buat/isi input hidden
        let payload = form.querySelector('input[name="payload"]');
        if (!payload) {
            payload = document.createElement('input');
            payload.type = 'hidden';
            payload.name = 'payload';
            form.appendChild(payload);
        }
        payload.value = JSON.stringify({
            title: document.getElementById('calculationTitle').value || '',
            items
        });

        form.action = url;
        form.method = 'POST';
        form.submit();
    });

    // --- init untuk baris pertama
    const firstRow = document.querySelector('#calculatorRows .calculator-row');
    attachRowEvents(firstRow);
    filterProductsByCategory(firstRow); // sembunyikan product sampai kategori dipilih
    updateRow(firstRow);
});
</script>
@endpush
