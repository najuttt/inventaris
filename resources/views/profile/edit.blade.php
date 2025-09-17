<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Profile') }}
            </h2>

            <!-- Tombol Kembali ke Dashboard -->
            @php
                $role = Auth::user()->role;
                $dashboardRoutes = [
                    'super_admin' => 'super_admin.dashboard',
                    'admin' => 'admin.dashboard',
                    'alumni' => 'alumni.dashboard',
                ];
            @endphp

            @if(isset($dashboardRoutes[$role]))
                <a href="{{ route($dashboardRoutes[$role]) }}" 
                   class="inline-flex items-center px-4 py-2 bg-red-600 text-white font-semibold rounded-md shadow hover:bg-red-700 transition">
                    <!-- Icon Panah -->
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" stroke-width="2" 
                         viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"></path>
                    </svg>
                    Kembali ke Dashboard
                </a>
            @endif
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
