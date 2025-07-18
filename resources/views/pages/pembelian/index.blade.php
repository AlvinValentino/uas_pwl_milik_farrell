@extends('layouts.app')

@section('content')
    <div class="p-6 min-h-screen">
        <!-- Judul -->
        <div class="flex justify-between">
            <h1 class="text-2xl font-bold text-gray-800 mb-6">Purchase Order</h1>
            <div class="w-[10rem]">
                <button type="button" data-modal-target="modalDetail" data-modal-toggle="modalDetail"
                    class="w-full cursor-pointer bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-4 rounded-md shadow transition duration-200">
                    Buat PO
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
                                Status
                            </th>
                            <th scope="col"
                                class="px-3 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200 text-center">
                        <tr>
                            <td colspan="7" class="px-3 py-4 text-center text-sm text-gray-500 hover:bg-gray-50 transition-colors duration-150 tracking-wider">
                                Tidak ada data pembelian
                            </td>
                        </tr>
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
                    <form action="{{ route('product.store') }}" id="productForm" method="POST" class="space-y-4">
                        @csrf
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
                                    <option value="{{ $product->id }}">{{ $product->kode_product }} - {{ $product->nama_product }}</option>
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
                            <button type="button"
                                class="w-full cursor-pointer bg-indigo-600 hover:from-indigo-700 hover:to-purple-700 text-white font-semibold py-2 px-4 rounded-md shadow transition duration-200">
                                Add Product
                            </button>
                        </div>
                    </form>
                </div>
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
                </div>
            </div>
        </div>
    </div>
@endsection