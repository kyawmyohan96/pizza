<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\PizzaController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ContactController;


Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        if(Auth::check()){
            if(Auth::user()->role == 'admin'){
                return redirect()->route('admin#profile');
                }else if(Auth::user()->role == 'user'){
                    return redirect()->route('user#index');
                }


        }
        return view('dashboard');
    })->name('dashboard');
});



Route::group(['prefix'=>'admin'],function(){
    // Route::get('/',[CategoryController::class,'index'])->name('admin#index');
    Route::get('profile',[AdminController::class,'profile'])->name('admin#profile');

    Route::post('updateProfile/{id}',[AdminController::class,'updateProfile'])->name('admin#updateProfile');
    Route::get('changePassword',[AdminController::class,'changePasswordPage'])->name('admin#changePasswordPage');
    Route::post('changePassword/{id}',[AdminController::class,'changePassword'])->name('admin#changePassword');





    Route::get('category',[CategoryController::class,'category'])->name('admin#category');
    Route::get('addCategory',[CategoryController::class,'addCategory'])->name('admin#addCategory');
    Route::post('createCategory',[CategoryController::class,'createCategory'])->name('admin#createCategory');
    Route::get('deleteCategory/{id}',[CategoryController::class,'deleteCategory'])->name('admin#deleteCategory');
    Route::get('editCategory/{id}',[CategoryController::class,'editCategory'])->name('admin#editCategory');
    Route::post('updateCategory',[CategoryController::class, 'updateCategory'])->name('admin#updateCategory');
    Route::get('category/search', [CategoryController::class, 'searchCategory'])->name('admin#searchCategory');
    Route::get('categoryItem/{id}',[PizzaController::class,'categoryItem'])->name('admin#categoryItem');


       

    Route::get('pizza',[PizzaController::class,'pizza'])->name('admin#pizza');
    Route::get('createPizza',[PizzaController::class,'createPizza'])->name('admin#createPizza');
    Route::post('insertPizza', [PizzaController::class, 'insertPizza'])->name('admin#insertPizza');
    Route::get('deletePizza/{id}',[PizzaController::class,'deletePizza'])->name('admin#deletePizza');
    Route::get('pizzaInfo/{id}',[PizzaController::class,'pizzaInfo'])->name('admin#pizzaInfo');
    Route::get('editPizza/{id}',[PizzaController::class,'editPizza'])->name('admin#editPizza');
    Route::post('updatePizza/{id}',[PizzaController::class,'updatePizza'])->name('admin#updatePizza');
    Route::get('pizza/search',[PizzaController::class,'searchPizza'])->name('admin#searchPizza');

    Route::get('userList',[UserController::class,'userList'])->name('admin#userList');
    Route::get('adminList',[UserController::class,'adminList'])->name('admin#adminList');
    Route::get('userList/search',[UserController::class,'userSearch'])->name('admin#userSearch');
    Route::get('userList/delete/{id}',[UserController::class,'userDelete'])->name('admin#userDelete');
    Route::get('admin/search',[UserController::class,'adminSearch'])->name('admin#adminSearch');
    Route::get('adminList/delete/{id}',[UserController::class,'adminDelete'])->name('admin#adminDelete');


    Route::get('contact/list',[ContactController::class,'contactList'])->name('admin#contactList');
    Route::get('contact/search',[ContactController::class,'contactSearch'])->name('admin#contactSearch');






});

Route::group(['prefix'=>'user'],function(){
    Route::get('/',[UsersController::class,'index'])->name('user#index');

    Route::get('pizza/details/{id}',[UsersController::class,'pizzaDetails'])->name('user#pizzaDetails');
    Route::get('category/search/{id}',[UsersController::class,'categorySearch'])->name('user#categorySearch');
    Route::get('search/item',[UsersController::class,'searchItem'])->name('user#searchItem');
    Route::post('contact/create',[ContactController::class,'contactCreate'])->name('user#contactCreate');

});



