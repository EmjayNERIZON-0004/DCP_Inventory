 @extends('layout.Admin-Side')
 
  <title>@yield('title','DCP Dashboard')</title>
   
   

@section('content')
     <div class="bg-white grid grid-cols-1 sm:grid-cols-3 gap-2">
  <div class="col-span-1 text-center border-b border-red-500 p-2">
    <a href="{{route('index.schools')}}">School Profile</a>
  </div>
  <div class="col-span-1 text-center border-b border-red-500 p-2">
    <a href="">Container 2</a>
  </div>
  <div class="col-span-1 text-center border-b border-red-500 p-2">
    <a href="">Container 3</a>
  </div>
</div>



<div class="bg-white shadow-sm border-b border-gray-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between items-center py-3">
                
                            <h2 class="text-lg font-semibold text-gray-900">Admin Dashboard   </h2>
                    
                        <div class="text-sm text-gray-500">
                            <span id="last-updated">Last updated: Jun 24, 2025 at 9:19 PM</span>
                        </div>
                    </div>
    </div>
</div>

 @endsection