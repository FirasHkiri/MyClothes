<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\partnerController;
use App\Http\Controllers\productController;
use App\Http\Controllers\userController;
use App\Http\Controllers\categoryController;



    //----------------------------------Welcome Page------------------------------------------

    Route::get('/', function () { return view('welcome');});

    //----------------------------------Authentification--------------------------------------

    Route::get('/signin', [AuthController::class, 'index'])->name('signin');

    Route::get('/signup', [AuthController::class, 'signup'])->name('signup');

    Route::post('/validate_signup', [AuthController::class, 'validate_signup'])->name('validate_signup');

    Route::post('/validate_signin', [AuthController::class, 'validate_signin'])->name('validate_signin');

    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');


    //------------------------------------Products--------------------------------------

    Route::get('/product/all' , [productController::class, 'index'])->name('products');
    
    Route::get('/product/myall' , [productController::class, 'getMyProducts'])->name('myProducts');
    
    Route::get('/product/hisall/{user}' , [productController::class, 'getHisProducts'])->name('hisProducts');

    Route::get('/product/addProduct', [productController::class, 'create'])->name('addProduct');

    Route::post('/product/storeProduct', [productController::class, 'store'])->name('storeProduct');

    Route::get('/product/editProduct/{id}', [productController::class, 'edit'])->name('editProduct');

    Route::put('/product/updateProduct',[productController::class, 'update'])->name('updateProduct');

    Route::delete('/product/deleteProduct/{product}',[productController::class, 'delete'])->name('deleteProduct');

    //------------------------------------Partners--------------------------------------

    Route::get('/user/all' , [partnerController::class, 'index'])->name('users');

    Route::get('/user/showPartner/{user}', [partnerController::class, 'show'])->name('showPartner');

    Route::get('/user/editPartner/{user}', [partnerController::class, 'edit'])->name('editPartner');

    Route::put('/user/updatePartner/{user}',[partnerController::class, 'update'])->name('updatePartner');

    Route::delete('/user/deletePartner/{user}',[partnerController::class, 'delete'])->name('deletePartner');


        //------------------------------------Users--------------------------------------

        Route::get('/user/all' , [userController::class, 'index', ])->name('users');
        
        Route::post('/validate_newUser', [userController::class, 'validate_newUser'])->name('validate_newUser');
    
        Route::get('/user/editUser/{id}',[userController::class, 'editUser'])->name('editUser');

        Route::put('/user/updateUser',[userController::class, 'updateUser'])->name('updateUser');
    
        Route::delete('/user/deleteUser/{user}',[userController::class, 'delete'])->name('deleteUser');


        //------------------------------------Profile------------------------------------------

        Route::get('/profile/{user}', [partnerController::class, 'profile'])->name('profile');

        Route::put('/profile/updateProfile/{user}',[partnerController::class, 'updateProfile'])->name('updateProfile');

        Route::put('/profile/changePassword/{user}', [partnerController::class, 'changePassword'])->name('changePassword');

        Route::put('/profile/changeProfileImage/{user}', [partnerController::class, 'changeProfileImage'])->name('changeProfileImage');

        Route::delete('/profile/deleteAccount/{user}',[partnerController::class, 'deleteAccount'])->name('deleteAccount');

        //----------------------------------Category--------------------------------------------

        Route::post('/category/storeCategory', [categoryController::class, 'store'])->name('storeCategory');  
        
        Route::get('/product/all/category/shirts' , [categoryController::class, 'showShirts'])->name('shirts');

        Route::get('/product/all/category/shoes' , [categoryController::class, 'showShoes'])->name('shoes');

        Route::get('/product/all/category/pants' , [categoryController::class, 'showPants'])->name('pants');

        //----------------------------------Other Pages------------------------------------------

        Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');

        Route::get('/support', function () { return view('layouts.support');});


