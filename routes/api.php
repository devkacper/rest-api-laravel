<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PetController;

Route::get('/pet/findByStatus', [PetController::class, 'findByStatus'])->name('findByStatus');
Route::post('/pet/{pet}/uploadImage', [PetController::class, 'uploadImage'])->name('uploadImage');

Route::apiResources([
    'pet' => PetController::class
]);


