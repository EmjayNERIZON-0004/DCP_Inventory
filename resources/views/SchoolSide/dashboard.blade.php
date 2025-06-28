{{-- filepath: resources/views/SchoolSide/dashboard.blade.php --}}

@extends('layout.SchoolSideLayout')

@section('title', 'DCPMS Dashboard')

@section('content')
<div class="min-h-screen flex flex-col" style="background: linear-gradient(180deg, #0a2a5c 0%, #174ea6 100%);">
    <!-- Navigation Bar -->
    <nav class="bg-[#0a2a5c] shadow flex items-center justify-between px-8 py-3">
        <div class="flex items-center space-x-8">
            <span class="text-white font-bold text-lg">DCPMS v2.5.5</span>
            <a href="#" class="text-yellow-400 font-semibold">Home</a>
            <a href="#" class="text-white hover:text-yellow-400">School DCP Profile</a>
            <a href="#" class="text-white hover:text-yellow-400">DCP Service Report</a>
            <a href="#" class="text-white hover:text-yellow-400">DCP Inventory</a>
            <a href="#" class="text-white hover:text-yellow-400">DCP Documents, ICT PAPs & Manual</a>
            <a href="#" class="text-white hover:text-yellow-400">Logout</a>
        </div>
        <div>
            <span class="bg-blue-500 text-white px-4 py-2 rounded font-semibold">
                {{ Auth::user()->name ?? 'User Name' }}
            </span>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="flex-grow flex items-center justify-center">
        <div class="bg-gray-100 bg-opacity-90 rounded-lg shadow-lg p-8 max-w-xl w-full text-center mt-16">
            <h1 class="text-2xl font-bold mb-4">Welcome to the<br>
                <span class="text-blue-900">DepEd, Region VI - Western Visayas,<br>DCP Monitoring System (DCPMS)</span>
            </h1>
            <p class="text-gray-700 text-base">
                This system is for the DCP Packages Batches Inventory of recipient schools and request for service repair of with and no warranty units or items to track the status of the DCP Packages.
            </p>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-[#0a2a5c] text-white text-center py-2 text-xs mt-auto">
        &copy; {{ date('Y') }} DepEd, Region VI - Western Visayas, DCP Monitoring System | All Rights Reserved.
    </footer>
</div>
@endsection