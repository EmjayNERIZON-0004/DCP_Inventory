 @extends('layout.Admin-Side')
 
  <title>@yield('title','DCP Dashboard')</title>
   
   

@section('content')
 
<style>

    input[type="text"]{
        border: 1px solid #ccc;
    }
</style>

<div class="max-w-5xl mx-auto p-4">
  <form method="POST" action="{{route('store.schools')}}" enctype="multipart/form-data"
        class="bg-white shadow-lg rounded-lg p-6 flex flex-col lg:flex-row gap-6">
    @csrf

    <!-- Left: Logo & Image Upload -->
    <div class="w-full lg:w-1/3 flex flex-col items-center justify-start gap-4">
      <!-- Logo Image -->
      <img id="logoPreview"
           src="{{ asset('icon/logo.png') }}"
           alt="School Logo"
           class="w-40 h-40 object-cover rounded-full border border-gray-300 shadow-md">

      <!-- File Input with Styled Label -->
      <label for="logo"
             class="bg-blue-100 text-blue-700 font-semibold px-4 py-2 rounded-full cursor-pointer hover:bg-blue-200 transition">
        Select School Logo
        <input type="file" name="image_path" id="logo" class="hidden" accept="image/*">
      </label>
    </div>

    <!-- Right: School Form -->
    <div class="flex-1">
      <h2 class="text-xl font-semibold mb-4 text-gray-800">Add School</h2>
      <table class="w-full text-sm">
        <thead class="bg-gray-100">
          <tr>
            <th class="text-left px-4 py-2">Label</th>
            <th class="text-left px-4 py-2">Input</th>
          </tr>
        </thead>
        <tbody>
          @foreach([
            'SchoolID' => 'School ID',
            'SchoolName' => 'School Name',
            'Region' => 'Region',
            'Division' => 'Division',
            'District' => 'District',
            'SchoolHead' => 'School Head',
            'ContactNumber' => 'Contact Number',
            'Email' => 'Email'
          ] as $name => $label)
          <tr class="border-b">
            <td class="px-4 py-2 font-medium text-gray-700">
              <label for="{{ $name }}">{{ $label }}</label>
            </td>
            <td class="px-4 py-2">
      @php
    if ($name == 'Region') {
        $value = 'Region I';
    } elseif ($name == 'Division') {
        $value = 'San Carlos City';
    } else {
        $value = '';
    }
@endphp


              <input type="text" name="{{ $name }}" id="{{ $name }}" value="{{$value}}"
                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400">
            </td>

          </tr>
          @endforeach
        </tbody>
      </table>

      <!-- Submit Button -->
      <div class="mt-4 text-right">
        <button type="submit"
          class="px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition">Submit</button>
      </div>
    </div>
  </form>
</div>


 <input type="hidden" value="{{asset('icon/logo.png')}}" id="default_icon">

<script>
document.addEventListener('DOMContentLoaded', function () {
  const input = document.getElementById('logo');
  const preview = document.getElementById('logoPreview');
    const icon = document.getElementById('default_icon');
  input.addEventListener('change', function (e) {
    const file = e.target.files[0];
    if (file) {
      preview.src = URL.createObjectURL(file);
    } else {
      preview.src = icon;
    }
  });
});
</script>


 
<div class="bg-white shadow-xl rounded-lg overflow-hidden p-6 mx-5 my-5">
  <h2 class="text-2xl font-bold text-gray-800 mb-4">School List</h2>
  
  <div class="overflow-x-auto">
    <table class="min-w-full text-sm text-left text-gray-700 border border-gray-200">
      <thead class="bg-blue-100 text-gray-900">
        <tr>
          <th class="px-6 py-3 font-semibold uppercase tracking-wider">School ID</th>
          <th class="px-6 py-3 font-semibold uppercase tracking-wider">School Name</th>
          <th class="px-6 py-3 font-semibold uppercase tracking-wider">Region</th>
          <th class="px-6 py-3 font-semibold uppercase tracking-wider">Division</th>
          <th class="px-6 py-3 font-semibold uppercase tracking-wider">District</th>
          <th class="px-6 py-3 font-semibold uppercase tracking-wider">School Head</th>
          <th class="px-6 py-3 font-semibold uppercase tracking-wider">Contact Number</th>
          <th class="px-6 py-3 font-semibold uppercase tracking-wider">Email</th>
          <th class="px-6 py-3 font-semibold uppercase tracking-wider">Actions</th>
        </tr>
      </thead>

      <tbody class="bg-white divide-y divide-gray-200">
        @foreach($schools as $school)
        <tr class="hover:bg-blue-50 transition">
          <td class="px-6 py-4">{{ $school->SchoolID }}</td>
          <td class="px-6 py-4 font-medium text-gray-900">{{ $school->SchoolName }}</td>
          <td class="px-6 py-4">{{ $school->Region }}</td>
          <td class="px-6 py-4">{{ $school->Division }}</td>
          <td class="px-6 py-4">{{ $school->District}}</td>
          <td class="px-6 py-4">{{ $school->SchoolHead }}</td>
          <td class="px-6 py-4">{{ $school->ContactNumber }}</td>
          <td class="px-6 py-4">{{ $school->Email }}</td>
          <td class="px-6 py-4 space-x-2">
            <a href="#" class="inline-block px-3 py-1 text-xs font-semibold text-white bg-green-500 rounded hover:bg-green-600">Edit</a>
            <a href="#" class="inline-block px-3 py-1 text-xs font-semibold text-white bg-red-500 rounded hover:bg-red-600">Delete</a>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>



@endsection