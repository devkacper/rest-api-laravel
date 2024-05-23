<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PetController;

Route::resources([
    '/' => PetController::class,
], ['only' => ['index']]);

Route::resources([
    'pets' => PetController::class,
], ['except' => ['index']]);
