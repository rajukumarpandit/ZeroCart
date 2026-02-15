<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Auth\AdminAuthController;
use App\Http\Controllers\Admin\Auth\DashboardController;
use App\Http\Controllers\Admin\RoleManagementController;
use App\Http\Controllers\Admin\PermissionManagementController;
use App\Http\Controllers\InstallerController;
use App\Http\Controllers\Ecome\TablePreferenceController;
use App\Http\Controllers\Ecome\CategoryController;
use App\Http\Controllers\Ecome\BrandController;
use App\Http\Controllers\Ecome\AttributeController;
use App\Http\Controllers\Ecome\AttributeValueController;
use App\Http\Controllers\Ecome\ProductController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/welcome', function () {
    return view('welcome2');
});
// installation project route

Route::middleware('install')->prefix('install')->group(function () {
    Route::get('/', [InstallerController::class, 'welcome'])->name('install.welcome');
    Route::get('/requirements', [InstallerController::class, 'requirements'])->name('install.requirements');
    Route::get('/permissions', [InstallerController::class, 'permissions'])->name('install.permissions');
    Route::get('/database', [InstallerController::class, 'database'])->name('install.database');
    Route::post('/database', [InstallerController::class, 'saveDatabase'])->name('install.saveDatabase');
    Route::get('/admin', [InstallerController::class, 'admin'])->name('install.admin');
    Route::post('/admin', [InstallerController::class, 'saveAdmin'])->name('install.saveAdmin');
    Route::get('/finish', [InstallerController::class, 'finish'])->name('install.finish');
});



Route::middleware(['auth','no-back'])->group(function () {
    Route::get('/home', [AdminAuthController::class, 'logout'])
    ->middleware('auth')
    ->name('admin.logout');
});
Route::middleware('guest')->group(function () {
    Route::get('/admin/login', [AdminAuthController::class, 'showLoginForm'])
        ->name('admin.login');

    Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('login');
});



/*
|--------------------------------------------------------------------------
| Admin Routes - Roles & Permissions
|--------------------------------------------------------------------------
*/

// Alternative: If you want different middleware for different actions
// Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {
    
//     // Routes accessible by users with specific permissions
//     Route::middleware(['permission:roles.view'])->group(function () {
//         Route::get('roles', [RoleManagementController::class, 'index'])->name('roles.index');
//         Route::get('roles/{role}', [RoleManagementController::class, 'show'])->name('roles.show');
//     });
    
//     Route::middleware(['permission:roles.create'])->group(function () {
//         Route::get('roles/create', [RoleManagementController::class, 'create'])->name('roles.create');
//         Route::post('roles', [RoleManagementController::class, 'store'])->name('roles.store');
//     });
    
//     Route::middleware(['permission:roles.edit'])->group(function () {
//         Route::get('roles/{role}/edit', [RoleManagementController::class, 'edit'])->name('roles.edit');
//         Route::put('roles/{role}', [RoleManagementController::class, 'update'])->name('roles.update');
//     });
    
//     Route::middleware(['permission:roles.delete'])->group(function () {
//         Route::delete('roles/{role}', [RoleManagementController::class, 'destroy'])->name('roles.destroy');
//     });
    
//     // Permissions routes with specific permissions
//     Route::middleware(['permission:permissions.view'])->group(function () {
//         Route::get('permissions', [PermissionManagementController::class, 'index'])->name('permissions.index');
//         Route::get('permissions/{permission}', [PermissionManagementController::class, 'show'])->name('permissions.show');
//     });
    
//     Route::middleware(['permission:permissions.create'])->group(function () {
//         Route::get('permissions/create', [PermissionManagementController::class, 'create'])->name('permissions.create');
//         Route::post('permissions', [PermissionManagementController::class, 'store'])->name('permissions.store');
//     });
    
//     Route::middleware(['permission:permissions.edit'])->group(function () {
//         Route::get('permissions/{permission}/edit', [PermissionManagementController::class, 'edit'])->name('permissions.edit');
//         Route::put('permissions/{permission}', [PermissionManagementController::class, 'update'])->name('permissions.update');
//         Route::post('permissions/sync', [PermissionManagementController::class, 'sync'])->name('permissions.sync');
//     });
    
//     Route::middleware(['permission:permissions.delete'])->group(function () {
//         Route::delete('permissions/{permission}', [PermissionManagementController::class, 'destroy'])->name('permissions.destroy');
//         Route::delete('permissions/bulk-delete', [PermissionManagementController::class, 'bulkDelete'])->name('permissions.bulk-delete');
//     });
// });

Route::middleware(['auth','admin', 'role:super_admin|admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/logout', [AdminAuthController::class, 'logout'])->name('logout');
    Route::resource('roles', RoleManagementController::class);
    Route::post('roles/{role}/duplicate', [RoleManagementController::class, 'duplicate'])->name('roles.duplicate');
    Route::get('roles/{role}/export', [RoleManagementController::class, 'export'])->name('roles.export');
    Route::post('roles/{role}/assign-users', [RoleManagementController::class, 'assignToUsers'])->name('roles.assign-users');
    
    // Permissions Management
    Route::resource('permissions', PermissionManagementController::class);
    Route::post('permissions/sync', [PermissionManagementController::class, 'sync'])->name('permissions.sync');
    Route::delete('permissions/bulk-delete', [PermissionManagementController::class, 'bulkDelete'])->name('permissions.bulk-delete');
    Route::get('/dashboard', [DashboardController::class , 'dashboard'])->name('dashboard');
    Route::post('/table/pref/save',[TablePreferenceController::class,'save'])->name('table.pref.save');
    Route::post('/table/pref/reset',[TablePreferenceController::class,'reset'])->name('table.pref.reset');
    Route::prefix('categories')->name('categories.')->group(function(){
        Route::get('list',[CategoryController::class,'index'])->name('index');
        Route::get('create', [CategoryController::class, 'create'])->name('create');
        Route::post('store', [CategoryController::class, 'store'])->name('store');
        Route::get('edit/{category}', [CategoryController::class, 'edit'])->name('edit');
        Route::put('update/{category}', [CategoryController::class, 'update'])->name('update');
        Route::delete('delete/{category}', [CategoryController::class, 'destroy'])->name('destroy');
        Route::post('restore/{category}', [CategoryController::class, 'restore'])->name('restore');
        Route::delete('force-delete/{category}', [CategoryController::class, 'forceDelete'])->name('forceDelete');
    });
    Route::prefix('brands')->name('brands.')->group(function () {

        Route::get('list', [BrandController::class, 'index'])->name('index');
        Route::get('create', [BrandController::class, 'create'])->name('create');
        Route::post('store', [BrandController::class, 'store'])->name('store');
        Route::get('edit/{brand}', [BrandController::class, 'edit'])->name('edit');
        Route::put('update/{brand}', [BrandController::class, 'update'])->name('update');
        Route::delete('delete/{brand}', [BrandController::class, 'destroy'])->name('destroy');
        Route::post('restore/{id}', [BrandController::class, 'restore'])->name('restore');
        Route::delete('force-delete/{id}', [BrandController::class, 'forceDelete'])->name('forceDelete');
    });
    Route::prefix('attributes')->name('attributes.')->group(function () {

        Route::get('list', [AttributeController::class,'index'])->name('index');
        Route::get('create', [AttributeController::class,'create'])->name('create');
        Route::post('store', [AttributeController::class,'store'])->name('store');
        Route::get('edit/{attributes}', [AttributeController::class,'edit'])->name('edit');
        Route::put('update/{attributes}', [AttributeController::class,'update'])->name('update');
        Route::delete('delete/{attributes}', [AttributeController::class, 'destroy'])->name('destroy');
        Route::post('restore/{id}', [AttributeController::class, 'restore'])->name('restore');
        Route::delete('force-delete/{id}', [AttributeController::class, 'forceDelete'])->name('forceDelete');
    });
    Route::prefix('attribute-values')->name('attribute-values.')->group(function(){
        
        Route::get('list/{id}',[AttributeValueController::class, 'index'])->name('index');
        Route::get('create', [AttributeValueController::class,'create'])->name('create');
        Route::post('store', [AttributeValueController::class,'store'])->name('store');
        Route::get('edit/{attributeValues}', [AttributeValueController::class,'edit'])->name('edit');
        Route::put('update/{attributeValues}', [AttributeValueController::class,'update'])->name('update');
        Route::delete('delete/{attributeValues}', [AttributeValueController::class, 'destroy'])->name('destroy');
        Route::post('restore/{id}', [AttributeValueController::class, 'restore'])->name('restore');
        Route::delete('force-delete/{id}', [AttributeValueController::class, 'forceDelete'])->name('forceDelete');
        Route::get('by-attribute', [AttributeValueController::class,'getValues'])->name('by-attribute');

    });
    Route::prefix('products')->name('products.')->group(function(){
        
        Route::get('list',[ProductController::class, 'index'])->name('index');
        Route::get('create', [ProductController::class,'create'])->name('create');
        Route::post('store', [ProductController::class,'store'])->name('store');
        Route::get('edit/{product}', [ProductController::class,'edit'])->name('edit');
        Route::put('update/{product}', [ProductController::class,'update'])->name('update');
        Route::delete('delete/{product}', [ProductController::class, 'destroy'])->name('destroy');
        Route::post('restore/{id}', [ProductController::class, 'restore'])->name('restore');
        Route::delete('force-delete/{id}', [ProductController::class, 'forceDelete'])->name('forceDelete');
        Route::get('by-attribute', [ProductController::class,'getValues'])->name('by-attribute');

    });
    

        
});



Route::get('/index', function () {
    return view('index');
});
Route::get('/alert', function () {
    return view('files.alerts');
});
Route::get('/badges', function () {
    return view('files.badges');
});
Route::get('/button', function () {
    return view('files.buttons');
});
Route::get('/card', function () {
    return view('files.cards');
});
Route::get('/datatable', function () {
    return view('files.datatable');
});
Route::get('/advance-datatable', function () {
    return view('files.advance-datatable');
});
Route::get('/form', function () {
    return view('files.form-elements');
});
Route::get('/validation', function () {
    return view('files.form-validation');
});
Route::get('/progress', function () {
    return view('files.progress');
});
Route::get('/basic-table', function () {
    return view('files.basic-table');
});
Route::get('/wizard', function () {
    return view('files.form-wizard');
});
Route::get('/profile', function () {
    return view('files.profile');
});
Route::get('/datepicker', function () {
    return view('files.date-picker');
});
Route::get('/richeditor', function () {
    return view('files.richeditor');
});
Route::get('/setting', function () {
    return view('files.setting');
});
Route::get('/invoice', function () {
    return view('files.invoice');
});
Route::get('/select2', function () {
    return view('files.select2');
});
Route::get('/tags', function () {
    return view('files.tags');
});