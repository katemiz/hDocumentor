<?php

use App\Http\Controllers\AIController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\DocTreeController;
use App\Http\Controllers\LetterController;
use App\Http\Controllers\MoMController;
use App\Http\Livewire\AIForm;
use App\Http\Livewire\AIList;
use App\Http\Livewire\CompanyForm;
use App\Http\Livewire\CompanyList;
use App\Http\Livewire\DocTreeForm;
use App\Http\Livewire\LetterForm;
use App\Http\Livewire\LetterList;
use App\Http\Livewire\MOMForm;
use App\Http\Livewire\MOMList;
use App\Http\Livewire\Tree;
use App\Http\Livewire\DocTreeList;
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
    // LETTER
    Route::get('/letter/{id}', [LetterController::class, 'view'])->name('view');
    Route::get('/letter-gui/{id?}', LetterForm::class);
    Route::get('/letter-list', LetterList::class);

    Route::post('/letter-dbact/{id?}', [LetterController::class, 'dbact']);
    Route::get('/letter-delete/{id}', [LetterController::class, 'delete']);
    Route::get('/letter-pdf/{id}', [LetterController::class, 'pdf']);
    Route::get('/letter-sign/{id}', [LetterController::class, 'sign']);

    // COMPANY
    Route::get('/company/{id}', [CompanyController::class, 'view'])->name(
        'cview'
    );
    Route::get('/company-gui/{id?}', CompanyForm::class);
    Route::get('/company-list', CompanyList::class);
    Route::post('/company-dbact/{id?}', [CompanyController::class, 'dbact']);

    // MOM
    Route::get('/mom-greet', [MoMController::class, 'greet'])->name('mom');

    Route::get('/mom/{id}', [MoMController::class, 'view'])->name('momview');
    Route::get('/mom-gui/{idMOM?}', MOMForm::class);
    Route::post('/mom-dbact/{id?}', [MoMController::class, 'dbact']);
    Route::get('/mom-list', MOMList::class);

    // AI
    Route::get('/ai/{id?}', [AIController::class, 'view'])->name('aiview');
    Route::get('/ai-gui/{id?}', AIForm::class);
    Route::get('/mom-ai-gui/{idMOM}/{id?}', AIForm::class);
    Route::post('/ai-dbact/{idMOM}/{id?}', [AIController::class, 'dbact']);
    Route::get('/ai-delete/{id}', [AIController::class, 'delete']);
    Route::get('/ai-list', AIList::class);

    // TREE
    Route::get('/doctree-view/{id}', [DocTreeController::class, 'view'])->name(
        'doctreeview'
    );
    Route::get('/doctree-list', DocTreeList::class)->name('dtlist');
    Route::get('/doctree-form/{id?}', DocTreeForm::class);
    Route::post('/doctree-db/{id?}', [DocTreeController::class, 'db']);
    Route::get('/doctree-delete/{id}', [DocTreeController::class, 'delete']);
    Route::get('/doctree-tree/{id}', Tree::class)->name('tree');
});
