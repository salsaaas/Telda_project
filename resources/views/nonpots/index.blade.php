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

        <form id="calculatorForm">
            @csrf
            <div class="table-responsive" style="overflow-x: auto;">
                <table class="table table-bordered text-center" style="min-width: 2000px; width: 100%;">
                    <thead class="table-light">
                        <tr>
                        <th style="min-width: 150px;">Category Product</th>
                        <th style="min-width: 450px;">Product Name</th>
                        <th style="min-width: 180px;">Skema</th>
                        <th style="min-width: 80px;">Qty</th>
                        <th style="min-width: 2px;">Price (Rp)</th>
                        <th style="min-width: 120px;">OTC (Rp)</th>
                        <th style="min-width: 130px;">Discont Price</th>
                        <th style="min-width: 130px;">Discont OTC</th>
                        <th style="min-width: 150px;">Price x Discount</th>
                        <th style="min-width: 150px;">OTC x Discount</th>
                        <th style="min-width: 120px;">Duration (Bulan)</th>
                        <th style="min-width: 120px;">OTC</th>
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
                                            data-discount="{{ $product->discount_price }}"
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
                            <td><input type="number" name="items[0][qty]" class="form-control qty-input" value="1" min="1" required></td>
                            <td><span class="price-display">Rp 0</span><input type="hidden" name="items[0][price]" class="price-value" value="0"></td>
                            <td><span class="otc-display">Rp 0</span><input type="hidden" name="items[0][otc]" class="otc-value" value="0"></td>
                            <td><span class="discounted-price">Rp 0</span></td>
                            <td><span class="discounted-otc">Rp 0</span></td>
                            <td><span class="price-times-discount">Rp 0</span></td>
                            <td><span class="otc-times-discount">Rp 0</span></td>
                            <td><input type="number" name="items[0][duration]" class="form-control duration-input" min="1" value="1" required style="width: 80px;"></td>
                            <td><span class="monthly-otc">Rp 0</span></td>
                            <td><span class="monthly-price">Rp 0</span></td>
                            <td><span class="monthly-price-ppn">Rp 0</span></td>
                            <td><span class="yearly-price">Rp 0</span></td>
                            <td><span class="final-price-ppn text-success">Rp 0</span></td>
                            <td><button type="button" class="btn btn-danger btn-sm remove-row"><i class="fas fa-trash"></i> Hapus</button></td>
                        </tr>
                    </tbody>
                </table>
                <button type="button" class="btn btn-success btn-sm mt-2" id="addRowBtn"><i class="fas fa-plus"></i> Tambah Baris</button>
            </div>
             <div class="d-flex align-items-center">
                    <span class="me-3"><strong>Total Keseluruhan: <span id="grandTotal" class="text-danger">Rp 0</span></strong></span>
                    <button type="button" class="btn btn-secondary me-2" id="resetBtn">
                        <i class="fas fa-undo"></i> Reset
                    </button>
                    <button type="button" class="btn btn-navy" id="printPdfBtn">
                        <i class="fas fa-file-pdf"></i> Print PDF
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    function formatCurrency(amount) {
        return 'Rp ' + new Intl.NumberFormat('id-ID').format(Math.round(amount));
    }

    function calculatePPN(price) {
        return price * 1.11;
    }

    function updateRow(row) {
        const qty = parseInt(row.querySelector('.qty-input').value) || 1;
        const duration = parseInt(row.querySelector('.duration-input').value) || 1;

        const basePrice = parseFloat(row.querySelector('.price-value').value) || 0;
        const otc = parseFloat(row.querySelector('.otc-value').value) || 0;
        const discountPrice = basePrice; // bisa diganti jika logika diskon berubah

        const totalPrice = basePrice * qty;
        const totalOtc = otc * qty;

        const ppnPrice = calculatePPN(totalPrice);
        const finalPrice = (ppnPrice * duration) + (totalOtc * 1.11);

        row.querySelector('.price-display').textContent = formatCurrency(totalPrice);
        row.querySelector('.discounted-price').textContent = formatCurrency(discountPrice);
        row.querySelector('.price-times-discount').textContent = formatCurrency(discountPrice * qty);
        row.querySelector('.otc-display').textContent = formatCurrency(totalOtc);
        row.querySelector('.otc-times-discount').textContent = formatCurrency(totalOtc);
        row.querySelector('.monthly-price').textContent = formatCurrency(totalPrice);
        row.querySelector('.monthly-price-ppn').textContent = formatCurrency(ppnPrice);
        row.querySelector('.monthly-otc').textContent = formatCurrency(totalOtc);
        row.querySelector('.yearly-price').textContent = formatCurrency(totalPrice * 12);
        row.querySelector('.final-price-ppn').textContent = formatCurrency(finalPrice);
    }

    function attachRowEvents(row) {
        row.querySelector('.category-select').addEventListener('change', function () {
            const categoryId = this.value;
            const productSelect = row.querySelector('.product-select');
            productSelect.value = '';
            Array.from(productSelect.options).forEach(option => {
                option.style.display = option.dataset.category === categoryId || option.value === '' ? 'block' : 'none';
            });
            row.querySelector('.price-value').value = 0;
            updateRow(row);
        });

        row.querySelector('.product-select').addEventListener('change', function () {
            const selected = this.selectedOptions[0];
            const price = parseFloat(selected.dataset.price) || 0;
            row.querySelector('.price-value').value = price;
            updateRow(row);
        });

        row.querySelector('.otc-select').addEventListener('change', function () {
            const selected = this.selectedOptions[0];
            const otcPrice = parseFloat(selected.dataset.price) || 0;
            row.querySelector('.otc-value').value = otcPrice;
            updateRow(row);
        });

        row.querySelector('.qty-input').addEventListener('input', () => updateRow(row));
        row.querySelector('.duration-input').addEventListener('input', () => updateRow(row));
        row.querySelector('.remove-row').addEventListener('click', () => {
    row.querySelectorAll('input').forEach(input => {
        if (input.type === 'number') {
            input.value = 1;
        } else {
            input.value = '';
        }
    });

    row.querySelectorAll('select').forEach(select => {
        select.selectedIndex = 0;
    });

    row.querySelectorAll('span').forEach(span => {
        span.textContent = 'Rp 0';
    });

    row.querySelector('.price-value').value = 0;
    row.querySelector('.otc-value').value = 0;
});

    }

    function addRow() {
        const rowCount = document.querySelectorAll('.calculator-row').length;
        const templateRow = document.querySelector('.calculator-row');
        const newRow = templateRow.cloneNode(true);

        newRow.querySelectorAll('input, select').forEach((el) => {
            if (el.name) el.name = el.name.replace(/\[\d+\]/, `[${rowCount}]`);
            if (el.tagName === 'SELECT') el.selectedIndex = 0;
            else if (el.type === 'number') el.value = 1;
            else el.value = '';
        });

        newRow.querySelectorAll('span').forEach(span => span.textContent = 'Rp 0');

        document.getElementById('calculatorRows').appendChild(newRow);
        attachRowEvents(newRow);
    }

    document.querySelectorAll('.calculator-row').forEach(row => attachRowEvents(row));
    document.getElementById('addRowBtn').addEventListener('click', addRow);
});
</script>
@endpush
