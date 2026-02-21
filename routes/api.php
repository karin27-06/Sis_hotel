<?php

use App\Http\Controllers\Api\ClientTypeController;
use App\Http\Controllers\Api\CustomerController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\FloorController;
use App\Http\Controllers\Api\RoomController;
use App\Http\Controllers\Api\RoomTypeController;
use App\Http\Controllers\Api\SpaceController;
use App\Http\Controllers\Reportes\ClientTypePDFController;
use App\Http\Controllers\Reportes\CustomerPDFController;
use App\Http\Controllers\Reportes\FloorPDFController;
use App\Http\Controllers\Reportes\RoomTypePDFController;
use App\Models\ClientType;

Route::get('/verificar-acceso', function () {
    return response()->json(['mensaje' => 'Ruta funcionando, usa POST para enviar datos.']);
});
Route::middleware('auth')->group(function () {
    Route::apiResource('tipo-habitacion', RoomTypeController::class);
    Route::apiResource('piso', FloorController::class);
    Route::apiResource('habitacion', RoomController::class);
    Route::apiResource('cliente', CustomerController::class);
    Route::apiResource('tipos_clientes', ClientType::class);
    //Route::apiResource('caja', CajaController::class);

    #EXPORT API
    // Exportación a Excel
    Route::get('/tipos-habitacion/export-excel', [RoomTypeController::class, 'exportExcel']);
    Route::get('/pisos/export-excel', [FloorController::class, 'exportExcel']);
    Route::get('/habitaciones/export-excel', [RoomController::class, 'exportExcel']);
    Route::get('/clientes/export-excel', [CustomerController::class, 'exportExcel']);
    Route::get('/tipos_clientes/export-excel', [ClientTypeController::class, 'exportExcel']);

    // Exportación a PDF
    Route::get('/tipos-habitacion/export-pdf', [RoomTypePDFController::class, 'exportPDF']);
    Route::get('/pisos/export-pdf', [FloorPDFController::class, 'exportPDF']);
    Route::get('/clientes/export-pdf', [CustomerPDFController::class, 'exportPDF']);
    Route::get('/tipos_clientes/export-pdf', [ClientTypePDFController::class, 'exportPDF']);
    //Route::get('/habitaciones/export-pdf', [RoomPDFController::class, 'exportPDF']);

    #IMPORT API
    // Importación de Excel
    Route::post('/tipos-habitacion/import-excel', [RoomTypeController::class, 'importExcel']);
    Route::post('/pisos/import-excel', [FloorController::class, 'importExcel']);
    Route::post('/habitaciones/import-excel', [RoomController::class, 'importExcel']);
    Route::post('/clientes/import-excel', [CustomerController::class, 'importExcel']);
    Route::post('/tipos_clientes/import-excel', [ClientTypeController::class, 'importExcel']);
});

