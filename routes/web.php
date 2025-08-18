<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\DCPBatchApprovalController;
use App\Http\Controllers\DCPBatchController;
use App\Http\Controllers\DCPBatchItemController;
use App\Http\Controllers\DCPItemTypesController;
use App\Http\Controllers\DCPPackageTypeController;
use App\Http\Controllers\DCPSchoolsInventoryController;
use App\Http\Controllers\ISPController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\PackagesInformationController;
use App\Http\Controllers\SchoolDashboardController;
use App\Http\Controllers\SchoolDCPBatchController;
use App\Http\Controllers\SchoolDetailsController;
use App\Http\Controllers\SchoolInventoryController;
use App\Http\Controllers\SchoolISPController;
use App\Http\Controllers\SchoolItemConditionController;
use App\Models\DCPBatch;
use App\Models\DCPBatchApproval;
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
    return view('test-view');
});
Route::get('/', function () {
    return view('login');
})->name('login')->middleware('loginMW');


Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::post('login-submit', [LoginController::class, 'login'])->name('submit-login');


Route::get('Admin/DCP-Dashboard', function () {

    $totalSchools = DB::table('schools')->count();
    $totalBatches = DCPBatch::all()->count();
    $totalItems = DCPBatchItem::all()->count();
    $totalPackages = DCPPackageTypes::all()->count();

    return view('AdminSide.dashboard', compact('totalSchools', 'totalBatches', 'totalItems', 'totalPackages'));
})->name('AdminSide-Dashboard');

Route::get('/Admin/SchoolUser/search', [SchoolDetailsController::class, 'search'])->name('user.search');

Route::get('Admin/SchoolsInventory/inventory', [DCPSchoolsInventoryController::class, 'inventory'])->name('index.SchoolsInventory');
Route::get('Admin/SchoolsInventory/{code}', [DCPSchoolsInventoryController::class, 'showItems'])->name('show.SchoolsInventory');
Route::get('Admin/DCPBatch/search', [DCPBatchController::class, 'search'])->name('search.batch');
Route::get('Admin/DCPBatch/index', [DCPBatchController::class, 'index'])->name('index.batch')->middleware('adminRoleOnly');
Route::post('Admin/DCPBatch/store', [DCPBatchController::class, 'store'])->name('store.batch');
Route::post('Admin/DCPBatch/{id}/approve', [DCPBatchController::class, 'approve'])->name('approve.batch');
Route::delete('Admin/DCPBatch/{batchId}/delete', [DCPBatchController::class, 'destroy'])->name('destroy.batch');
Route::delete('Admin/DCPBatch/{batchId}/items/clear', [DCPBatchItemController::class, 'clear'])->name('clear.batch');
Route::get('/Admin/DCPBatch/{batch}/items/json', [DCPBatchItemController::class, 'itemsJson']);
Route::get('/dcp-batch/{batch}/items', [DCPBatchItemController::class, 'index'])->name('index.items')->middleware('adminRoleOnly');
Route::post('/dcp-batch/{batch}/items', [DCPBatchItemController::class, 'store'])->name('store.items');
Route::post('/School/submit-schooldata', [SchoolDetailsController::class, 'store_data'])->name('school.submit.schooldata');
Route::put('/School/update-schooldata', [SchoolDetailsController::class, 'updateSchoolDataForm'])->name('school.update.schooldata');
Route::get('Admin/Schools-User', [SchoolDetailsController::class, 'user'])->name('user.schools')->middleware('adminRoleOnly');
Route::get('Schools/index', [SchoolDetailsController::class, 'index'])->name('index.schools')->middleware('adminRoleOnly');
Route::post('Submit-New-School', [SchoolDetailsController::class, 'store'])->name('store.schools');
Route::get('/schools/{SchoolID}/edit', [SchoolDetailsController::class, 'edit'])->name('schools.edit');
Route::delete('/schools/{SchoolID}', [SchoolDetailsController::class, 'destroy'])->name('schools.destroy');
Route::get('/schools/{SchoolID}', [SchoolDetailsController::class, 'show'])->name('schools.show');
Route::post('/update-school/{SchoolID}', [SchoolDetailsController::class, 'updateSchool'])->name('schools.update');
Route::get('/Admin/schools/search', [SchoolDetailsController::class, 'search_school'])->name('search.schools');

Route::get('/api/package-items/{id}', [DCPPackageTypeController::class, 'getItems']);
Route::get('/package-type/create', [DCPPackageTypeController::class, 'create'])->name('index.package_type')->middleware('adminRoleOnly');
Route::post('/package-type', [DCPPackageTypeController::class, 'store'])->name('store.package_type');
Route::delete('/package-type/{id}', [DCPPackageTypeController::class, 'destroy'])->name('delete.package_type');
Route::post('/insert-package-item', [DCPPackageTypeController::class, 'insertPackageItem'])->name('insert.package_item');
Route::delete('/package-item/{id}', [DCPPackageTypeController::class, 'deletePackageItem'])->name('delete.package_item');
Route::put('/update-package', [DCPPackageTypeController::class, 'update'])->name('update.package_type');
Route::get('/item-type', [DCPItemTypesController::class, 'index'])->name('index.item_type')->middleware('adminRoleOnly');
Route::post('/item-type', [DCPItemTypesController::class, 'store'])->name('store.item_type');
Route::delete('/item-type/{id}', [DCPItemTypesController::class, 'destroy'])->name('delete.item_type');
Route::post('/Admin/update-item-type/{id}', [DCPItemTypesController::class, 'update'])->name('update.item_type');
Route::post('/delivery-mode/submit', [DCPItemTypesController::class, 'storeDeliveryMode'])->name('store.delivery_mode');

Route::post('/delivery-condition/submit', [DCPItemTypesController::class, 'storeDeliveryCondition'])->name('store.delivery_condition');
Route::post('/current-condition/submit', [DCPItemTypesController::class, 'storeCurrentCondition'])->name('store.current_condition');
Route::post('/assigned_user_type/submit', [DCPItemTypesController::class, 'storeAssignedUserType'])->name('store.assigned_user_type');
Route::post('/assigned_location/submit', [DCPItemTypesController::class, 'storeAssignedLocation'])->name('store.assigned_location');

Route::post('/supplier/submit', [DCPItemTypesController::class, 'storeSupplier'])->name('store.supplier');
Route::post('/brand/submit', [DCPItemTypesController::class, 'storeBrand'])->name('store.brand');
Route::post('/delivery-type/edit/{id}', [DCPItemTypesController::class, 'editDeliveryMode'])->name('edit.delivery_mode');
Route::post('/delivery-condition/edit/{id}', [DCPItemTypesController::class, 'editDeliveryCondition'])->name('edit.delivery_condition');
Route::post('/current-condition/edit/{id}', [DCPItemTypesController::class, 'editCurrentCondition'])->name('edit.current_condition');
Route::post('/assigned_user_type/edit/{id}', [DCPItemTypesController::class, 'editAssignedUserType'])->name('edit.assigned_user_type');
Route::post('/assigned_location/edit/{id}', [DCPItemTypesController::class, 'editAssignedLocation'])->name('edit.assigned_location');

Route::post('/supplier/edit/{id}', [DCPItemTypesController::class, 'editSupplier'])->name('edit.supplier');
Route::post('/brand/edit/{id}', [DCPItemTypesController::class, 'editBrand'])->name('edit.brand');
Route::delete('/delivery-mode/delete/{id}', [DCPItemTypesController::class, 'deleteDeliveryMode'])->name('delete.delivery_mode');
Route::delete('/delivery-condition/delete/{id}', [DCPItemTypesController::class, 'deleteDeliveryCondition'])->name('delete.delivery_condition');
Route::delete('/current-condition/delete/{id}', [DCPItemTypesController::class, 'deleteCurrentCondition'])->name('delete.current_condition');
Route::delete('/assigned_user_type/delete/{id}', [DCPItemTypesController::class, 'deleteAssignedUserType'])->name('delete.assigned_user_type');
Route::delete('/assigned_location/delete/{id}', [DCPItemTypesController::class, 'deleteAssignedLocation'])->name('delete.assigned_location');

Route::delete('/supplier/delete/{id}', [DCPItemTypesController::class, 'deleteSupplier'])->name('delete.supplier');
Route::delete('/brand/delete/{id}', [DCPItemTypesController::class, 'deleteBrand'])->name('delete.brand');
Route::get('/Admin/CRUD', function () {
    return view('AdminSide.CRUD_Details');
})->name('index.crud');

Route::get('/Admin/ISP/index-list', [ISPController::class, 'indexISPList'])->name('isp.index.list');
Route::post('/Admin/ISP/submit-list', [ISPController::class, 'storeISPList'])->name('isp.submit.list');
Route::put('/Admin/ISP/update-list', [ISPController::class, 'updateISPList'])->name('isp.update.list');
Route::delete('/Admin/ISP/delete-list/{isp_list_id}', [ISPController::class, 'deleteISPList'])->name('isp.delete.list');

Route::post('/Admin/ISP/submit-connection', [ISPController::class, 'storeConnectionType'])->name('isp.submit.connection_type');
Route::put('/Admin/ISP/update-connection', [ISPController::class, 'updateConnectionType'])->name('isp.update.connection_type');
Route::delete('/Admin/ISP/delete-connection/{isp_connection_id}', [ISPController::class, 'deleteConnectionType'])->name('isp.delete.connection_type');


Route::post('/Admin/ISP/submit-area', [ISPController::class, 'storeArea'])->name('isp.submit.area');
Route::put('/Admin/ISP/update-area', [ISPController::class, 'updateArea'])->name('isp.update.area');
Route::delete('/Admin/ISP/delete-area/{isp_area_id}', [ISPController::class, 'deleteArea'])->name('isp.delete.area');


// School dashboard update routes
Route::middleware(['web', 'auth:school'])->prefix('School')->group(function () {

    Route::get('/dashboard', [SchoolDashboardController::class, 'index'])->name('school.dashboard');
    Route::get('/packages-info/{id}', [PackagesInformationController::class, 'index'])->name('schools.packages.info');
    Route::get('items-condition/{id}', [SchoolItemConditionController::class, 'index'])->name('schools.item.condition');
    Route::post('item-condition', [SchoolItemConditionController::class, 'comboSearch'])->name('schools.item.condition.combo');

    Route::get('/profile', function () {

        $school = Auth::guard('school')->user()->school;
        $schoolData =   SchoolData::where('pk_school_id', $school->pk_school_id)->get();
        $submittedGradeLevels = $schoolData->pluck('GradeLevelID')->toArray();

        return view('SchoolSide.SchoolProfile', compact('schoolData', 'submittedGradeLevels'));
    })->name('school.profile');

    Route::get('/dcp-service-report', function () {
        return view('SchoolSide.DCPServiceReport');
    })->name('school.dcp_service_report');

    Route::get('/DCPInventory', function () {

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
    Route::get('/dcp-batch/{batch}/warranty', [SchoolDCPBatchController::class, 'warranty'])->name('school.dcp_item_warranty');
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
    Route::post('assignment/items', [SchoolDCPBatchController::class, 'assigned_for_items'])->name('school.assignment.items');
    Route::get('/batch-items/search', [SchoolInventoryController::class, 'searchBatchItems']);
    Route::post('/submit-dcp-batch', [DCPBatchApprovalController::class, 'submit'])->name('submit.dcp_batch');

    Route::get('/ISP/index', [SchoolISPController::class, 'index'])->name('schools.isp.index');
    Route::post('/ISP/store', [SchoolISPController::class, 'storeData'])->name('schools.isp.store');


    //END OF PREFIX SCHOOL
});


Route::post('/send-mail/{id}', [MailController::class, 'sendEmail'])->name('notify.school');
