<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
      <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <!-- Dashboard-specific CDN assets -->
    <!-- Tailwind CSS via JSDelivr (CSS version - CSP-compatible) -->
<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

</head>
<body class="antialiased bg-gray-100 flex flex-col min-h-screen">

<header class="bg-blue-600 text-white shadow-md">
        <div class="container mx-auto px-4 py-4">
            <div class="flex justify-between items-center">
                <div class="flex items-center space-x-6">
                    <a href="https://www.nid.deped.gov.ph" class="text-2xl font-bold hover:text-gray-50 transition">DepEd Computerization Program (DCP)</a>
                    
                   
                </div>
                
                <div class="flex items-center space-x-4">
                                            <a href="{{url('logout')}}" class="text-white hover:text-gray-50 transition">
                            Login
                        </a>
                                        
                    
                </div>
            </div>
        </div>
    </header>

<main class="flex-grow">
 @yield('content')

</main>

     
      <!-- Footer -->
            <footer class="bg-white border-t border-gray-200 mt-12">
    <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
        <div class="text-center text-sm text-gray-500">
            <p>&copy; 2025 Department of Education. National Inventory Data Collection System.</p>
        </div>
    </div>
</footer>
    
    
</body>
</html>