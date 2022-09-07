<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\LetterController;
use App\Http\Livewire\CompanyActions;
use App\Http\Livewire\LetterActions;
use App\Http\Livewire\LetterList;
use Illuminate\Support\Facades\Route;

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

Route::get('lang/{lang}', [
    'as' => 'lang.switch',
    'uses' => 'App\Http\Controllers\LanguageController@switchLang',
]);

Route::get('/dashboard', function () {
    return view('dashboard');
})
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

require __DIR__ . '/auth.php';

Route::middleware(['auth'])->group(function () {
    // Route::get('/docs-list', DocsList::class);

    // LETTER
    Route::get('/letter/{id}', [LetterController::class, 'view'])->name('view');
    Route::get('/letter-gui/{id?}', LetterActions::class);
    Route::get('/letter-list', LetterList::class);

    Route::post('/letter-dbact/{id?}', [LetterController::class, 'dbact']);
    Route::get('/letter-delete/{id}', [LetterController::class, 'delete']);
    Route::get('/letter-pdf/{id}', [LetterController::class, 'pdf']);

    // Route::get('/letter-viewpdfhtml/{id}', [
    //     LetterController::class,
    //     'viewPdfHtml',
    // ]);

    // COMPANY
    Route::get('/company/{id}', [CompanyController::class, 'view']);
    Route::get('/company-gui/{id?}', CompanyActions::class);

    Route::post('/company-dbact/{id?}', [CompanyController::class, 'dbact']);
    Route::get('/company-pdf/{id}', [CompanyController::class, 'pdf']);
});
