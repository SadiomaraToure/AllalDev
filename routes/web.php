<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ArrondissementController;
use App\Http\Controllers\AscController;
use App\Http\Controllers\CarteController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CompteController;
use App\Http\Controllers\DepartementController;
use App\Http\Controllers\EntrepriseController;
use App\Http\Controllers\EvenementController;
use App\Http\Controllers\PointdeventeController;
use App\Http\Controllers\RegionController;
use App\Http\Controllers\TpeController;
use App\Http\Controllers\TransactionserviceviamobileController;
use App\Http\Controllers\TransactionserviceviatpesController;
use App\Http\Controllers\TransactionviamobileController;
use App\Http\Controllers\TransactionviatpeController;
use App\Http\Controllers\ZoneController;
use App\Http\Livewire\Achattickets;
use App\Http\Livewire\Admins;
use App\Http\Livewire\Arrondissements;
use App\Http\Livewire\Pointdeventes;
use App\Http\Livewire\Evenements;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Http\Controllers\QRCodeController;

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

Route::get('/',function() {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

//Route::get('admins', Admins::class);
//Route::get('arrondissements', Arrondissements::class);
//Route::get('pointdeventes', Pointdeventes::class);
//Route::get('evenements', Evenements::class);


//
//Route::get('achattickets', Pointdeventes::class);


//affichage liste Evenement côte point de vente
Route::middleware(['auth:sanctum', 'verified'])->get('/ptVente', function () {
    return view('AdminPointdeVente.index');
});


Route::get('listeEven','App\Http\Controllers\EvenementController@listeEvenements')->name('listeEven');
Route::get('ticket/{id}','App\Http\Controllers\EvenementController@AchatTicket')->name('ticket');
Route::post('getticket','App\Http\Controllers\EvenementController@EnregistrerTicket')->name('getticket');
Route::get('listTic','App\Http\Controllers\EvenementController@listeTicket')->name('listTic');


Route::resource('/admins', AdminController::class); 
Route::resource('arrondissements',ArrondissementController::class);
Route::resource('ascs',AscController::class);
Route::resource('cartes',CarteController::class);
Route::resource('clients',ClientController::class);
Route::resource('comptes',CompteController::class);
Route::resource('departements',DepartementController::class);
Route::resource('entreprises',EntrepriseController::class);
Route::resource('pointdeventes',PointdeventeController::class);
Route::resource('regions',RegionController::class);
Route::resource('tpes',TpeController::class);
Route::resource('transactionserviceviamobiles',TransactionserviceviamobileController::class);
Route::resource('transactionserviceviatpes',TransactionserviceviatpesController::class);
Route::resource('transactionviatpes',TransactionviamobileController::class);
Route::resource('transactionviamobiles',TransactionviatpeController::class);
Route::resource('evenements',EvenementController::class);
Route::resource('zones', ZoneController::class);





Route::get('simple-qr-code', [QRCodeController::class, 'simpleQr']);
Route::get('color-qr-code', [QRCodeController::class, 'colorQr']);
Route::get('image-qr-code', [QRCodeController::class, 'imageQr']);

Route::get('saveqrcode', [QRCodeController::class, 'qrcodesave']);

