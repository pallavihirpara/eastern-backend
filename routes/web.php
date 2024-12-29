<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\ForgetPassController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SupplierController;
use App\Http\Controllers\Admin\UserController; 

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () { 
    return view('welcome');
});
Route::get('/admin', function () {
    return redirect()->route('login');
});
 
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login'])->name('login.post');

//forget-password
Route::get('forget-password', [ForgetPassController::class, 'showForgetPasswordForm'])->name('forget.password.get');
Route::post('forget-password', [ForgetPassController::class, 'submitForgetPasswordForm'])->name('forget.password.post'); 
Route::get('reset-password/{token}', [ForgetPassController::class, 'showResetPasswordForm'])->name('reset.password.get');
Route::post('reset-password', [ForgetPassController::class, 'submitResetPasswordForm'])->name('reset.password.post');


Route::group(['prefix' => 'admin','middleware' => 'auth'], function () {
    Route::get('dashboard', [AdminController::class,'index'])->name('admin.dashboard');
    Route::prefix('change_pass')->group(function () {
        Route::get('/', [AdminController::class,'changePass'])->name('admin.change.pass');
        Route::post('/store', [AdminController::class,'changePassStore'])->name('admin.change_pass.store');
    });
   
    Route::get('update_contact/{id}', [AdminController::class,'updateContact'])->name('admin.update_contact.index');
    
    //users
    Route::prefix('users')->group(function () {
        Route::get('/', [UserController::class,'index'])->name('admin.user.index');
        Route::get('/add', [UserController::class,'add'])->name('admin.user.add');
        Route::post('/store', [UserController::class,'store'])->name('admin.user.store');
        Route::get('/get-city/{state_id}', [UserController::class,'getCity'])->name('get-city');
        Route::get('/get-state', [UserController::class,'filterState'])->name('search-state');
        Route::get('view/{id}', [UserController::class,'view'])->name('admin.user.view');
        Route::get('delete/{id}', [UserController::class,'delete'])->name('admin.user.delete');
        Route::get('edit/{id}', [UserController::class,'edit'])->name('admin.user.edit');
        Route::post('update/{id}', [UserController::class,'update'])->name('admin.user.update');
    }); 

    //roles
    Route::prefix('roles')->group(function () {
        Route::get('/', [RoleController::class,'index'])->name('admin.role.index');
        Route::get('/add', [RoleController::class,'add'])->name('admin.role.add');
        Route::post('/store', [RoleController::class,'store'])->name('admin.role.store');
        Route::get('delete/{id}', [RoleController::class,'delete'])->name('admin.role.delete');
        Route::get('edit/{id}', [RoleController::class,'edit'])->name('admin.role.edit');
        Route::post('update/{id}', [RoleController::class,'update'])->name('admin.role.update');
    }); 
    
    //permission
    Route::prefix('permission')->group(function () {
        Route::get('/', [PermissionController::class,'index'])->name('admin.permission.index');
        Route::get('/add', [PermissionController::class,'add'])->name('admin.permission.add');
        Route::post('/store', [PermissionController::class,'store'])->name('admin.permission.store');
        Route::get('delete/{id}', [PermissionController::class,'delete'])->name('admin.permission.delete');
        Route::get('edit/{id}', [PermissionController::class,'edit'])->name('admin.permission.edit');
        Route::post('update/{id}', [PermissionController::class,'update'])->name('admin.permission.update');
    }); 
     
    //suppliers
    Route::group(['prefix' => 'suppliers'], function () {
        Route::get('/', [SupplierController::class,'index'])->name('admin.supplier.index');
        Route::get('/add', [SupplierController::class,'add'])->name('admin.supplier.add');
        Route::post('/store', [SupplierController::class,'store'])->name('admin.supplier.store');
        Route::get('view/{id}', [SupplierController::class,'view'])->name('admin.supplier.view');
        Route::get('delete/{id}', [SupplierController::class,'delete'])->name('admin.supplier.delete');
        Route::get('edit/{id}', [SupplierController::class,'edit'])->name('admin.supplier.edit');
        Route::post('update/{id}', [SupplierController::class,'update'])->name('admin.supplier.update');
    }); 
   
    //customers
    Route::group(['prefix' => 'customers'], function () {
        Route::get('/', [CustomerController::class,'index'])->name('admin.customer.index');
        Route::get('/add', [CustomerController::class,'add'])->name('admin.customer.add');
        Route::post('/store', [CustomerController::class,'store'])->name('admin.customer.store');
        Route::get('delete/{id}', [CustomerController::class,'delete'])->name('admin.customer.delete');
        Route::get('edit/{id}', [CustomerController::class,'edit'])->name('admin.customer.edit');
        Route::post('update/{id}', [CustomerController::class,'update'])->name('admin.customer.update');
    }); 
 

    Route::get('logout-user', [LoginController::class, 'logOut'])->name('logout');
});