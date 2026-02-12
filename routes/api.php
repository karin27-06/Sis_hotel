<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\FloorController;
use App\Http\Controllers\Api\RoomTypeController;
use App\Http\Controllers\Api\SpaceController;
use App\Http\Controllers\Reportes\FloorPDFController;
use App\Http\Controllers\Reportes\RoomTypePDFController;
Route::get('/verificar-acceso', function () {
    return response()->json(['mensaje' => 'Ruta funcionando, usa POST para enviar datos.']);
});
Route::middleware('auth')->group(function () {
    Route::apiResource('tipo-habitacion', RoomTypeController::class);
    Route::apiResource('piso', FloorController::class);
    //Route::apiResource('caja', CajaController::class);

    #EXPORT API
    // Exportación a Excel
    Route::get('/tipos-habitacion/export-excel', [RoomTypeController::class, 'exportExcel']);
    Route::get('/pisos/export-excel', [FloorController::class, 'exportExcel']);

    // Exportación a PDF
    Route::get('/tipos-habitacion/export-pdf', [RoomTypePDFController::class, 'exportPDF']);
    Route::get('/pisos/export-pdf', [FloorPDFController::class, 'exportPDF']);

    #IMPORT API
    // Importación de Excel
    Route::post('/tipos-habitacion/import-excel', [RoomTypeController::class, 'importExcel']);
    Route::post('/pisos/import-excel', [FloorController::class, 'importExcel']);
});

