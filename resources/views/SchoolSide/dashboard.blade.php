
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="3qrATmyK6FPJWi9ycBVnqrm3ngPSsvbMq8Dg69W8">
    <title>DCP Dashboard</title>
   
    <!-- Dashboard-specific CDN assets -->
    <!-- Tailwind CSS via JSDelivr (CSS version - CSP-compatible) -->
<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

 
</head>                 
<body class="antialiased bg-gray-100 flex flex-col min-h-screen">
    <!-- Header -->
    <header class="bg-blue-600 text-white shadow-md">
        <div class="container mx-auto px-4 py-4">
            <div class="flex justify-between items-center">
                <div class="flex items-center space-x-6">
                    <a href="https://www.nid.deped.gov.ph" class="text-2xl font-bold hover:text-gray-50 transition">DepEd Computerization Program (DCP)</a>
                    
                        <!-- <a href="/public-dashboard" class="text-white hover:text-indigo-200 transition font-medium">
                            Submission Dashboard
                        </a> -->
                </div>
                
                <div class="flex items-center space-x-4">
                                            <a href="https://www.nid.deped.gov.ph/login" class="text-white hover:text-gray-50 transition">
                            Login
                        </a>
                                        
                    
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-grow">
        <!-- Compact Breadcrumb Section -->
<div class="bg-white shadow-sm border-b border-gray-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center py-3">
            <!-- Left: Navigation -->
             
                <h2 class="text-lg font-semibold text-gray-900">School Dashboard   </h2>
          
             
            
            <!-- Right: Last Updated -->
            <div class="text-sm text-gray-500">
                <span id="last-updated">Last updated: Jun 24, 2025 at 9:19 PM</span>
            </div>
        </div>
    </div>
</div>

<div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
<div class=" bg-white rounded-md shadow-md overflow-hidden p-6 flex items-center  ">
  <!-- Text Content (Left) -->
  <div>
    <h2 class="text-xl font-bold text-gray-800">{{ Auth::guard('school')->user()->school->SchoolName }}
</h2>
    <p class="text-gray-600">{{ Auth::guard('school')->user()->school->Division }}
{{ Auth::guard('school')->user()->school->Region }}
</p>
<div class="text-gray-600">
  Division Office:   {{ Auth::guard('school')->user()->school->Division   }}
  
</div>

<div class="text-gray-600">
  District:   {{ Auth::guard('school')->user()->school->District   }}
  
</div>


    <p class="text-sm text-gray-500 mt-2">School Head: {{ Auth::guard('school')->user()->school->SchoolHead }}
</p>
  </div>

  <!-- Profile Image / Icon (Right) -->
 <div class="ml-6 flex-shrink-0">
  <img class="w-40 h-40 max-w-full rounded-full object-cover border-1 border-blue-500 shadow-lg"
       src="{{ asset('icon/logo.png') }}"
       alt="Profile Photo">
</div>

</div>
</div>



    </main>

    <!-- Footer -->
            <footer class="bg-white border-t border-gray-200 mt-12">
    <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
        <div class="text-center text-sm text-gray-500">
            <p>&copy; 2025 Department of Education. National Inventory Data Collection System.</p>
        </div>
    </div>
</footer>
    
    
</script>
</body>
</html>