@extends('layouts.app')

@section('content')
    <div class="p-6 min-h-screen">
        <!-- Judul -->
        <div class="flex justify-between">
            <h1 class="text-2xl font-bold text-gray-800 mb-6">Purchase Order</h1>
            <div class="w-[10rem]">
                <button type="button" data-modal-target="modalDetail" data-modal-toggle="modalDetail"
                    class="w-full cursor-pointer bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-4 rounded-md shadow transition duration-200">
                    + Buat PO
                </button>
            </div>
        </div>

        <div class="bg-white shadow rounded-lg overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col"
                                class="px-3 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                No
                            </th>
                            <th scope="col"
                                class="px-3 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Tanggal Order
                            </th>
                            <th scope="col"
                                class="px-3 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Nomor PO
                            </th>
                            <th scope="col"
                                class="px-3 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Nama Supplier
                            </th>
                            <th scope="col"
                                class="px-3 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Grandtotal
                            </th>
                            <th scope="col"
                                class="px-3 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200 text-center">
                        <?php $no = 1; ?>
                        @forelse($dataPO as $po)
                        <tr class="hover:bg-gray-50 transition-colors duration-150">
                            <td class="px-3 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $no++ }}
                            </td>
                            <td class="px-3 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $po->tanggal_order }}
                            </td>   
                            <td class="px-3 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $po->nomor_purchase_order }}
                            </td>
                            <td class="px-3 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $po->supplier->nama_supplier }}
                            </td>
                            <td class="px-3 py-4 whitespace-nowrap text-sm text-gray-500">
                                Rp. {{ number_format($po->grandtotal, 0, ',', '.') }}
                            </td>
                            <td class="px-3 py-4 whitespace-nowrap text-sm text-gray-500 space-x-2 flex justify-center">
                                <button type="button" data-id="{{ $po->id }}" data-nomor="{{ $po->nomor_purchase_order }}" data-modal-target="modalPODetail" data-modal-toggle="modalPODetail"
                                    class="btn-detail inline-flex cursor-pointer items-center px-3 py-1 bg-yellow-100 text-yellow-700 rounded-md hover:bg-yellow-200 transition">
                                    <i class="fas fa-eye mr-1"></i> Detail
                                </button>
                            </td>
                        </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-3 py-4 text-center text-sm text-gray-500 hover:bg-gray-50 transition-colors duration-150 tracking-wider">
                                    Tidak ada data pembelian
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div id="modalDetail" tabindex="-1" aria-hidden="true" class="modalDetail hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-[90%] max-w-full max-h-full">
            <div class="relative bg-white rounded-lg shadow-sm">
                <div class="flex items-center justify-between p-4 md:p-5">
                    <h3 class="titleModalDetail text-xl font-semibold text-gray-900">
                        Purchase Order Detail
                    </h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-100 hover:text-gray-400 rounded-full text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-hide="modalDetail">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <div class="px-4 pb-4">
                    <form id="poForm" class="space-y-4">
                        <input type="hidden" name="id" id="id">
                        <!-- Supplier -->
                        <div>
                            <label for="supplier_id" class="block text-sm font-medium text-gray-700">Supplier</label>
                            <select id="supplier_id" name="supplier_id"
                                 class="block w-full px-4 py-2 text-sm border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-black-500 focus:border-black-500" required>
                                <option value="" disabled selected>Pilih supplier</option>
                                @foreach($dataSupplier as $supplier) 
                                <option value="{{ $supplier->id }}">{{ $supplier->kode_supplier }} - {{ $supplier->nama_supplier }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <!-- Produk -->
                            <div>
                                <label for="product_id" class="block text-sm font-medium text-gray-700">Produk</label>
                                <select id="product_id" name="product_id"
                                    class="block w-full px-4 py-2 text-sm border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-black-500 focus:border-black-500" required>
                                    <option value="" disabled selected>Pilih produk</option>
                                    @foreach($dataProduct as $product) 
                                    <option value="{{ $product->id }}">{{ $product->kode_product }} - {{ $product->nama_product }} / Rp. {{ number_format($product->harga_beli, 0, ',', '.') }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Quantity -->
                            <div>
                                <label for="qty" class="block text-sm font-medium text-gray-700">Quantity Order</label>
                                <input type="number" name="qty" id="qty" value="1" min="1"
                                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                            </div>
                        </div>
                        
                        <!-- Tombol Submit -->
                        <div class="flex items-end">
                            <button type="button" id="addProduct"
                                class="addProduct w-full cursor-pointer bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-4 rounded-md shadow transition duration-200">
                                Add Product
                            </button>
                        </div>
                    </form>
                </div>
                <div class="px-4">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col"
                                        class="px-3 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        No
                                    </th>
                                    <th scope="col"
                                        class="px-3 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Kode Produk
                                    </th>
                                    <th scope="col"
                                        class="px-3 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Nama Produk
                                    </th>
                                    <th scope="col"
                                        class="px-3 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Quantity Order
                                    </th>
                                    <th scope="col"
                                        class="px-3 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Subtotal
                                    </th>
                                    <th scope="col"
                                        class="px-3 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Aksi
                                    </th>
                                </tr>
                            </thead>
                            <tbody id="bodyDetail" class="bg-white divide-y divide-gray-200 text-center">
                                <tr>
                                    <td colspan="7" class="px-3 py-4 text-center text-sm text-gray-500 hover:bg-gray-50 transition-colors duration-150 tracking-wider">
                                        Tidak ada data pembelian detail
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="flex items-end py-4">
                        <button type="button" id="createPO"
                            class="createPO w-full cursor-pointer bg-indigo-600 hover:from-indigo-700 hover:to-purple-700 text-white font-semibold py-2 px-4 rounded-md shadow transition duration-200">
                            Simpan Purchase Order
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="modalPODetail" tabindex="-1" aria-hidden="true" class="modalPODetail hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-[90%] max-w-full max-h-full">
            <div class="relative bg-white rounded-lg shadow-sm">
                <div class="flex items-center justify-between p-4 md:p-5">
                    <h3 class="titleModalPODetail text-xl font-semibold text-gray-900">
                        Purchase Order
                    </h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-100 hover:text-gray-400 rounded-full text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-hide="modalPODetail">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>

                <div class="p-4">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col"
                                        class="px-3 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        No
                                    </th>
                                    <th scope="col"
                                        class="px-3 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Kode Produk
                                    </th>
                                    <th scope="col"
                                        class="px-3 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Nama Produk
                                    </th>
                                    <th scope="col"
                                        class="px-3 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Quantity Order
                                    </th>
                                    <th scope="col"
                                        class="px-3 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Subtotal
                                    </th>
                                </tr>
                            </thead>
                            <tbody id="bodyPODetail" class="bg-white divide-y divide-gray-200 text-center">
                                <tr>
                                    <td colspan="7" class="px-3 py-4 text-center text-sm text-gray-500 hover:bg-gray-50 transition-colors duration-150 tracking-wider">
                                        Tidak ada data purchase order detail
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        const cart = [];

    function renderCart() {
        const $cart = $('#bodyDetail');
        $cart.empty();
        let total = 0;

        if (cart.length === 0) {
            return;
        }

        let no = 1;

        $.each(cart, function (index, item) {
            item.qty = item.qty || 1;
            total += item.price * item.qty;

            const itemHtml = `
            <tr>
                <td class="px-3 py-4 text-center text-sm text-gray-500 hover:bg-gray-50 transition-colors duration-150 tracking-wider">
                    ${no++}
                </td>
                <td class="px-3 py-4 text-center text-sm text-gray-500 hover:bg-gray-50 transition-colors duration-150 tracking-wider">
                    ${item.kodeProduk}
                </td>
                <td class="px-3 py-4 text-center text-sm text-gray-500 hover:bg-gray-50 transition-colors duration-150 tracking-wider">
                    ${item.namaProduk}
                </td>
                <td class="px-3 py-4 text-center text-sm text-gray-500 hover:bg-gray-50 transition-colors duration-150 tracking-wider">
                    <button type="button" class="text-red-600 hover:text-red-800 qty-btn text-2xl mr-2" data-index="${index}" data-action="-1">-</button>
                    ${item.qty}
                    <button type="button" class="text-green-600 hover:text-green-800 qty-btn text-2xl ml-2" data-index="${index}" data-action="1">+</button>
                </td>
                <td class="px-3 py-4 text-center text-sm text-gray-500 hover:bg-gray-50 transition-colors duration-150 tracking-wider">
                    Rp. ${item.subtotal.toLocaleString()}
                </td>
                <td class="px-3 py-4 whitespace-nowrap text-sm text-gray-500 space-x-2 flex justify-center">
                    <button type="button" data-i="${index}"
                        class="btn-delete inline-flex cursor-pointer items-center px-3 py-1 bg-red-100 text-red-700 rounded-md hover:bg-red-200 transition">
                        <i class="fas fa-trash-alt mr-1"></i> Hapus
                    </button>
                </td>
            </tr>
            `;

            $cart.append(itemHtml);
        });
    }

    $('.addProduct').on('click', function () {
        var product = $('#product_id option:selected').text();
        var id = $('#product_id option:selected').val();
        var qtyRaw = $('#qty').val()
        var qty = parseInt(qtyRaw)

        
        const productData = product.split(' - ')
        const productDataSplit = productData[1]
        const productDataSplitted = productDataSplit.split(' / ')
        
        const kodeProduk = productData[0];
        const namaProduk = productDataSplitted[0]
        const hargaBeliRaw = productDataSplitted[1]
        const hargaBeli = parseInt(hargaBeliRaw.replace(/\D/g, ''), 10);
        const subtotal = qty * hargaBeli;
        

        const existing = cart.find(item => item.id === id);

        if (existing) {
            existing.qty = existing.qty || 1;
            existing.qty += qty;
        } else {
            cart.push({ id, kodeProduk, namaProduk, qty, subtotal });
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

    $('#createPO').on('click', function(e) {
        e.preventDefault()
        const supplierId = $('#supplier_id option:selected').val()

        if(supplierId == '') {
            showNotification('Error', 'Supplier tolong dipilih', 'error')
            return
        }
        
        if(cart.length == 0) {
            showNotification('Error', 'Produk belum terpilih', 'error')
            return
        }

        const totalHarga = cart.reduce((sum, item) => sum + item.subtotal, 0);

        $.ajax({
            url: "{{ route('purchase_order.store') }}",
            method: "POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                grandtotal: totalHarga,
                products: cart,
                supplier_id: supplierId,
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

    })

    $('.btn-detail').on('click', function() {
        const pembelianId = $(this).data('id')
        const nomorPO = $(this).data('nomor')

        $('.titleModalPODetail').text(`Purchase Order No. ${nomorPO}`)

        $('#bodyPODetail').empty()

        $.ajax({
            url: "{{ route('purchase_order.getPODetail', ':id') }}".replace(':id', pembelianId),
            method: 'GET',
            success: function(res) {
                if(res.status == 'success') {
                    let no = 1;

                    showNotification('Success', res.message, res.status)
                
                    $.each(res.data, function(key, value) {
                        let bodyTable = `
                            <tr class="hover:bg-gray-50 transition-colors duration-150">
                                <td class="px-3 py-4 whitespace-nowrap text-sm text-gray-500">
                                    ${no++}
                                </td>
                                <td class="px-3 py-4 whitespace-nowrap text-sm text-gray-500">
                                    ${value.product.kode_product}
                                </td>   
                                <td class="px-3 py-4 whitespace-nowrap text-sm text-gray-500">
                                    ${value.product.nama_product}
                                </td>
                                <td class="px-3 py-4 whitespace-nowrap text-sm text-gray-500">
                                    ${value.qty}
                                </td>
                                <td class="px-3 py-4 whitespace-nowrap text-sm text-gray-500">
                                    Rp. ${value.subtotal.toLocaleString()}
                                </td>
                            </tr>`

                        $('#bodyPODetail').append(bodyTable)
                    })

                    if(no == 1) {
                        $('#bodyPODetail').append(`
                            <tr>
                                <td colspan="7" class="px-3 py-4 text-center text-sm text-gray-500 hover:bg-gray-50 transition-colors duration-150 tracking-wider">
                                    Tidak ada data purchase order detail
                                </td>
                            </tr>
                        `)
                    }
                }
            }
        })
    })

    
})
</script>
@endpush