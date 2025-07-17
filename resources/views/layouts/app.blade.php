<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title }}</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-light">
    <div id="notification"
        class="fixed top-4 right-4 hidden max-w-sm bg-white border border-gray-200 rounded-lg shadow-lg !z-50 transition-all duration-300 ease-in-out transform translate-y-4 opacity-0"
        style="min-width: 350px;">
        
        <div class="p-3 flex items-start relative">
            <div class="flex-shrink-0 self-start mt-0.5">
                <svg id="notification-icon" class="h-6 w-6 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"></svg>
            </div>

            <div class="ml-3 flex-1">
                <p id="notification-title" class="text-sm font-medium text-gray-900">Success</p>
                <p id="notification-message" class="mt-1 text-sm text-gray-500">Everything worked!</p>
            </div>

            <button type="button" id="close-notification"
                class="absolute top-2 right-2 text-gray-400 hover:text-gray-500 focus:outline-none">
                <span class="sr-only">Dismiss</span>
                <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                        clip-rule="evenodd" />
                </svg>
            </button>
        </div>
    </div>
    <script>
        function showNotification(title, message, type = 'success') {
            return new Promise((resolve) => {
                const icon = document.getElementById('notification-icon');
                const titleEl = document.getElementById('notification-title');
                const messageEl = document.getElementById('notification-message');
                const notification = document.getElementById('notification');
    
                titleEl.textContent = title;
                messageEl.textContent = message;
    
                // Ganti ikon & warna
                if (type === 'success') {
                    icon.classList.remove('text-red-500');
                    icon.classList.add('text-green-500');
                    icon.innerHTML = `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />`;
                } else {
                    icon.classList.remove('text-green-500');
                    icon.classList.add('text-red-500');
                    icon.innerHTML = `<path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />`;
                }
    
                // Show the notification
                notification.style.display = 'block';
                setTimeout(() => {
                    notification.style.opacity = '1';
                    notification.style.transform = 'translateY(0)';
                }, 10);
    
                // Auto-hide after a delay
                setTimeout(() => {
                    notification.style.opacity = '0';
                    notification.style.transform = 'translateY(10px)';
                    setTimeout(() => {
                        notification.style.display = 'none';
                        resolve(); // Call resolve() here after the notification is hidden
                    }, 300);
                }, 1000);
    
                // Handle manual close
                document.getElementById('close-notification').onclick = () => {
                    notification.style.opacity = '0';
                    notification.style.transform = 'translateY(10px)';
                    setTimeout(() => {
                        notification.style.display = 'none';
                        resolve(); // Also call resolve() here
                    }, 300);
                };
            });
        }
    </script>

    @if($title != 'Login Page')
        @include('layouts.sidebar')
        <main class="ml-[15rem] p-6 flex-1 overflow-y-auto">
            @yield('content')
        </main>
    @else
        @yield('content')
    @endif
    <!-- Scripts -->
    @stack('scripts')
    
</body>
</html>