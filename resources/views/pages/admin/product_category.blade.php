@extends('layouts.app')

@section('content')
    <div class="p-6">
        <!-- Judul -->
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Manajemen Kategori Produk</h1>

        <!-- Form Input -->
        <div class="bg-white shadow rounded-lg p-6 mb-6">
            <form action="{{ route('product_category.store') }}" id="productCategoryForm" method="POST" class="space-y-4">
                @csrf

                <input type="hidden" name="id" id="id">
                <div class="grid grid-cols-1 gap-4">
                    <!-- Nama Kategori -->
                    <div>
                        <label for="nama_kategori" class="block text-sm font-medium text-gray-700">Nama Kategori Produk</label>
                        <input type="text" name="nama_kategori" id="nama_kategori"
                            class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                    </div>
                </div>
                
                <!-- Tombol Submit -->
                <div class="flex items-end">
                    <button type="submit"
                        class="w-full cursor-pointer bg-indigo-600 hover:from-indigo-700 hover:to-purple-700 text-white font-semibold py-2 px-4 rounded-md shadow transition duration-200">
                        Simpan
                    </button>
                </div>
            </form>
        </div>

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
                                Nama Kategori Produk
                            </th>
                            <th scope="col"
                                class="px-3 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200 text-center">
                        <?php $no = 1; ?>
                        @forelse($dataCategory as $category)
                        <tr class="hover:bg-gray-50 transition-colors duration-150">
                            <td class="px-3 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $no++ }}
                            </td>
                            <td class="px-3 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $category->nama_kategori }}
                            </td>   
                            <td class="px-3 py-4 whitespace-nowrap text-sm text-gray-500 space-x-2 flex justify-center">
                                <button type="button" data-id="{{ $category->id }}"
                                    class="btn-edit inline-flex cursor-pointer items-center px-3 py-1 bg-blue-100 text-blue-700 rounded-md hover:bg-blue-200 transition">
                                    <i class="fas fa-edit mr-1"></i> Edit
                                </button>
                                <button type="button" data-id="{{ $category->id }}" data-nama="{{ $category->nama_kategori }}"
                                    class="btn-delete inline-flex cursor-pointer items-center px-3 py-1 bg-red-100 text-red-700 rounded-md hover:bg-red-200 transition">
                                    <i class="fas fa-trash-alt mr-1"></i> Hapus
                                </button>
                            </td>
                        </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-3 py-4 text-center text-sm text-gray-500 hover:bg-gray-50 transition-colors duration-150 tracking-wider">
                                    Tidak ada data kategori produk
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        let typeForm = 'store'

        $(document).ready(function() {
            $('.btn-edit').on('click', function() {
                let id = $(this).data('id')
                typeForm = 'update'

                $.ajax({
                    url: "{{ route('product_category.show', ':id') }}".replace(':id', id),
                    method: 'GET',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(res) {
                        showNotification('Success', res.message, res.status)
                        $('#id').val(res.data.id)
                        $('#nama_kategori').val(res.data.nama_kategori)
                    }
                })
            })

            $('.btn-delete').on('click', function() {
                const namaKategori = $(this).data('nama')
                const id = $(this).data('id')

                Swal.fire({
                    title: `Yakin ingin menghapus kategori produk dengan nama `,
                    text: "Data ini akan dihapus permanen!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "{{ route('product_category.destroy', ':id') }}".replace(':id', id),
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function(res) {
                                if(res.status == 'success') {
                                    showNotification('Success', res.message, res.status).then(() => {
                                        window.location.reload(false);
                                    });
                                }
                            },
                            error: function(err) {
                                showNotification('Error', err.responseJSON.message, err.responseJSON.status)
                            }
                        })
                    }
                });
            })

            $('#productCategoryForm').on('submit', function(e) {
                e.preventDefault()
    
                let formData = $(this).serialize()
                let id = $('#id').val()
    
                $.ajax({
                    url: typeForm == 'store' ? $(this).attr('action') : "{{ route('product_category.update', ':id') }}".replace(':id', id),
                    method: typeForm == 'store' ? 'POST' : 'PUT',
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(res) {
                        if(res.status == 'success') {
                            showNotification('Success', res.message, res.status).then(() => {
                                window.location.reload(false);
                            });
                        }
                    },
                    error: function(err) {
                        showNotification('Error', err.responseJSON.message, err.responseJSON.status)
                    }
                })
            })
        })
    </script>
@endpush