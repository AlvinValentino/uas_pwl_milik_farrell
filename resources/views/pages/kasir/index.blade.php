@extends('layouts.app')

@section('content')
<div class="p-6 min-h-screen">
    <h1 class="text-3xl font-bold mb-6 text-gray-800">POS - Point of Sale</h1>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Produk List -->
        <div class="lg:col-span-2 bg-white p-5 rounded-lg shadow-md">
            <h2 class="text-xl font-semibold mb-4 text-gray-700">Daftar Produk</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                @foreach ($products as $product)
                    <div class="border border-gray-200 bg-white shadow-sm rounded-lg p-4 hover:bg-blue-50 cursor-pointer product-item transition transform hover:scale-105"
                         data-id="{{ $product->id }}"
                         data-name="{{ $product->nama_product }}"
                         data-price="{{ $product->harga_jual }}">
                        <h3 class="font-medium text-gray-800">{{ $product->kode_product }} - {{ $product->nama_product }}</h3>
                        <p class="text-sm text-gray-600 mt-1">Rp {{ number_format($product->harga_jual, 0, ',', '.') }}</p>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Keranjang -->
        <div class="bg-white p-5 rounded-lg shadow-md flex flex-col h-full">
            <h2 class="text-xl font-semibold mb-4 text-gray-700">Keranjang</h2>
            <ul id="cart" class="cart mb-4 space-y-3 flex-grow overflow-auto">
                <!-- Cart items akan muncul di sini -->
                <span id="cart-empty-message" class="cart-span text-sm text-gray-500">Tidak ada produk yang ditambahkan!</span>
            </ul>

            <div class="mt-4 pt-4 border-t border-gray-200">
                <div class="flex justify-between items-center mb-2">
                    <strong class="text-gray-700">Total:</strong>
                    <span id="cart-total" class="text-lg font-bold text-gray-900">Rp 0</span>
                </div>

                <form id="pos-form" class="space-y-3">
                    <div>
                        <label for="payment" class="block text-sm font-medium text-gray-700">Bayar</label>
                        <div class="relative mt-1 rounded-md shadow-sm">
                            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                <span class="sm:text-sm">Rp</span>
                            </div>
                            <input type="number" name="payment" id="payment"
                                class="t-1 block w-full pl-9 pr-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                placeholder="0" required>
                        </div>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Kembalian</label>
                        <div id="change" class="mt-1 px-3 py-2 bg-gray-100 rounded-md font-medium">Rp 0</div>
                    </div>

                    <button type="submit"
                            class="w-full cursor-pointer bg-indigo-600 text-white py-2 rounded-md hover:from-green-600 hover:to-teal-600 transition duration-300 shadow-md">
                        Simpan Transaksi
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function () {
    const cart = [];

    function renderCart() {
        const $cart = $('#cart');
        $cart.empty();
        let total = 0;

        if (cart.length === 0) {
            $('#cart-total').text('Rp 0');
            $('#change').text('Rp 0');
            return;
        }   

        $.each(cart, function (index, item) {
            item.qty = item.qty || 1;
            total += item.price * item.qty;

            const itemHtml = `
                <li class="flex justify-between items-center bg-gray-50 p-3 rounded-md">
                    <div class="flex gap-4">
                        <span class="text-gray-800">${item.name} x ${item.qty}</span>
                        <span class="font-semibold text-gray-900">Rp ${(item.price * item.qty).toLocaleString()}</span>
                    </div>
                    <div class="flex space-x-2">
                        <button type="button" class="text-green-600 hover:text-green-800 qty-btn text-xl" data-index="${index}" data-action="1">+</button>
                        <button type="button" class="text-red-600 hover:text-red-800 qty-btn text-xl" data-index="${index}" data-action="-1">-</button>
                    </div>
                </li>
            `;

            $cart.append(itemHtml);
        });

        $('#cart-total').text('Rp ' + total.toLocaleString());

        $('#payment').off('input').on('input', function () {
            const paid = parseInt($(this).val()) || 0;
            $('#change').text('Rp ' + Math.max(paid - total, 0).toLocaleString());
        });
    }

    $('.product-item').on('click', function () {
        const id = $(this).data('id');
        const name = $(this).data('name');
        const price = parseInt($(this).data('price'));

        const existing = cart.find(item => item.id === id);

        if (existing) {
            existing.qty = existing.qty || 1;
            existing.qty += 1;
        } else {
            cart.push({ id, name, price, qty: 1 });
        }

        renderCart();
    });

    $(document).on('click', '.qty-btn', function () {
        const index = $(this).data('index');
        const delta = parseInt($(this).data('action'));

        if (cart[index]) {
            cart[index].qty = cart[index].qty || 1;
            cart[index].qty += delta;

            if (cart[index].qty <= 0) {
                cart.splice(index, 1);
            }

            renderCart();
        }
    });

    $('#pos-form').on('submit', function (e) {
        e.preventDefault();

        const totalHarga = cart.reduce((sum, item) => sum + item.price * item.qty, 0);
        const payment = parseInt($('#payment').val()) || 0;

        if (payment < totalHarga) {
            showNotification("Uang tidak cukup!", "Pembayaran tidak cukup!", "error");
            return;
        }

        $.ajax({
            url: "{{ route('penjualan.store') }}",
            method: "POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                grandtotal: totalHarga,
                products: cart
            },
            success: function(res) {
                if (res.status == 'success') {
                    showNotification('Success', res.message, res.status).then(() => {
                        window.location.reload(false)
                    });
                }
            },
            error: function(err) {
                showNotification('Error', err.responseJSON.message, err.responseJSON.status)
            }
        });
    });
});
</script>
@endpush