@extends('layouts.app')

@section('content')
    <!-- Fullscreen Flex Container -->
    <div class="flex justify-center items-center min-h-screen bg-gray-100">
        <div class="w-full max-w-md p-6 bg-white rounded-lg shadow-md">
            <!-- Logo -->
            <div class="text-center mb-6">
                <img src="{{ asset('images/logo-login.png') }}" alt="Logo" class="mx-auto w-48">
            </div>

            <!-- Title -->
            <div class="text-center mb-6">
                <h2 class="text-2xl font-bold text-gray-800">Ayo login sekarang!</h2>
                <p class="text-sm text-gray-500 mt-1">Kelola Gudang Jadi Gampang!</p>
            </div>

            <!-- Form -->
            <form method="POST" id="loginForm" action="{{ route('login.submit') }}">
                @csrf

                <!-- Username -->
                <div class="mb-4">
                    <input id="username" type="text"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg bg-gray-50 focus:outline-none focus:ring-2 focus:ring-purple-500 @error('username') border-red-500 @enderror"
                        name="username" value="{{ old('username') }}" required autocomplete="username" autofocus placeholder="Username">
                    @error('username')
                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Password -->
                <div class="mb-4">
                    <input id="password" type="password"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg bg-gray-50 focus:outline-none focus:ring-2 focus:ring-purple-500 @error('password') border-red-500 @enderror"
                        name="password" required autocomplete="current-password" placeholder="Password">
                    @error('password')
                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Submit Button -->
                <div class="mb-4">
                    <button type="submit"
                        class="w-full px-4 py-3 bg-purple-600 hover:bg-purple-700 text-white font-semibold rounded-lg transition duration-200">
                        {{ __('Login') }}
                    </button>
                </div>
            </form>
        </div>  
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#loginForm').on('submit', function(e) {
                e.preventDefault()
    
                let formData = $(this).serialize()
    
                $.ajax({
                    url: $(this).attr('action'),
                    method: 'POST',
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(res) {
                        if(res.status == 'success') {
                            showNotification('Success', res.message, res.status).then(() => {
                                window.location.href = '/dashboard'
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