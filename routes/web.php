<?php
// Routes

// Default Route
Route::get('/{any}', function () {
    return view('app');
})->where('any', '.*');
