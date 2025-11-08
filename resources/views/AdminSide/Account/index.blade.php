 @extends('layout.Admin-Side')
 <title>@yield('title', 'DCP Dashboard')</title>

 @section('content')
     <div class="my-5 bg-white shadow-md rounded-sm border border-gray-300 overflow-hidden p-6 mx-5 my-5 mt-8">
         <div class="text-2xl font-bold text-gray-700   ">Admin Account</div>
         <div class="text-lg font-normal text-gray-600 mb-4   ">Welcome back, Admin</div>
         <div class="w-1/3">

             <div class="text-xl font-bold text-gray-700   ">Change Password</div>
             <div class="mb-4 text-md">
                 <span class="font-normal text-sm">Password Changed:
                     {{ App\Models\SchoolUser::where('default_password', 'admin')->first()->password_changed_at ?? ''
                         ? \Carbon\Carbon::parse(
                             App\Models\SchoolUser::where('default_password', 'admin')->first()->password_changed_at ?? '',
                         )->format('F j, Y, g:i a')
                         : 'Never' }}</span>
             </div>
             <form action="{{ route('admin.change.password') }}" method="POST">
                 @csrf
                 @method('PUT')

                 <div class="relative">
                     <label class="block text-sm font-medium text-gray-700">Current Password</label>
                     <input type="password" name="current_password" id="current_password" required
                         class="w-full mt-1 px-3 py-1 border border-gray-300 rounded-md  ">
                     <button type="button" onclick="togglePassword('current_password', this)"
                         class="absolute right-2 top-7 text-gray-600 text-sm">Show</button>
                     @error('current_password')
                         <p class="text-red-500 text-sm">{{ $message }}</p>
                     @enderror
                 </div>

                 <!-- New Password -->
                 <div class="relative">
                     <label class="block text-sm font-medium text-gray-700">New Password</label>
                     <input type="password" name="new_password" id="new_password" required
                         class="w-full mt-1 px-3 py-1 border border-gray-300 rounded-md  ">
                     <button type="button" onclick="togglePassword('new_password', this)"
                         class="absolute right-2 top-7 text-gray-600 text-sm">Show</button>
                     @error('new_password')
                         <p class="text-red-500 text-sm">{{ $message }}</p>
                     @enderror
                 </div>

                 <!-- Confirm New Password -->
                 <div class="relative">
                     <label class="block text-sm font-medium text-gray-700">Confirm New Password</label>
                     <input type="password" name="new_password_confirmation" id="new_password_confirmation" required
                         class="w-full mt-1 px-3 py-1 border border-gray-300 rounded-md  ">
                     <button type="button" onclick="togglePassword('new_password_confirmation', this)"
                         class="absolute right-2 top-7 text-gray-600 text-sm">Show</button>
                 </div>

                 <div class="pt-2">
                     <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
                         Update Password
                     </button>
                 </div>
             </form>
             <script>
                 function togglePassword(inputId, btn) {
                     const input = document.getElementById(inputId);
                     if (input.type === 'password') {
                         input.type = 'text';
                         btn.textContent = 'Hide';
                     } else {
                         input.type = 'password';
                         btn.textContent = 'Show';
                     }
                 }
             </script>
         </div>

     </div>
 @endsection
