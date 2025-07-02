<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>@yield('title')</title>
    <!-- Dashboard-specific CDN assets -->
    <!-- Tailwind CSS via JSDelivr (CSS version - CSP-compatible) -->
    <link
      href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css"
      rel="stylesheet"
    />
  </head>
  <body class="antialiased bg-gray-100 flex flex-col min-h-screen">
    <header class="bg-blue-600 text-white shadow-md">
      <div class="container mx-auto px-4 py-4">
        <div class="flex justify-between items-center">
          <div class="flex items-center space-x-6">
            <a
              href="https://www.nid.deped.gov.ph"
              class="text-2xl font-bold hover:text-gray-50 transition"
              >DepEd Computerization Program (DCP)</a
            >
          </div>
          <div class="flex items-center space-x-4">
            <a
              href="{{url('logout')}}"
              class="text-white hover:text-gray-50 transition"
              >Login</a
            >
          </div>
        </div>
      </div>
    </header>


    <div class="bg-white border-b border-gray-200">
      <div class="flex flex-wrap gap-2 justify-center sm:justify-start px-2 py-2">
       
      <a
          href="{{ route('school.dashboard') }}"
          class="px-4 py-2 font-semibold text-blue-700 hover:underline hover:text-blue-900 transition-all duration-200"
          style="width: fit-content;"
          >Home</a
        >
      <a
          href="{{ route('school.profile') }}"
          class="px-4 py-2 font-semibold text-blue-700 hover:underline hover:text-blue-900 transition-all duration-200"
          style="width: fit-content;"
          >School Profile</a
        >

          <a
          href="{{ route('school.dcp_batch') }}"
          class="px-4 py-2 font-semibold text-blue-700 hover:underline hover:text-blue-900 transition-all duration-200"
          style="width: fit-content;"
          >DCP Batch Profile</a
        >

        <a
          href="{{ route('school.dcp_service_report') }}"
          class="px-4 py-2 font-semibold text-blue-700 hover:underline hover:text-blue-900 transition-all duration-200"
          style="width: fit-content;"
          >DCP Service Report</a
        >
        <a
          href="{{ route('school.dcp_inventory') }}"
          class="px-4 py-2 font-semibold text-blue-700 hover:underline hover:text-blue-900 transition-all duration-200"
          style="width: fit-content;"
          >DCP Inventory</a
        >
        <a
          href="{{ route('school.dcp_documents') }}"
          class="px-4 py-2 font-semibold text-blue-700 hover:underline hover:text-blue-900 transition-all duration-200"
          style="width: fit-content;"
          >DCP Documents</a
        >
        <a
          href="{{ route('school.ict_slac') }}"
          class="px-4 py-2 font-semibold text-blue-700 hover:underline hover:text-blue-900 transition-all duration-200"
          style="width: fit-content;"
          >ICT SLAC</a
        >
        <a
          href="{{ route('school.manual') }}"
          class="px-4 py-2 font-semibold text-blue-700 hover:underline hover:text-blue-900 transition-all duration-200"
          style="width: fit-content;"
          >Manual</a
        >
      </div>
    </div>
    
@if ($errors->any())
    <div class="mb-4">
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
            <strong>Whoops!</strong> There were some problems with your input.<br>
            <ul class="mt-2 list-disc list-inside text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
@endif

@if (session('error'))
    <div class="mb-4">
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
            {{ session('error') }}
        </div>
    </div>
@endif

@if (session('success'))
    <div class="mb-4">
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
            {{ session('success') }}
        </div>
    </div>
@endif
    <main class="flex-grow">@yield('content')</main>


    <!-- Footer -->
    <footer class="bg-white border-t border-gray-200 mt-12">
      <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
        <div class="text-center text-sm text-gray-500">
          <p>
            &copy; 2025 Department of Education. National Inventory Data
            Collection System.
          </p>
        </div>
      </div>
    </footer>
  </body>
</html>