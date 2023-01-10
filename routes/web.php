<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PartnerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserManagementController;




    //----------------------------------Welcome Page------------------------------------------

    Route::get('/', function () { return view('welcome');});

    //----------------------------------Authentification--------------------------------------

    Route::get('/signin', [UserManagementController::class, 'signin'])->name('signin');

    Route::get('/signup', [UserManagementController::class, 'signup'])->name('signup');

    Route::post('/validate_signup', [UserManagementController::class, 'validate_signup'])->name('validate_signup');

    Route::post('/validate_signin', [UserManagementController::class, 'validate_signin'])->name('validate_signin');

    Route::get('/logout', [UserManagementController::class, 'logout'])->name('logout');

    //--------------------------------------Users--------------------------------------------

    Route::get('/user/all' , [UserManagementController::class, 'users', ])->name('users');
            
    Route::post('/validate_newUser', [UserManagementController::class, 'validate_newUser'])->name('validate_newUser');

    Route::get('/user/editUser/{id}',[UserManagementController::class, 'editUser'])->name('editUser');

    Route::put('/user/updateUser',[UserManagementController::class, 'updateUser'])->name('updateUser');

    Route::delete('/user/deleteUser/{id}',[UserManagementController::class, 'deleteUser'])->name('deleteUser');

    //--------------------------------------Profile------------------------------------------

    Route::get('/profile/{partner}', [UserManagementController::class, 'profile'])->name('profile');

    Route::put('/profile/updateProfile/{partner}',[UserManagementController::class, 'updateProfile'])->name('updateProfile');

    Route::put('/profile/changePassword/{partner}', [UserManagementController::class, 'changePassword'])->name('changePassword');

    Route::put('/profile/changeProfileImage/{partner}', [UserManagementController::class, 'changeProfileImage'])->name('changeProfileImage');

    Route::delete('/profile/deleteAccount/{partner}',[UserManagementController::class, 'deleteAccount'])->name('deleteAccount');


    //------------------------------------Partners--------------------------------------

    Route::get('/partner/all' , [PartnerController::class, 'partners'])->name('partners');

    Route::delete('/partner/deletePartner/{id}',[PartnerController::class, 'deletePartner'])->name('deletePartner');

    //------------------------------------Products--------------------------------------

    Route::get('/product/all' , [ProductController::class, 'products'])->name('products');
    
    Route::get('/product/myall' , [ProductController::class, 'getMyProducts'])->name('myProducts');
    
    Route::get('/product/hisall/{id}' , [ProductController::class, 'getHisProducts'])->name('hisProducts');

    Route::post('/product/storeProduct', [ProductController::class, 'storeProduct'])->name('storeProduct');

    Route::get('/product/editProduct/{id}', [ProductController::class, 'editProduct'])->name('editProduct');

    Route::put('/product/updateProduct',[ProductController::class, 'updateProduct'])->name('updateProduct');

    Route::delete('/product/deleteProduct/{id}',[ProductController::class, 'deleteProduct'])->name('deleteProduct');

    //----------------------------------Category--------------------------------------------

    Route::post('/category/storeCategory', [CategoryController::class, 'storeCategory'])->name('storeCategory');  
        
    Route::get('/product/all/category/{id}' , [CategoryController::class, 'showByCategory'])->name('showByCategory');

    //----------------------------------Other Pages------------------------------------------

    Route::get('/dashboard', [UserManagementController::class, 'dashboard'])->name('dashboard');

    Route::get('/support', function () { return view('layouts.support');});


