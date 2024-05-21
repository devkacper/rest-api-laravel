<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PetController;

Route::apiResources([
    'pet' => PetController::class
]);
