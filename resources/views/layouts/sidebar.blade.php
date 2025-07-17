<aside aria-label="Sidebar" class="w-[15rem] h-full fixed left-0 top-0 bottom-0 bg-gradient-to-b from-white to-gray-50 border border-gray-200 p-6 flex flex-col shadow-lg">
    <!-- Header -->
    <div>
        <div class="flex items-center justify-between mb-8">
            <div class="flex items-center space-x-3">
                <div aria-hidden="true" class="w-10 h-10 rounded-lg bg-gradient-to-br from-indigo-600 to-purple-600 flex items-center justify-center text-white font-bold text-xl select-none shadow-md">
                    W
                </div>
                <div>
                    <h1 class="text-gray-900 font-bold text-lg leading-tight">
                        widelab
                    </h1>
                    <p class="text-indigo-600 text-xs font-semibold uppercase tracking-wider">
                        Team Plan
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

            <div class="mb-6">
                <div class="flex items-center justify-between mb-3 text-gray-500 font-semibold text-xs uppercase tracking-wide">
                    <span>TRANSAKSI</span>
                </div>
                <ul class="space-y-1 text-gray-700 text-sm font-medium">
                    <li>
                        <a href="/penjualan" class="flex items-center space-x-2 px-3 py-2 rounded-lg transition-colors duration-200
                            @if(Request::is('penjualan')){{ 'bg-indigo-50 text-indigo-600' }}@else{{ 'hover:bg-gray-100 text-gray-700' }}@endif">
                            <i class="fas fa-boxes @if(Request::is('penjualan')){{ 'text-indigo-600' }}@else{{ 'text-gray-500' }}@endif"></i>
                            <span>Penjualan</span>
                        </a>
                    </li>

                    <li>
                        <a href="/pembelian" class="flex items-center space-x-2 px-3 py-2 rounded-lg transition-colors duration-200
                            @if(Request::is('pembelian')){{ 'bg-indigo-50 text-indigo-600' }}@else{{ 'hover:bg-gray-100 text-gray-700' }}@endif">
                            <i class="fas fa-tags @if(Request::is('pembelian')){{ 'text-indigo-600' }}@else{{ 'text-gray-500' }}@endif"></i>
                            <span>Pembelian</span>
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Another Section (optional) -->
            <div class="mt-6">
                <div class="flex items-center justify-between mb-3 text-gray-500 font-semibold text-xs uppercase tracking-wide">
                    <span>SETTINGS</span>
                </div>

                <ul class="space-y-1 text-gray-700 text-sm font-medium">
                    <li>
                        <a href="/logout" class="flex items-center space-x-2 px-3 py-2 rounded-lg text-red-600 hover:bg-red-50 transition-colors duration-200">
                            <i class="fas fa-sign-out-alt text-red-600"></i>
                            <span>Logout</span>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>

    <!-- Footer - User Info -->
    <div class="pt-6 mt-auto border-t border-gray-200">
        <div class="flex items-center space-x-3">
            <img alt="User Avatar" class="w-10 h-10 rounded-full object-cover ring-1 ring-gray-200" src="https://storage.googleapis.com/a1aa/image/7748178d-6586-4f6d-0d5a-c6495f44ca3a.jpg " />
            <div class="text-sm truncate">
                <p class="font-semibold text-gray-900 truncate">Sandra Marx</p>
                <p class="text-gray-500 truncate text-xs">sandra@mail.com</p>
            </div>
            <button class="ml-auto text-gray-400 hover:text-gray-600 focus:outline-none">
                <i class="fas fa-cog"></i>
            </button>
        </div>
    </div>
</aside>

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