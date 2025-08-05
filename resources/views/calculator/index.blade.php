@extends('layouts.app')

@section('content')
<div class="card shadow-sm mb-4">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="mb-0">Kalkulator Paket</h4>
            <span class="badge bg-secondary">Total Produk: {{ count($products) }}</span>
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
                <table class="table table-bordered" id="calculatorTable">
                    <thead>
                        <tr>
                            <th>Category Product</th>
                            <th>Product Name</th>
                            <th>Skema</th>
                            <th>Qty</th>
                            <th>Price (Rp)</th>
                            <th>OTC (Rp)</th>
                            <th>Discont Price</th>
                            <th>Discont OTC</th>
                            <th>Price x Discount</th>
                            <th>OTC x Discount</th>
                            <th>Duration (Bulan)</th>
                            <th>OTC</th>
                            <th>Monthly Price</th>
                            <th>Monthly Price with PPN</th>
                            <th>Year Price</th>
                            <th>Final Price with PPN</th>
                            <th>Aksi</th>
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
                                <select name="items[0][otc_category]" class="form-select otc-select" required>
                                    <option value="OTC KONTAN" data-price="0">OTC KONTAN</option>
                                    <option value="AO DISCOUNT" data-price="150000">AO DISCOUNT</option>
                                    <option value="AO NORMAL" data-price="500000">AO NORMAL</option>
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
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('change', function(e) {
    if (e.target.classList.contains('product-select')) {
        const row = e.target.closest('.calculator-row');
        const selected = e.target.selectedOptions[0];
        const price = parseFloat(selected.dataset.price) || 0;
        const discount = parseFloat(selected.dataset.discount) || 0;
        row.querySelector('.price-value').value = price;
        row.querySelector('.price-display').textContent = formatCurrency(price);
        row.querySelector('.discounted-price').textContent = formatCurrency(discount);
        row.querySelector('.price-times-discount').textContent = formatCurrency(price * discount);
        updateRow(row);
    }
    if (e.target.classList.contains('otc-select')) {
        const row = e.target.closest('.calculator-row');
        const selected = e.target.selectedOptions[0];
        const otcPrice = parseFloat(selected.dataset.price) || 0;
        row.querySelector('.otc-value').value = otcPrice;
        row.querySelector('.otc-display').textContent = formatCurrency(otcPrice);
        row.querySelector('.otc-times-discount').textContent = formatCurrency(otcPrice * 1);
        updateRow(row);
    }
    if (e.target.classList.contains('category-select')) {
        const row = e.target.closest('.calculator-row');
        const categoryId = e.target.value;
        const productSelect = row.querySelector('.product-select');
        productSelect.value = '';
        Array.from(productSelect.options).forEach(option => {
            option.style.display = option.dataset.category === categoryId || option.value === '' ? 'block' : 'none';
        });
        row.querySelector('.price-value').value = 0;
        row.querySelector('.price-display').textContent = formatCurrency(0);
        updateRow(row);
    }
});

function formatCurrency(amount) {
    return 'Rp ' + new Intl.NumberFormat('id-ID').format(Math.round(amount));
}

function calculatePPN(price) {
    return price * 1.11;
}

function updateRow(row) {
    const price = parseFloat(row.querySelector('.price-value').value) || 0;
    const discount = parseFloat(row.querySelector('.discounted-price').textContent.replace(/[^\d]/g, '')) || 0;
    const otc = parseFloat(row.querySelector('.otc-value').value) || 0;
    const duration = parseInt(row.querySelector('.duration-input').value) || 1;
    const priceWithPPN = calculatePPN(price);
    const priceDuration = priceWithPPN * duration;
    const finalPriceNoPPN = (price * duration) + otc;
    const finalPrice = priceDuration + (otc * 1.11);
    row.querySelector('.monthly-price').textContent = formatCurrency(price);
    row.querySelector('.monthly-price-ppn').textContent = formatCurrency(priceWithPPN);
    row.querySelector('.yearly-price').textContent = formatCurrency(price * 12);
    row.querySelector('.final-price-ppn').textContent = formatCurrency(finalPrice);
}

function updateGrandTotal() {
    let total = 0;
    document.querySelectorAll('.calculator-row').forEach(row => {
        const price = parseFloat(row.querySelector('.price-value').value) || 0;
        const otc = parseFloat(row.querySelector('.otc-value').value) || 0;
        const duration = parseInt(row.querySelector('.duration-input').value) || 1;
        if (price > 0) {
            const priceWithPPN = calculatePPN(price);
            const priceDuration = priceWithPPN * duration;
            const finalPrice = priceDuration + (otc * 1.11);
            total += finalPrice;
        }
    });
    document.getElementById('grandTotal').textContent = formatCurrency(total);
}
</script>
@endpush