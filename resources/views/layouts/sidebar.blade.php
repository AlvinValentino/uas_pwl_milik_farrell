<aside aria-label="Sidebar" class="w-[15rem] h-full fixed left-0 top-0 bottom-0 overflow-y-auto bg-gradient-to-b from-white to-gray-50 border border-gray-200 p-6 flex flex-col shadow-lg">
    <!-- Header -->
    <div>
        <div class="flex items-center justify-between mb-8">
            <div class="flex items-center space-x-3">
                <div aria-hidden="true" class="w-10 h-10 rounded-lg bg-indigo-600 flex items-center justify-center text-white font-bold text-xl select-none shadow-md">
                    L
                </div>
                <div>
                    <h1 class="text-gray-900 font-bold text-lg leading-tight">
                        Larisin
                    </h1>
                    <p class="text-indigo-600 text-xs font-semibold uppercase tracking-wider">
                        APLIKASI POS
                    </p>
                </div>
            </div>

            <button id="toggleSidebar" class="text-gray-400 hover:text-gray-600 focus:outline-none lg:hidden">
                <i class="fas fa-times"></i>
            </button>
        </div>
        
        <ul class="space-y-1 text-gray-700 text-sm font-medium mb-4">
            <li>
                <a href="/dashboard" class="flex items-center space-x-2 px-3 py-2 rounded-lg transition-colors duration-200
                    @if(Request::is('dashboard')){{ 'bg-indigo-50 text-indigo-600' }}@else{{ 'hover:bg-gray-100 text-gray-700' }}@endif">
                    <i class="fas fa-tachometer-alt @if(Request::is('dashboard')){{ 'text-indigo-600' }}@else{{ 'text-gray-500' }}@endif"></i>
                    <span>Dashboard</span>
                </a>
            </li>
        </ul>

        <!-- Menu Section -->
        <nav class="space-y-1">
            @if($user->roles == 'Admin')
            <div class="mb-6">
                <div class="flex items-center justify-between mb-3 text-gray-500 font-semibold text-xs uppercase tracking-wide">
                    <span>MASTER DATA</span>
                </div>
                <ul class="space-y-1 text-gray-700 text-sm font-medium">
                    <li>
                        <a href="/product" class="flex items-center space-x-2 px-3 py-2 rounded-lg transition-colors duration-200
                            @if(Request::is('product')){{ 'bg-indigo-50 text-indigo-600' }}@else{{ 'hover:bg-gray-100 text-gray-700' }}@endif">
                            <i class="fas fa-boxes @if(Request::is('product')){{ 'text-indigo-600' }}@else{{ 'text-gray-500' }}@endif"></i>
                            <span>Produk</span>
                        </a>
                    </li>

                    <li>
                        <a href="/product_category" class="flex items-center space-x-2 px-3 py-2 rounded-lg transition-colors duration-200
                            @if(Request::is('product_category')){{ 'bg-indigo-50 text-indigo-600' }}@else{{ 'hover:bg-gray-100 text-gray-700' }}@endif">
                            <i class="fas fa-tags @if(Request::is('product_category')){{ 'text-indigo-600' }}@else{{ 'text-gray-500' }}@endif"></i>
                            <span>Kategori Produk</span>
                        </a>
                    </li>

                    <li>
                        <a href="/supplier" class="flex items-center space-x-2 px-3 py-2 rounded-lg transition-colors duration-200
                            @if(Request::is('supplier')){{ 'bg-indigo-50 text-indigo-600' }}@else{{ 'hover:bg-gray-100 text-gray-700' }}@endif">
                            <i class="fas fa-truck @if(Request::is('supplier')){{ 'text-indigo-600' }}@else{{ 'text-gray-500' }}@endif"></i>
                            <span>Supplier</span>
                        </a>
                    </li>

                    <li>
                        <a href="/user" class="flex items-center space-x-2 px-3 py-2 rounded-lg transition-colors duration-200
                            @if(Request::is('user')){{ 'bg-indigo-50 text-indigo-600' }}@else{{ 'hover:bg-gray-100 text-gray-700' }}@endif">
                            <i class="fas fa-users @if(Request::is('user')){{ 'text-indigo-600' }}@else{{ 'text-gray-500' }}@endif"></i>
                            <span>Pengguna</span>
                        </a>
                    </li>
                </ul>
            </div>
            @endif

            <div class="mb-6">
                <div class="flex items-center justify-between mb-3 text-gray-500 font-semibold text-xs uppercase tracking-wide">
                    <span>TRANSAKSI</span>
                </div>
                <ul class="space-y-1 text-gray-700 text-sm font-medium">
                    @if($user->roles == 'Admin' || $user->roles == 'Kasir')
                    <li>
                        <a href="/penjualan" class="flex items-center space-x-2 px-3 py-2 rounded-lg transition-colors duration-200
                            @if(Request::is('penjualan')){{ 'bg-indigo-50 text-indigo-600' }}@else{{ 'hover:bg-gray-100 text-gray-700' }}@endif">
                            <i class="fas fa-shopping-cart @if(Request::is('penjualan')){{ 'text-indigo-600' }}@else{{ 'text-gray-500' }}@endif"></i>
                            <span>Penjualan</span>
                        </a>
                    </li>
                    @endif
                    @if($user->roles == 'Admin' || $user->roles == 'Pembelian')
                    <li>
                        <a href="/purchase_order" class="flex items-center space-x-2 px-3 py-2 rounded-lg transition-colors duration-200
                            @if(Request::is('purchase_order')){{ 'bg-indigo-50 text-indigo-600' }}@else{{ 'hover:bg-gray-100 text-gray-700' }}@endif">
                            <i class="fas fa-clipboard-list @if(Request::is('purchase_order')){{ 'text-indigo-600' }}@else{{ 'text-gray-500' }}@endif"></i>
                            <span>Pembelian</span>
                        </a>
                    </li>
                    @endif
                </ul>
            </div>
            @if($user->roles == 'Admin')
            <div class="mb-6">
                <div class="flex items-center justify-between mb-3 text-gray-500 font-semibold text-xs uppercase tracking-wide">
                    <span>LAPORAN</span>
                </div>
                <ul class="space-y-1 text-gray-700 text-sm font-medium">
                    <li>
                        <a href="/laporan/stok" class="flex items-center space-x-2 px-3 py-2 rounded-lg transition-colors duration-200
                            @if(Request::is('laporan/stok')){{ 'bg-indigo-50 text-indigo-600' }}@else{{ 'hover:bg-gray-100 text-gray-700' }}@endif">
                            <i class="fas fa-warehouse @if(Request::is('laporan/stok')){{ 'text-indigo-600' }}@else{{ 'text-gray-500' }}@endif"></i>
                            <span>Laporan Stok</span>
                        </a>
                    </li>

                    <li>
                        <a href="/laporan/penjualan" class="flex items-center space-x-2 px-3 py-2 rounded-lg transition-colors duration-200
                            @if(Request::is('laporan/penjualan')){{ 'bg-indigo-50 text-indigo-600' }}@else{{ 'hover:bg-gray-100 text-gray-700' }}@endif">
                            <i class="fas fa-chart-line @if(Request::is('laporan/penjualan')){{ 'text-indigo-600' }}@else{{ 'text-gray-500' }}@endif"></i>
                            <span>Laporan Penjualan</span>
                        </a>
                    </li>
                </ul>
            </div>
            @endif

            <!-- Another Section (optional) -->
            <div class="mt-6">
                <div class="flex items-center justify-between mb-3 text-gray-500 font-semibold text-xs uppercase tracking-wide">
                    <span>SETTINGS</span>
                </div>

                <ul class="space-y-1 text-gray-700 text-sm font-medium">
                    <li>
                        <a class="btn-logout flex cursor-pointer items-center space-x-2 px-3 py-2 rounded-lg text-red-600 hover:bg-red-50 transition-colors duration-200">
                            <i class="fas fa-sign-out-alt text-red-600"></i>
                            <span>Logout</span>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</aside>

<script>
    $(document).ready(function() {
        $('.btn-logout').on('click', function() {
            $.ajax({
                url: "{{ route('logout') }}",
                method: 'GET',
                success: function(res) {
                    if(res.status == 'success') {
                        showNotification('Success', res.message, res.status).then(() => {
                            window.location.reload(false)
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

<style>
/* Custom Scrollbar */
::-webkit-scrollbar {
    width: 6px;
}
::-webkit-scrollbar-thumb {
    background-color: #D1D5DB; /* gray-300 */
    border-radius: 3px;
}
</style>