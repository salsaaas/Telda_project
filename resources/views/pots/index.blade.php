@extends('layouts.app')

@section('content')
<div class="card shadow-sm mb-4">
    <div class="card-body mt-2">
        <div class="text-center position-relative mb-3">
            <h4 class="mb-0 fw-bold">Kalkulator Pots</h4>
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

        <form id="calculatorForm">
            @csrf
            <div class="table-responsive">
                <table class="table table-bordered text-center" id="calculatorTable" style="min-width:2000px; width:100%;">
                    <thead class="table-light">
                        <tr>
                        <th style="min-width: 150px;">Category Product</th>
                        <th style="min-width: 300px;">Product Name</th>
                        <th style="min-width: 150px;">OTC Category</th>
                        <th style="min-width: 120px;">Price (Rp)</th>
                        <th style="min-width: 120px;">OTC (Rp)</th>
                        <th style="min-width: 150px;">Nominal PPN (%)</th>
                        <th style="min-width: 150px;">Duration (Bulan)</th>
                        <th style="min-width: 150px;">Price + PPN (Rp)</th>
                        <th style="min-width: 150px;">Final Price no PPN (Rp)</th>
                        <th style="min-width: 150px;">Final Price (Rp)</th>
                        <th style="min-width: 150px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="calculatorRows">
                        <tr class="calculator-row">
                            <td>
                                <select name="items[0][category_id]" class="form-select category-select" required>
                                @foreach($categories as $category)
                                    <option value="{{ $category->category_id }}">{{ $category->nama_category }}</option>
                                @endforeach

                                </select>
                            </td>
                            <td>
                                <select name="items[0][product_id]" class="form-select product-select" required></select>
                            </td>
                            <td>
                                <select name="items[0][otc_category]" class="form-select otc-select" required>
                                    <option value="FREE/MO" data-price="0">FREE/MO</option>
                                    <option value="AO DISCOUNT" data-price="150000">AO DISCOUNT</option>
                                    <option value="AO NORMAL" data-price="500000">AO NORMAL</option>
                                </select>
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
                                <select name="items[0][ppn]" class="form-select ppn-select" style="width: 100px;">
                                    <option value="">-</option>
                                    <option value="0.11" selected>11</option>
                                    <option value="0.12">12</option>
                                </select>
                            </td>
                            <td><input type="number" name="items[0][duration]" class="form-control duration-input" min="1" value="1" required style="width:80px;"></td>
                            <td><span class="price-duration text-info">Rp 0</span></td>
                            <td><span class="final-price-no-ppn text-warning">Rp 0</span></td>
                            <td><span class="final-price text-success">Rp 0</span></td>
                            <td>
                                <button type="button" class="btn btn-danger btn-sm remove-row">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="d-flex align-items-center justify-content-start gap-2 mt-2 flex-wrap">
    <button type="button" class="btn btn-success btn-sm" id="addRowBtn">
        <i class="fas fa-plus"></i> Tambah Baris
    </button>

    <span><strong>Total Keseluruhan: <span id="grandTotal" class="text-danger">Rp 0</span></strong></span>

    <button type="button" class="btn btn-secondary" id="resetBtn">
        <i class="fas fa-undo"></i> Reset
    </button>

    <button type="button" class="btn btn-navy" id="printPdfBtn" data-print-url="{{ route('nonpots.print-pdf') }}">
        <i class="fas fa-file-pdf"></i> Print PDF
    </button>
</div>

            </div>
        </form>
    </div>
</div>

{{-- TEMPLATE ROW --}}
<template id="row-template">
    <tr class="calculator-row">
        <td>
            <select name="items[0][category_id]" class="form-select category-select" required>
                @foreach($categories as $category)
                    <option value="{{ $category->category_id }}" data-name="{{ $category->nama_category }}">
                        {{ $category->nama_category }}
                    </option>
                @endforeach
            </select>
        </td>
        <td>
            <select name="items[0][product_id]" class="form-select product-select" required></select>
        </td>
        <td>
            <select name="items[0][otc_category]" class="form-select otc-select" required>
                <option value="FREE/MO" data-price="0">FREE/MO</option>
                <option value="AO DISCOUNT" data-price="150000">AO DISCOUNT</option>
                <option value="AO NORMAL" data-price="500000">AO NORMAL</option>
            </select>
        </td>
        <td>
            <span class="price-display">Rp 0</span>
            <input type="hidden" name="items[0][price]" class="price-value" value="0">
        </td>
        <td>
            <span class="otc-display">Rp 0</span>
            <input type="hidden" name="items[0][otc]" class="otc-value" value="0">
        </td>
        <td><span class="price-with-ppn text-primary">Rp 0</span></td>
        <td><input type="number" name="items[0][duration]" class="form-control duration-input" min="1" value="1" required style="width:80px;"></td>
        <td><span class="price-duration text-info">Rp 0</span></td>
        <td><span class="final-price-no-ppn text-warning">Rp 0</span></td>
        <td><span class="final-price text-success">Rp 0</span></td>
        <td>
            <button type="button" class="btn btn-danger btn-sm remove-row">
                <i class="fas fa-trash"></i>
            </button>
        </td>
    </tr>
</template>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const fmt = n => 'Rp ' + new Intl.NumberFormat('id-ID').format(Math.round(n || 0));
    const ppn = x => x * 1.11;

    function initSelect2ForRow(row) {
        const $row = $(row);
        const $category = $row.find('.category-select');
        const $product  = $row.find('.product-select');

        if ($product.data('select2')) { $product.select2('destroy'); }

        $product.select2({
            width: '100%',
            dropdownAutoWidth: true,
            placeholder: '-',
            allowClear: true,
            minimumInputLength: 0,
            dropdownCssClass: 'no-search',
            minimumResultsForSearch: Infinity,

            ajax: {
                url: '{{ route("potproducts.byCategory") }}',
                delay: 0,
                cache: false,
                data: function (params) {
                    return {
                        category_id: $category.val() || '',
                        q: params.term || ''
                    };
                },
                processResults: function (data) {
                    return {
                        results: (data || []).map(item => ({
                            id: item.id,
                            text: item.text,
                            price: item.price ?? 0
                        }))
                    };
                }
            }
        });

        // Fetch awal saat dropdown dibuka
        $product.on('select2:open', function () {
            if (!$category.val()) return;
            const s2 = $product.data('select2');
            if (s2) { s2.trigger('query', { term: '' }); }
        });

        // Ganti kategori => reset produk & harga
        $category.off('change.s2').on('change.s2', function () {
            $product.val(null).trigger('change');
            $product.empty().trigger('change');
            const rowEl = $row.get(0);
            rowEl.querySelector('.price-value').value = 0;
            rowEl.querySelector('.price-display').textContent = fmt(0);
            updateRow(rowEl);
        });

        // Pilih / clear produk
        $product.off('select2:select.s2 clear.s2')
            .on('select2:select.s2', function (e) {
                const data = e.params.data;
                const rowEl = $row.get(0);
                const price = parseFloat(data.price || 0);
                rowEl.querySelector('.price-value').value = price;
                rowEl.querySelector('.price-display').textContent = fmt(price);
                updateRow(rowEl);
            })
            .on('select2:clear.s2', function () {
                const rowEl = $row.get(0);
                rowEl.querySelector('.price-value').value = 0;
                rowEl.querySelector('.price-display').textContent = fmt(0);
                updateRow(rowEl);
            });
    }

    function updateRow(row) {
        const price    = parseFloat(row.querySelector('.price-value').value) || 0;
        const otc      = parseFloat(row.querySelector('.otc-value').value) || 0;
        const duration = parseInt(row.querySelector('.duration-input').value) || 1;

        const priceWithPPN  = ppn(price);
        const priceDuration = priceWithPPN * duration;
        const finalNoPPN    = (price * duration) + otc;
        const finalPrice    = priceDuration + ppn(otc);

        row.querySelector('.price-with-ppn').textContent     = fmt(priceWithPPN);
        row.querySelector('.price-duration').textContent     = fmt(priceDuration);
        row.querySelector('.final-price-no-ppn').textContent = fmt(finalNoPPN);
        row.querySelector('.final-price').textContent        = fmt(finalPrice);

        updateGrandTotal();
    }

    function updateGrandTotal() {
        let total = 0;
        document.querySelectorAll('#calculatorRows .calculator-row').forEach(row => { 

            const price    = parseFloat(row.querySelector('.price-value').value) || 0;
            const otc      = parseFloat(row.querySelector('.otc-value').value) || 0;
            const duration = parseInt(row.querySelector('.duration-input').value) || 1;
            if (price > 0) total += ppn(price) * duration + ppn(otc);
        });
        document.getElementById('grandTotal').textContent = fmt(total);
    }

    function renumberRows() {
        document.querySelectorAll('.calculator-row').forEach((row, idx) => {
            row.querySelectorAll('select[name], input[name]').forEach(field => {
                field.name = field.name.replace(/\[\d+\]/, `[${idx}]`);
            });
        });
    }

    // Perubahan durasi & OTC
    document.addEventListener('input', function(e) {
        if (e.target.classList.contains('duration-input')) {
            updateRow(e.target.closest('.calculator-row'));
        }
    });
    document.addEventListener('change', function(e) {
        if (e.target.classList.contains('otc-select')) {
            const row = e.target.closest('.calculator-row');
            const otc = parseFloat(e.target.selectedOptions[0].dataset.price || 0);
            row.querySelector('.otc-value').value = otc;
            row.querySelector('.otc-display').textContent = fmt(otc);
            updateRow(row);
        }
    });

    // Tambah baris
    document.getElementById('addRow').addEventListener('click', function() {
        const frag = document.querySelector('#row-template').content.cloneNode(true);
        const newRow = frag.querySelector('tr.calculator-row');

        const lastCat = document.querySelector('#calculatorRows .calculator-row:last-child .category-select');
        if (lastCat && newRow.querySelector('.category-select')) {
            newRow.querySelector('.category-select').value = lastCat.value;
        }

        document.getElementById('calculatorRows').appendChild(frag);
        const appendedRow = document.querySelector('#calculatorRows .calculator-row:last-child');

        renumberRows();
        initSelect2ForRow(appendedRow);
    });

    // Hapus baris
    document.addEventListener('click', function(e) {
        if (e.target.closest('.remove-row')) {
            const row = e.target.closest('.calculator-row');
            const rows = document.querySelectorAll('.calculator-row');
            if (rows.length > 1) {
                const $prod = $(row).find('.product-select');
                if ($prod.data('select2')) { $prod.select2('destroy'); }
                row.remove();
                renumberRows();
                updateGrandTotal();
            } else {
                alert('Minimal satu baris wajib ada.');
            }
        }
    });

    // Reset form
    document.getElementById('resetBtn').addEventListener('click', function() {
        if (!confirm('Apakah Anda yakin ingin reset semua data?')) return;

        document.querySelectorAll('.calculator-row').forEach(row => {
            const $prod = $(row).find('.product-select');
            $prod.val(null).trigger('change');
            row.querySelector('.price-value').value = 0;
            row.querySelector('.otc-value').value = 0;
            row.querySelector('.price-display').textContent = fmt(0);
            row.querySelector('.otc-display').textContent = fmt(0);
            row.querySelector('.price-with-ppn').textContent = fmt(0);
            row.querySelector('.price-duration').textContent = fmt(0);
            row.querySelector('.final-price-no-ppn').textContent = fmt(0);
            row.querySelector('.final-price').textContent = fmt(0);
            row.querySelector('.duration-input').value = 1;
            row.querySelector('.otc-select').value = 'FREE/MO';
        });
        updateGrandTotal();
    });

            // Print PDF
        document.getElementById('printPdfBtn').addEventListener('click', function() {
            const url = this.dataset.printUrl;
            const title = document.getElementById('calculationTitle').value || 'Kalkulator Pots';

            // Ambil data dari form (items per row)
            const items = [];
            document.querySelectorAll('#calculatorRows .calculator-row').forEach((row, idx) => {
                items.push({
                    category_id: row.querySelector('.category-select')?.value || '',
                    product_id: row.querySelector('.product-select')?.value || '',
                    otc_category: row.querySelector('.otc-select')?.value || '',
                    price: row.querySelector('.price-value')?.value || 0,
                    otc: row.querySelector('.otc-value')?.value || 0,
                    duration: row.querySelector('.duration-input')?.value || 1,
                });
            });

            // Buat form dinamis POST
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = url;
            form.target = '_blank';

            // CSRF
            const csrf = document.querySelector('meta[name="csrf-token"]').content;
            const inputCsrf = document.createElement('input');
            inputCsrf.type = 'hidden';
            inputCsrf.name = '_token';
            inputCsrf.value = csrf;
            form.appendChild(inputCsrf);

            // Title
            const inputTitle = document.createElement('input');
            inputTitle.type = 'hidden';
            inputTitle.name = 'calculationTitle';
            inputTitle.value = title;
            form.appendChild(inputTitle);

            // Items
            const inputItems = document.createElement('input');
            inputItems.type = 'hidden';
            inputItems.name = 'items';
            inputItems.value = JSON.stringify(items);
            form.appendChild(inputItems);

            document.body.appendChild(form);
            form.submit();
            form.remove();
        });

    // Init baris pertama
    initSelect2ForRow(document.querySelector('.calculator-row'));
});
</script>
@endpush
