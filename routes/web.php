<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TransactionController;

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

Route::get('/', [TransactionController::class,'index']);
Route::get('/add-transaction',[TransactionController::class,'showAddTransactionForm']);
Route::post('/add-transaction',[TransactionController::class,'store']);
Route::get('/edit-transaction/{id}',[TransactionController::class,'showEditTransactionForm']);
Route::post('/edit-transaction/{id}',[TransactionController::class,'update']);
Route::delete('/delete-transaction/{id}',[TransactionController::class,'destroy']);