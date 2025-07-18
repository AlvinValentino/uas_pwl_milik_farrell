@extends('layouts.app')

@section('content')
    <div class="p-6">
        <!-- Judul -->
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Laporan Penjualan</h1>

        <!-- Tabel Data -->
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
                                Tanggal Jual
                            </th>
                            <th scope="col"
                                class="px-3 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Nomor Penjualan
                            </th>
                            <th scope="col"
                                class="px-3 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Nama Kasir
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
                        @forelse($dataPenjualan as $penjualan)
                        <tr class="hover:bg-gray-50 transition-colors duration-150">
                            <td class="px-3 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $no++ }}
                            </td>
                            <td class="px-3 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $penjualan->tanggal_jual }}
                            </td>   
                            <td class="px-3 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $penjualan->nomor_penjualan }}
                            </td>
                            <td class="px-3 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $penjualan->user->name }}
                            </td>
                            <td class="px-3 py-4 whitespace-nowrap text-sm text-gray-500">
                                Rp. {{ number_format($penjualan->grandtotal, 0, ',', '.') }}
                            </td>
                            <td class="px-3 py-4 whitespace-nowrap text-sm text-gray-500 space-x-2 flex justify-center">
                                <button type="button" data-id="{{ $penjualan->id }}" data-nomor="{{ $penjualan->nomor_penjualan }}" data-modal-target="modalDetail" data-modal-toggle="modalDetail"
                                    class="btn-detail inline-flex cursor-pointer items-center px-3 py-1 bg-yellow-100 text-yellow-700 rounded-md hover:bg-yellow-200 transition">
                                    <i class="fas fa-eye mr-1"></i> Detail
                                </button>
                            </td>
                        </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-3 py-4 text-center text-sm text-gray-500 hover:bg-gray-50 transition-colors duration-150 tracking-wider">
                                    Tidak ada data laporan penjualan
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
                        Laporan Penjualan
                    </h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-100 hover:text-gray-400 rounded-full text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-hide="modalDetail">
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
                                        Quantity Terjual
                                    </th>
                                    <th scope="col"
                                        class="px-3 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Subtotal
                                    </th>
                                </tr>
                            </thead>
                            <tbody id="bodyDetail" class="bg-white divide-y divide-gray-200 text-center">
                                <tr>
                                    <td colspan="7" class="px-3 py-4 text-center text-sm text-gray-500 hover:bg-gray-50 transition-colors duration-150 tracking-wider">
                                        Tidak ada data laporan penjualan
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
            function formatRibuan(angka) {
                return angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
            }

            $('.btn-detail').on('click', function() {
                const penjualanId = $(this).data('id')
                const nomorPenjualan = $(this).data('nomor')

                $('.titleModalDetail').text(`Laporan Penjualan No. ${nomorPenjualan}`)

                $.ajax({
                    url: "{{ route('laporan_penjualan.getPenjualanDetail', ':id') }}".replace(':id', penjualanId),
                    method: 'GET',
                    success: function(res) {
                        if(res.status == 'success') {
                            let no = 1;

                            showNotification('Success', res.message, res.status)
                            $('#bodyDetail').empty()
                        
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
                                            Rp. ${formatRibuan(value.subtotal)}
                                        </td>
                                    </tr>`
    
                                $('#bodyDetail').append(bodyTable)
                            })

                            if(no == 1) {
                                $('#bodyDetail').append(`
                                    <tr>
                                        <td colspan="7" class="px-3 py-4 text-center text-sm text-gray-500 hover:bg-gray-50 transition-colors duration-150 tracking-wider">
                                            Tidak ada data laporan penjualan
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