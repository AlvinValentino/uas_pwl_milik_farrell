@extends('layouts.app')

@section('content')
    <div class="p-6">
        <!-- Judul -->
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Manajemen Supplier</h1>

        <!-- Form Input -->
        <div class="bg-white shadow rounded-lg p-6 mb-6">
            <form action="{{ route('supplier.store') }}" id="supplierForm" method="POST" class="space-y-4">
                @csrf

                <input type="hidden" name="id" id="id">
                <div class="grid grid-cols-3 gap-4">
                    <!-- Nama Supplier -->
                    <div>
                        <label for="nama_supplier" class="block text-sm font-medium text-gray-700">Nama Supplier</label>
                        <input type="text" name="nama_supplier" id="nama_supplier"
                            class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                    </div>

                    <!-- No Telp Supplier -->
                    <div>
                        <label for="no_telp_supplier" class="block text-sm font-medium text-gray-700">No. Telp Supplier</label>
                        <input type="text" name="no_telp_supplier" id="no_telp_supplier"
                            class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                    </div>

                    <!-- Email Supplier -->
                    <div>
                        <label for="email_supplier" class="block text-sm font-medium text-gray-700">Email Supplier</label>
                        <input type="text" name="email_supplier" id="email_supplier"
                            class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                    </div>
                </div>

                <!-- Email Supplier -->
                <div>
                    <label for="alamat_supplier" class="block text-sm font-medium text-gray-700">Alamat Supplier</label>
                    <textarea id="alamat_supplier" name="alamat_supplier" rows="5" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required></textarea>
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
                                Nama Supplier
                            </th>
                            <th scope="col"
                                class="px-3 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                No. Telp Supplier
                            </th>
                            <th scope="col"
                                class="px-3 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Email Supplier
                            </th>
                            <th scope="col"
                                class="px-3 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Alamat Supplier
                            </th>
                            <th scope="col"
                                class="px-3 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200 text-center">
                        <?php $no = 1; ?>
                        @forelse($dataSupplier as $supplier)
                            <tr class="hover:bg-gray-50 transition-colors duration-150">
                                <td class="px-3 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $no++ }}
                                </td>
                                <td class="px-3 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $supplier->nama_supplier }}
                                </td>   
                                <td class="px-3 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $supplier->no_telp_supplier }}
                                </td>   
                                <td class="px-3 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $supplier->email_supplier }}
                                </td>   
                                <td class="px-3 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $supplier->alamat_supplier }}
                                </td>   
                                <td class="px-3 py-4 whitespace-nowrap text-sm text-gray-500 space-x-2 flex justify-center">
                                    <button type="button" data-id="{{ $supplier->id }}"
                                        class="btn-edit inline-flex cursor-pointer items-center px-3 py-1 bg-blue-100 text-blue-700 rounded-md hover:bg-blue-200 transition">
                                        <i class="fas fa-edit mr-1"></i> Edit
                                    </button>
                                    <button type="button" data-id="{{ $supplier->id }}" data-kode="{{ $supplier->kode_supplier }}"
                                        class="btn-delete inline-flex cursor-pointer items-center px-3 py-1 bg-red-100 text-red-700 rounded-md hover:bg-red-200 transition">
                                        <i class="fas fa-trash-alt mr-1"></i> Hapus
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-3 py-4 text-center text-sm text-gray-500 hover:bg-gray-50 transition-colors duration-150 tracking-wider">
                                    Tidak ada data supplier
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
                    url: "{{ route('supplier.show', ':id') }}".replace(':id', id),
                    method: 'GET',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(res) {
                        showNotification('Success', res.message, res.status)
                        $('#id').val(res.data.id)
                        $('#nama_supplier').val(res.data.nama_supplier)
                        $('#no_telp_supplier').val(res.data.no_telp_supplier)
                        $('#email_supplier').val(res.data.email_supplier)
                        $('#alamat_supplier').val(res.data.alamat_supplier)
                    }
                })
            })

            $('.btn-delete').on('click', function() {
                const kodeSupplier = $(this).data('kode')
                const id = $(this).data('id')

                Swal.fire({
                    title: `Yakin ingin menghapus supplier dengan kode ${kodeSupplier} ?`,
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
                            url: "{{ route('supplier.destroy', ':id') }}".replace(':id', id),
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

            $('#supplierForm').on('submit', function(e) {
                e.preventDefault()
    
                let formData = $(this).serialize()
                let id = $('#id').val()
    
                $.ajax({
                    url: typeForm == 'store' ? $(this).attr('action') : "{{ route('supplier.update', ':id') }}".replace(':id', id),
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

<style>
textarea {
    resize: none;
}
</style>