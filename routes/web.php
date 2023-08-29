<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CmsController;


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

Route::prefix('/admin')->group(function () {
    Route::group(['middleware'=>['admin']],function(){
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
        
        Route::match(['get','post'],'/update-password', [AdminController::class, 'updatePassword'])->name('admin.updatePassword');
        Route::match(['get','post'],'/update-details', [AdminController::class, 'updateDetails'])->name('admin.updateDetails');
        Route::post('/check-current-password', [AdminController::class, 'checkCurrentPassword'])->name('admin.checkCurrentPassword');
        Route::get('/logout', [AdminController::class, 'logout'])->name('admin.logout');
        Route::get('/subadmins', [AdminController::class, 'subadmins'])->name('admin.subadmins');

        Route::post('update-subadmin-status',[AdminController::class,'update'])->name('admin.update');

        Route::get('delete-subadmin/{id?}', [AdminController::class, 'destroy'])->name('admin.destroy');

        Route::match(['get','post'],'add-edit-subadmins/{id?}', [AdminController::class, 'edit'])->name('admin.add_edit');
        Route::match(['get','post'],'update-role/{id?}', [AdminController::class, 'updateRole'])->name('admin.updateRole');

        

        

    });
    
    Route::match(['get','post'],'login', [AdminController::class, 'login'])->name('admin.login');

    Route::get('cms-page',[CmsController::class,'index'])->name('cms_page');
    Route::post('update-cms-page-status',[CmsController::class,'update'])->name('cms_page.update');

    Route::match(['get','post'],'add-edit-cms-page/{id?}', [CmsController::class, 'edit'])->name('cms_page.add_edit');
    Route::get('delete-cms-page/{id?}', [CmsController::class, 'destroy'])->name('cms_page.destroy');
    
    
    
    

    
});
