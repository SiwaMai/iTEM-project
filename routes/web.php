<?php

use FontLib\Table\Type\name;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\Admin\MaterialController;
use App\Http\Controllers\Admin\EquipmentController;
use App\Http\Controllers\BorrowRequestController;
use App\Http\Controllers\Admin\AdminBorrowRequestController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Admin\AdminMaterialApprovalController;
use App\Http\Controllers\MaterialRequestController;
use App\Http\Controllers\MaterialSlipController;
use App\Http\Controllers\Admin\EquipmentReportController;
use App\Http\Controllers\Admin\MaterialReportController;




// หน้าแรก
Route::get('/', function () {
    return view('welcome');
});

// หน้า index
Route::get('/index', function () {
    return view('index');
})->name('index');

Route::get('/login', function () {
    return redirect('/index'); // หรือ redirect ไปหน้าเลือกประเภท login
})->name('login');

// Route สำหรับนักศึกษา
Route::get('/login/student', function () {
    return app(AuthController::class)->showLogin(request(), 'student');
})->name('login.student');
Route::post('/login/student', [AuthController::class, 'login'])->name('login.student.submit');

// Route สำหรับบุคลากร
Route::get('/login/staff', function () {
    return app(AuthController::class)->showLogin(request(), 'staff');
})->name('login.staff');
Route::post('/login/staff', [AuthController::class, 'login'])->name('login.staff.submit');

// เส้นทางสำหรับการแสดงฟอร์มสมัครสมาชิก
Route::get('register', [RegisterController::class, 'registerForm'])->name('register.form');
Route::post('register', [RegisterController::class, 'register'])->name('register');

// หน้า dashboard หลังล็อกอินสำเร็จ
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth')->name('dashboard');

//Graph แสดงสถิติ
Route::get('/api/material-usage', [DashboardController::class, 'getMaterialUsage']);
Route::get('/api/equipment-usage', [DashboardController::class, 'getEquipmentUsage']);

// ออกจากระบบ
Route::match(['get', 'post'], '/logout', [AuthController::class, 'logout'])->name('logout');

// ฟอร์มลืมรหัสผ่าน
Route::get('/reset-password', [AuthController::class, 'showResetForm'])->name('password.reset.form');
Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.reset');

// หน้าโปรไฟล์
Route::get('/profile', [ProfileController::class, 'showProfile'])->middleware('auth')->name('profile');
Route::post('/profile/update', [ProfileController::class, 'updateProfile'])->middleware('auth')->name('update.profile');
Route::post('/profile/update-image', [ProfileController::class, 'updateImage'])->middleware('auth')->name('profile.updateImage');

// Route สำหรับการค้นหาในแดชบอร์ด
Route::get('/dashboard/search', [SearchController::class, 'search'])->name('dashboard.search');

Route::post('/materials/request/{id}', [MaterialController::class, 'request'])->name('materials.request');
Route::post('/equipments/request/{id}', [EquipmentController::class, 'request'])->name('equipments.request');

// Route สำหรับแสดงฟอร์มล็อกอินผู้ดูแลระบบ
Route::get('/login/admin', [AdminAuthController::class, 'showLogin'])->name('admin.login');

// Route สำหรับการล็อกอินผู้ดูแลระบบ
Route::post('/login/admin', [AdminAuthController::class, 'login'])->name('admin.login.submit');

// Route สำหรับหน้าแดชบอร์ดของผู้ดูแลระบบ
Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])
    ->name('admin.dashboard')
    ->middleware('auth:admin');


Route::resource('admin/materials', MaterialController::class)->names([
    'index' => 'admin.materials.index',
    'store' => 'admin.materials.store',
    'create' => 'admin.materials.create',
    'edit' => 'admin.materials.edit',
    'update' => 'admin.materials.update',
    'destroy' => 'admin.materials.destroy',
]);

Route::post('/admin/materials/destroy-selected', [MaterialController::class, 'destroySelected'])->name('admin.materials.destroySelected');


// Route สำหรับการจัดการครุภัณฑ์
Route::resource('admin/equipments', EquipmentController::class)->names([
    'index' => 'admin.equipments.index',
    'create' => 'admin.equipments.create',   // เพิ่มตรงนี้
    'store' => 'admin.equipments.store',
    'update' => 'admin.equipments.update',
    'edit' => 'admin.equipments.edit',
    'destroy' => 'admin.equipments.destroy',
]);

// Route สำหรับลบครุภัณฑ์ที่เลือก
Route::post('/admin/equipments/destroy-selected', [EquipmentController::class, 'destroySelected'])->name('admin.equipments.destroySelected');

Route::get('/admin/equipments/search', [EquipmentController::class, 'search'])
    ->name('admin.equipments.search');

Route::post('/admin/equipments/save', [EquipmentController::class, 'save'])->name('admin.equipments.save');

/// แสดงรายการอุปกรณ์ให้ยืม
Route::middleware('auth')->group(function () {
    Route::get('/borrows', [BorrowRequestController::class, 'myBorrows'])->name('borrow.list');
});

// แสดงฟอร์มยืนยันการยืม
Route::get('/borrow/confirm/{equipment}', [BorrowRequestController::class, 'confirm'])->name('borrow.confirm');

// ส่งคำขอยืม
Route::post('/borrow/submit/{equipment}', [BorrowRequestController::class, 'submit'])->name('borrow.submit');

// คืนครุภัณฑ์
Route::post('/borrow-request/{borrowRequest}/return', [BorrowRequestController::class, 'returnEquipment'])->name('borrow.return');

// รันฟังก์ชันเปลี่ยนสถานะอัตโนมัติ (อาจตั้งเป็น cron job หรือเรียกจาก route เฉพาะ)
Route::get('/borrow/auto-return', [BorrowRequestController::class, 'autoReturnAvailable'])->name('borrow.autoReturn');

// อนุมัติคำขอยืม
Route::post('/admin/borrow/approve/{id}', [AdminBorrowRequestController::class, 'approve'])->name('admin.borrow.approve');

// ปฏิเสธคำขอยืม
Route::post('/admin/borrow/reject/{id}', [AdminBorrowRequestController::class, 'reject'])->name('admin.borrow.reject');

// ออกใบยืม
Route::get('/admin/borrow/slip/{id}', [AdminBorrowRequestController::class, 'generateSlip'])->name('admin.borrow.slip');

// ดาวน์โหลด PDF
Route::get('/admin/borrow/download-slippdf/{id}', [AdminBorrowRequestController::class, 'downloadSlipPdf'])->name('admin.borrow.download-slippdf');

// **คืนครุภัณฑ์**
Route::post('/admin/borrow/return/{id}', [AdminBorrowRequestController::class, 'returnEquipment'])->name('admin.borrow.return');

// หน้าแสดงรายการคำขอยืมครุภัณฑ์
Route::get('/admin/borrow/requests', [AdminBorrowRequestController::class, 'index'])
    ->name('admin.borrow.requests');


Route::get('/admin/borrow-slip/{id}', [AdminBorrowRequestController::class, 'generateSlip'])
    ->name('admin.borrow.slip')
    ->middleware('auth:admin');

Route::prefix('admin')->group(function () {
    Route::get('users', [UserController::class, 'index'])->name('admin.users.index');
    Route::post('users', [UserController::class, 'store'])->name('admin.users.store');
    Route::get('users/{id}/edit', [UserController::class, 'edit'])->name('admin.users.edit');
    Route::put('users/{id}', [UserController::class, 'update'])->name('admin.users.update');
    Route::delete('users/{id}', [UserController::class, 'destroy'])->name('admin.users.destroy');
});

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {

    // ส่งคำร้องขอเบิกวัสดุ
    Route::get('/material-requests/create', [MaterialRequestController::class, 'create'])->name('material-requests.create');
    Route::post('/material-requests', [MaterialRequestController::class, 'store'])->name('material-requests.store');
    Route::get('/material-requests', [MaterialRequestController::class, 'index'])->name('material-requests.index');
});

// ประวัติวัสดุสำหรับ user ทั่วไป
Route::middleware('auth')->group(function () {
    Route::get('/materials/history', [MaterialRequestController::class, 'myMaterials'])->name('materials.history');
    Route::get('/materials/confirm/{id}', [MaterialRequestController::class, 'confirmRequest'])->name('materials.confirm');
});


Route::middleware(['auth:admin'])->prefix('admin')->name('admin.')->group(function () {
    // แสดงคำร้องขอเบิกวัสดุ
    Route::get('/material-approvals', [AdminMaterialApprovalController::class, 'index'])->name('material-approvals.index');

    // อนุมัติคำร้องขอเบิกวัสดุ
    Route::post('/material-approvals/{id}/approve', [AdminMaterialApprovalController::class, 'approve'])->name('material-approvals.approve');

    // ปฏิเสธคำร้องขอเบิกวัสดุ
    Route::post('/material-approvals/{id}/reject', [AdminMaterialApprovalController::class, 'reject'])->name('material-approvals.reject');
});

Route::get('/material-slips/{id}', [AdminMaterialApprovalController::class, 'showSlip'])->name('material-slips.show');
Route::get('/material-slips/{id}/pdf', [AdminMaterialApprovalController::class, 'generateSlipPdf'])->name('material-slips.pdf');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/equipment-report', [EquipmentReportController::class, 'index'])->name('equipments.equipment-report.index'); // รายงานหน้าธรรมดา
    Route::get('/equipment-report/preview', [EquipmentReportController::class, 'generatePdf'])->name('equipments.equipment-report-preview'); // preview
    Route::get('/equipment-report/download', [EquipmentReportController::class, 'downloadPdf'])->name('equipments.equipment-report-download'); // ดาวน์โหลด PDF
});

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/material-report', [MaterialReportController::class, 'index'])->name('materials.material-report.index'); // รายงานหน้าธรรมดา
    Route::get('/material-report/preview', [MaterialReportController::class, 'generatePdf'])->name('materials.material-report-preview'); // ชื่อ route นี้
    Route::get('/material-report/download', [MaterialReportController::class, 'downloadPdf'])->name('materials.material-report-download');
});

// 🔐 External Login Routes
Route::get('/external/login', [AuthController::class, 'showExternalLogin'])->name('external.login.form');
Route::post('/external/login', [AuthController::class, 'loginExternal'])->name('external.login');
Route::get('/external/logout', [AuthController::class, 'logoutExternal'])->name('external.logout');


Route::get('/external/dashboard', [DashboardController::class, 'externalIndex'])
    ->middleware('external_user') // ✅ เรียก middleware ที่ลงทะเบียนไว้
    ->name('external.dashboard');


Route::get('user/borrow/slip/{id}', [BorrowRequestController::class, 'downloadSlip'])
    ->middleware(['auth']) // ✅ ต้องล็อกอินก่อน
    ->name('user.borrow.downloadSlip');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');
Route::get('/dashboard/material-usage', [DashboardController::class, 'getMaterialUsage'])->name('dashboard.material.usage');
Route::get('/dashboard/equipment-usage', [DashboardController::class, 'getEquipmentUsage'])->name('dashboard.equipment.usage');