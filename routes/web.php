<?php

use App\Http\Controllers\Api\DashboardController;
use App\Http\Controllers\Api\ConsultasDni;
use App\Http\Controllers\Api\ConsultasId;
use App\Http\Controllers\Api\FloorController;
use App\Http\Controllers\Api\RolesController;
use App\Http\Controllers\Api\RoomTypeController;
use App\Http\Controllers\Api\UsuariosController;
use App\Http\Controllers\Api\SpaceController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Reportes\FloorPDFController;
use App\Http\Controllers\Reportes\RoomTypePDFController;
use App\Http\Controllers\Reportes\SpacePDFController;
use App\Http\Controllers\Web\FloorWebController;
use App\Http\Controllers\Web\RoomTypeWebController;
use App\Http\Controllers\Web\UsuarioWebController;

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use PSpell\Config;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        $user = Auth::user();
        return Inertia::render('Dashboard', [
            'mustReset' => $user->restablecimiento == 0,
        ]);
    })->name('dashboard');

    #VISTAS DEL FRONTEND
    Route::get('/tipos-habitacion', [RoomTypeWebController::class, 'index'])->name('index.view');
    Route::get('/usuario', [UsuarioWebController::class, 'index'])->name('index.view');
    Route::get('/roles', [UsuarioWebController::class, 'roles'])->name('roles.view');
    Route::get('/datos/dashboard', [DashboardController::class, 'getdatos']);
    Route::get('/pisos', [FloorWebController::class, 'index'])->name('index.view');

    #CONSULTA  => BACKEND
    Route::get('/consulta/{dni}', [ConsultasDni::class, 'consultar'])->name('consultar.dni');
    Route::get('/user-id', [ConsultasId::class, 'getUserId'])->middleware('auth:api');

    // TIPO DE HABITACION -> BACKEND
    Route::prefix('tipo-habitacion')->group(function () {
        Route::get('/', [RoomTypeController::class, 'index'])->name('tipo-habitacion.index');
        Route::post('/', [RoomTypeController::class, 'store'])->name('tipos-habitacion.store');
        Route::get('/{roomtype}', [RoomTypeController::class, 'show'])->name('tipos-habitacion.show');
        Route::put('/{roomtype}', [RoomTypeController::class, 'update'])->name('tipos-habitacion.update');
        Route::delete('/{roomtype}', [RoomTypeController::class, 'destroy'])->name('tipos-habitacion.destroy');
    });

    #USUARIOS -> BACKEND
    Route::prefix('usuarios')->group(function () {
        Route::get('/', [UsuariosController::class, 'index'])->name('usuarios.index');
        Route::post('/', [UsuariosController::class, 'store'])->name('usuarios.store');
        Route::get('/{user}', [UsuariosController::class, 'show'])->name('usuarios.show');
        Route::put('/{user}', [UsuariosController::class, 'update'])->name('usuarios.update');
        Route::delete('/{user}', [UsuariosController::class, 'destroy'])->name('usuarios.destroy');
    });

    #ROLES => BACKEND
    Route::prefix('rol')->group(function () {
        Route::get('/', [RolesController::class, 'index'])->name('rol.index');
        Route::get('/Permisos', [RolesController::class, 'indexPermisos'])->name('rol.indexPermisos');
        Route::post('/', [RolesController::class, 'store'])->name('rol.store');
        Route::get('/{id}', [RolesController::class, 'show'])->name('rol.show');
        Route::put('/{id}', [RolesController::class, 'update'])->name('rol.update');
        Route::delete('/{id}', [RolesController::class, 'destroy'])->name('rol.destroy');
    });

    #PISOS -> BACKEND
    Route::prefix('piso')->group(function () {
        Route::get('/', [FloorController::class, 'index'])->name('Pisos.index');
        Route::post('/', [FloorController::class, 'store'])->name('Pisos.store');
        Route::get('/{floor}', [FloorController::class, 'show'])->name('Pisos.show');
        Route::put('/{floor}', [FloorController::class, 'update'])->name('Pisos.update');
        Route::delete('/{floor}', [FloorController::class, 'destroy'])->name('Pisos.destroy');
    });
    Route::prefix('panel/reports')->group(function () {

        // EXPORTACION Y IMPORTACION TIPOS DE HABITACION
        Route::get('/export-excel-roomtypes', [RoomTypeController::class, 'exportExcel'])->name('export-excel-roomtypes');
        Route::get('/export-pdf-roomtypes', [RoomTypePDFController::class, 'exportPDF'])->name('export-pdf-roomtypes');

        #EXPORTACION Y IMPORTACION PISOS
        Route::get('/export-excel-floors', [FloorController::class, 'exportExcel'])->name('export-excel-floors');
        Route::get('/export-pdf-floors', [FloorPDFController::class, 'exportPDF'])->name('export-pdf-floors');
        // Ruta para importar desde Excel
        Route::post('/import-excel-floors', [FloorController::class, 'importExcel'])->name('import-excel-floors');
    });
});
            //RUTAS PARA QUE PASEN EL TEST
        Route::get('/register', [RegisteredUserController::class, 'create'])
            ->middleware('guest')
            ->name('register');

        Route::post('/register', [RegisteredUserController::class, 'store'])
            ->middleware('guest');
// Archivos de configuración adicionales
require __DIR__ . '/settings.php';
require __DIR__ . '/auth.php';
