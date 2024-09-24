<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MissionController;
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

Route::get('/', [MissionController::class, 'index']);
Route::get('/qr-code', [MissionController::class, 'qrcode'])->name('qrcode');
Route::get('/staff-qr-code', [QRCodeController::class, 'staffQrcode'])->name('staff.qrcode');
Route::post('/generate-qr', [QRCodeController::class, 'generateQRCode'])->name('qr.generate');
Route::get('/roll-attendance', [QRCodeController::class, 'rollAttendance'])->name('qr.roll.attendance');
Route::post('/roll-attendance', [QRCodeController::class, 'storeAttendance'])->name('store.attendance');

Route::get('/delete-attendance', [QRCodeController::class, 'destroyAttendance'])->name('destroy.attendance');

