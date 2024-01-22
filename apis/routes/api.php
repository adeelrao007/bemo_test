<?php

use App\Models\Card;
use App\Models\Column;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;
use Spatie\DbDumper\Databases\MySql;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('/list-cards', function (Request $request) {
    $response = (object) [];
    if ($request::has('access_token') && $request::get('access_token') === '42gA1S5') {
        $response = Card::orderById()->filter(Request::only('status', 'date'))->get();
    }

    return $response->toJson();
});

Route::get('/db-dump', function () {
    MySql::create()
        ->setDbName(env('DB_DATABASE'))
        ->setUserName(env('DB_USERNAME'))
        ->setPassword(env('DB_PASSWORD'))
        ->dumpToFile(env('DB_DATABASE'));
});

Route::get('/columns', function () {
    return Column::with('cards')->activeColumns()->get()->toJson();
});

Route::post('/update-columns', function (Request $request) {
    return $request->user();
});

Route::post('/update-card', function (Request $request) {
    return $request->user();
});
