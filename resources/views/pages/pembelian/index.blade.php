@extends('layouts.app')

@section('content')
    <div class="p-6 min-h-screen">
        <!-- Judul -->
        <div class="flex justify-between">
            <h1 class="text-2xl font-bold text-gray-800 mb-6">Purchase Order</h1>
            <div class="w-[10rem]">
                <button type="button"
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
                        <?php $no = 1; ?>
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection