<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\DCPBatchController;
use App\Http\Controllers\DCPBatchItemController;
use App\Http\Controllers\DCPItemTypesController;
use App\Http\Controllers\DCPPackageTypeController;
use App\Http\Controllers\DCPSchoolsInventoryController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SchoolDCPBatchController;
use App\Http\Controllers\SchoolDetailsController;
use App\Models\DCPBatch;
use App\Models\DCPBatchItem;
use App\Models\DCPItemTypes;
use App\Models\DCPPackageTypes;
use App\Models\SchoolData;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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


Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::post('login-submit', [LoginController::class, 'login'])->name('submit-login');

Route::middleware('auth:school')->group(function () {
    Route::get('/dashboard', function () {
        return view('SchoolSide.dashboard');
    })->name('dashboard');
});

Route::get('Admin/DCP-Dashboard', function () {

    $totalSchools = DB::table('schools')->count();
    $totalBatches = DCPBatch::all()->count();
    $totalItems = DCPBatchItem::all()->count();
    $totalPackages = DCPPackageTypes::all()->count();

    return view('AdminSide.dashboard', compact('totalSchools', 'totalBatches', 'totalItems', 'totalPackages'));
})->name('AdminSide-Dashboard');
Route::get('Admin/SchoolsInventory/inventory', [DCPSchoolsInventoryController::class, 'inventory'])->name('index.SchoolsInventory');
Route::get('Admin/SchoolsInventory/{code}', [DCPSchoolsInventoryController::class, 'showItems'])->name('show.SchoolsInventory');
Route::get('Admin/DCPBatch/search', [DCPBatchController::class, 'search'])->name('search.batch');
Route::get('Admin/DCPBatch/index', [DCPBatchController::class, 'index'])->name('index.batch');
Route::post('Admin/DCPBatch/store', [DCPBatchController::class, 'store'])->name('store.batch');
Route::post('Admin/DCPBatch/{id}/approve', [DCPBatchController::class, 'approve'])->name('approve.batch');
Route::delete('Admin/DCPBatch/{batchId}/delete', [DCPBatchController::class, 'destroy'])->name('destroy.batch');
Route::delete('Admin/DCPBatch/{batchId}/items/clear', [DCPBatchItemController::class, 'clear'])->name('clear.batch');
Route::get('/Admin/DCPBatch/{batch}/items/json', [DCPBatchItemController::class, 'itemsJson']);
Route::get('/dcp-batch/{batch}/items', [DCPBatchItemController::class, 'index'])->name('index.items');
Route::post('/dcp-batch/{batch}/items', [DCPBatchItemController::class, 'store'])->name('store.items');
Route::post('/School/submit-schooldata', [SchoolDetailsController::class, 'store_data'])->name('school.submit.schooldata');
Route::get('Admin/Schools-User', [SchoolDetailsController::class, 'user'])->name('user.schools');
Route::get('Schools/index', [SchoolDetailsController::class, 'index'])->name('index.schools');
Route::post('Submit-New-School', [SchoolDetailsController::class, 'store'])->name('store.schools');
Route::get('/schools/{SchoolID}/edit', [SchoolDetailsController::class, 'edit'])->name('schools.edit');
Route::delete('/schools/{SchoolID}', [SchoolDetailsController::class, 'destroy'])->name('schools.destroy');
Route::get('/schools/{SchoolID}', [SchoolDetailsController::class, 'show'])->name('schools.show');
Route::get('/api/package-items/{id}', [DCPPackageTypeController::class, 'getItems']);
Route::get('/package-type/create', [DCPPackageTypeController::class, 'create'])->name('index.package_type');
Route::post('/package-type', [DCPPackageTypeController::class, 'store'])->name('store.package_type');
Route::get('/item-type', [DCPItemTypesController::class, 'index'])->name('index.item_type');
Route::post('/item-type', [DCPItemTypesController::class, 'store'])->name('store.item_type');
Route::delete('/item-type/{id}', [DCPItemTypesController::class, 'destroy'])->name('delete.item_type');
Route::post('/Admin/update-item-type/{id}', [DCPItemTypesController::class, 'update'])->name('update.item_type');
Route::put('/update-package', [DCPPackageTypeController::class, 'update'])->name('update.package_type');
Route::post('/insert-package-item', [DCPPackageTypeController::class, 'insertPackageItem'])->name('insert.package_item');


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

        $batch_items = DB::table('dcp_batches')
            ->join('dcp_batch_items', 'dcp_batches.pk_dcp_batches_id', '=', 'dcp_batch_items.dcp_batch_id')
            ->where('dcp_batches.school_id', Auth::guard('school')->user()->school->pk_school_id)
            ->select('dcp_batches.*', 'dcp_batch_items.*') // or specific columns
            ->orderBy('dcp_batches.created_at', 'desc')
            ->get();

        return view('SchoolSide.DCPInventory', compact('batch_items'));
    })->name('school.dcp_inventory');

    Route::get('DCPInventory/{item_id}', [SchoolDCPBatchController::class, 'showItems'])->name('school.dcp_inventory.items');

    Route::get('/dcp-batch', [SchoolDCPBatchController::class, 'index'])->name('school.dcp_batch');
    Route::get('/dcp-batch-items-list', [SchoolDCPBatchController::class, 'batch_item_list'])->name('school.dcp_batch_item_list');

    Route::get('/dcp-batch/{batch}/items', [SchoolDCPBatchController::class, 'items'])->name('school.dcp_items');
    Route::get('/dcp-batch/{batch}/item-status', [SchoolDCPBatchController::class, 'itemStatus'])->name('school.dcp_item_status');

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


    Route::post('update-batch-status/{batchId}', [SchoolDCPBatchController::class, 'updateBatchStatus'])->name('school.update.batch_status');
    // Existing update routes
    Route::post('/update-details', [AdminController::class, 'updateSchoolDetails'])->name('school.update.details');
    Route::post('/update-officials', [AdminController::class, 'updateSchoolOfficials'])->name('school.update.officials');
});
