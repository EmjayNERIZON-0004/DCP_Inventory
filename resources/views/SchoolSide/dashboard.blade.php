{{-- filepath: resources/views/SchoolSide/dashboard.blade.php --}}

@extends('layout.SchoolSideLayout')

@section('title', 'DCPMS Dashboard')

@section('content')
 

    <!-- Main Content -->
    <div class="flex-grow flex flex-col items-center justify-center">

        <!-- Welcome Card -->
        <div class="bg-white rounded-lg shadow-lg p-8 max-w-xl w-full text-center mt-16 mb-8">
            <h1 class="text-2xl font-bold mb-4">Welcome to the<br>
                <span class="text-blue-900">DepEd, Region I - Ilocos Region,<br>DCP Monitoring System (DCPMS)</span>
            </h1>
            <p class="text-gray-700 text-base mb-2">
                This system is for the DCP Packages Batches Inventory of recipient schools and request for service repair of with and no warranty units or items to track the status of the DCP Packages.
            </p>
            <p class="text-gray-600 text-sm">
                Efficiently manage, monitor, and report your school's DCP inventory and service requests in one place.
            </p>
        </div>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
        <!-- Acknowledgment Card with Image on the Right -->
        <div class="bg-white border border-blue-200 rounded-lg shadow-md p-6 max-w-4xl w-full flex flex-col md:flex-row items-center mb-8">
            <!-- Info Left -->
            <div class="flex-1 flex flex-col items-center md:items-start text-center md:text-left">
                <h2 class="text-lg font-bold text-blue-900 mb-1">Acknowledgment</h2>
                <p class="text-gray-700 text-center md:text-left mb-2">
                    This DCP Inventory System was proudly developed by
                </p>
                <div class="text-blue-800 font-semibold text-xl mb-1">Em-jay A. Nerizon</div>
                <div class="text-gray-500 text-sm mb-2">System Developer</div>
                <div class="flex flex-col items-center md:items-start mt-2">
                    <span class="text-gray-600 text-sm">Contact:</span>
                    <span class="text-blue-700 text-sm font-medium">emjay.nerizon@email.com</span>
                    <span class="text-gray-600 text-sm">Mobile:</span>
                    <span class="text-blue-700 text-sm font-medium">+63 912 345 6789</span>
                </div>
                <div class="mt-3 text-xs text-gray-400">
                    Credentials: BSIT, Web & Systems Developer
                </div>
            </div>
            <!-- Image Right -->
            <div class="flex-shrink-0 mt-6 md:mt-0 md:ml-8 flex justify-center">
                <img src="{{ asset('icon/mj.jpg') }}" alt="Em-jay A. Nerizon" class="w-40 h-40 rounded-full shadow border-2 border-blue-300 object-cover">
            </div>
        </div>

        <!-- System Features Card -->
        <div class="bg-white rounded-lg shadow p-6 max-w-xl w-full mb-8">
            <h3 class="text-blue-800 font-semibold text-lg mb-2">System Features</h3>
            <ul class="list-disc list-inside text-gray-700 text-sm space-y-1 text-left">
                <li>Batch and itemized DCP inventory management</li>
                <li>Warranty and service request tracking</li>
                <li>Real-time status monitoring and reporting</li>
                <li>User-friendly dashboard for schools and admins</li>
                <li>Secure and role-based access</li>
            </ul>
        </div>

        <!-- Contact Support Card -->
        <div class="bg-blue-100 border border-blue-200 rounded-lg shadow p-6 max-w-xl w-full text-center">
            <h3 class="text-blue-900 font-semibold text-lg mb-2">Need Help?</h3>
            <p class="text-gray-700 text-sm mb-2">
                For support, suggestions, or technical issues, please contact the system developer.
            </p>
            <div class="text-blue-800 font-medium">Em-jay A. Nerizon</div>
            <div class="text-blue-700 text-sm">emjay.nerizon@email.com</div>
            <div class="text-blue-700 text-sm">+63 912 345 6789</div>
        </div>

    </div>

     
@endsection