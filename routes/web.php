<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\DCPBatchController;
use App\Http\Controllers\DCPBatchItemController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SchoolDCPBatchController;
use App\Http\Controllers\SchoolDetailsController;
use App\Models\DCPBatch;
use App\Models\SchoolData;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/test', function () {
    return view('test.test');
});
Route::get('/', function () {
    return view('login');
})->name('login');


Route::get('/logout', [LoginController::class,'logout'] )->name('logout');

Route::post('login-submit',[LoginController::class,'login'])->name('submit-login');

Route::middleware('auth:school')->group(function () {
    Route::get('/dashboard', function () {
        return view('SchoolSide.dashboard');
    })->name('dashboard');
});

Route::get('Admin/DCP-Dashboard',function(){
    return view('AdminSide.dashboard');
})->name('AdminSide-Dashboard');


Route::get('Admin/DCPBatch/index',[DCPBatchController::class,'index'])->name('index.batch');
Route::post('Admin/DCPBatch/store', [DCPBatchController::class, 'store'])->name('store.batch');

Route::get('/dcp-batch/{batch}/items', [DCPBatchItemController::class, 'index'])->name('index.items');
Route::post('/dcp-batch/{batch}/items', [DCPBatchItemController::class, 'store'])->name('store.items');

Route::post('/School/submit-schooldata', [SchoolDetailsController::class, 'store_data'])->name('school.submit.schooldata');

Route::get('Admin/Schools-User',[SchoolDetailsController::class,'user'])->name('user.schools');
Route::get('Schools/index',[SchoolDetailsController::class,'index'])->name('index.schools');
Route::post('Submit-New-School',[SchoolDetailsController::class,'store'])->name('store.schools');
Route::get('/schools/{SchoolID}/edit', [SchoolDetailsController::class, 'edit'])->name('schools.edit');
Route::delete('/schools/{SchoolID}', [SchoolDetailsController::class, 'destroy'])->name('schools.destroy');
Route::get('/schools/{SchoolID}', [SchoolDetailsController::class, 'show'])->name('schools.show');








// School dashboard update routes
Route::middleware(['web', 'auth:school'])->prefix('School')->group(function () {
    Route::get('/dashboard', function () {
        return view('SchoolSide.dashboard');
    })->name('school.dashboard');

    Route::get('/profile', function () {
      
          $school = Auth::guard('school')->user()->school;
    $schoolData =   SchoolData::where('pk_school_id', $school->pk_school_id)->get();
    $submittedGradeLevels = $schoolData->pluck('GradeLevelID')->toArray();

    return view('SchoolSide.SchoolProfile', compact('schoolData', 'submittedGradeLevels'));
  

        
    })->name('school.profile');

    Route::get('/dcp-service-report', function () {
        return view('SchoolSide.DCPServiceReport');
    })->name('school.dcp_service_report');

    Route::get('/dcp-inventory', function () {
        return view('SchoolSide.DCPInventory');
    })->name('school.dcp_inventory');

    Route::get('/dcp-batch', [SchoolDCPBatchController::class, 'index'])->name('school.dcp_batch');
 
Route::get('/dcp-batch/{batch}/items', [SchoolDCPBatchController::class, 'items'])->name('school.dcp_items');
   
Route::put('/dcp-batch/{item}', [SchoolDCPBatchController::class, 'updateItem'])->name('school.dcp_items.update');
 
 
    Route::get('/dcp-documents', function () {
        return view('SchoolSide.DCPDocument');
    })->name('school.dcp_documents');

    Route::get('/ict-slac', function () {
        return view('SchoolSide.ICTSLAC');
    })->name('school.ict_slac');

    Route::get('/manual', function () {
        return view('SchoolSide.Manual');
    })->name('school.manual');

    // Existing update routes
    Route::post('/update-details', [AdminController::class, 'updateSchoolDetails'])->name('school.update.details');
    Route::post('/update-officials', [AdminController::class, 'updateSchoolOfficials'])->name('school.update.officials');
});