<?php

use App\Http\Controllers\Api\ClientTypeController;
use App\Http\Controllers\Api\DashboardController;
use App\Http\Controllers\Api\ConsultasDni;
use App\Http\Controllers\Api\ConsultasId;
use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\FloorController;
use App\Http\Controllers\Api\RolesController;
use App\Http\Controllers\Api\RoomController;
use App\Http\Controllers\Api\RoomTypeController;
use App\Http\Controllers\Api\UsuariosController;
use App\Http\Controllers\Api\SpaceController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Reportes\ClientTypePDFController;
use App\Http\Controllers\Reportes\CustomerPDFController;
use App\Http\Controllers\Reportes\FloorPDFController;
use App\Http\Controllers\Reportes\RoomTypePDFController;
use App\Http\Controllers\Reportes\SpacePDFController;
use App\Http\Controllers\Web\ClientTypeWebController;
use App\Http\Controllers\Web\CustomerWebController;
use App\Http\Controllers\Web\FloorWebController;
use App\Http\Controllers\Web\RoomTypeWebController;
use App\Http\Controllers\Web\RoomWebController;
use App\Http\Controllers\Web\UsuarioWebController;
use Illuminate\Http\Request;
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
    Route::get('/habitaciones', [RoomWebController::class, 'index'])->name('index.view');
    Route::get('/clientes', [CustomerWebController::class, 'index'])->name('index.view');
    Route::get('/tipo_clientes', [ClientTypeWebController::class, 'index'])->name('index.view');

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

    #habitacion => BACKEND
    Route::prefix('habitacion')->group(function () {
        Route::get('/', [RoomController::class, 'index'])->name('habitacion.index');
        Route::post('/', [RoomController::class, 'store'])->name('habitaciones.store');
        Route::get('{room}', [RoomController::class, 'show'])->name('habitaciones.show');
        Route::put('{room}', [RoomController::class, 'update'])->name('habitaciones.update');
        Route::delete('{room}', [RoomController::class, 'destroy'])->name('habitaciones.destroy');
    });
    #CLIENTE => BACKEND
    Route::prefix('cliente')->group(function () {
        Route::get('/', [CustomerController::class, 'index'])->name('cliente.index');
        Route::post('/', [CustomerController::class, 'store'])->name('clientes.store');
        Route::get('{customer}', [CustomerController::class, 'show'])->name('clientes.show');
        Route::put('{customer}', [CustomerController::class, 'update'])->name('clientes.update');
        Route::delete('{customer}', [CustomerController::class, 'destroy'])->name('clientes.destroy');
    });
    #TIPOS DE CLIENTES -> BACKEND
    Route::prefix('tipo_cliente')->group(function () {
        Route::post('/', [ClientTypeController::class, 'store'])->name('Tipos_Clientes.store');
        Route::get('/{clientType}', [ClientTypeController::class, 'show'])->name('Tipos_Clientes.show');
        Route::put('/{clientType}', [ClientTypeController::class, 'update'])->name('Tipos_Clientes.update');
        Route::delete('/{clientType}', [ClientTypeController::class, 'destroy'])->name('Tipos_Clientes.destroy');
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

        #EXPORTACION Y IMPORTACION HABITACIONES
        Route::get('/export-excel-rooms', [RoomController::class, 'exportCsv'])->name('export-excel-rooms');
        //Route::get('/export-pdf-rooms', [RoomPDFController::class, 'exportPDF'])->name('export-pdf-rooms');
        // Ruta para importar desde Excel
        Route::post('/import-excel-rooms', [RoomController::class, 'importExcel'])->name('import-excel-rooms');

        #EXPORTACION Y IMPORTACION TIPOS DE CLIENTES
        Route::get('/export-excel-clientTypes', [ClientTypeController::class, 'exportExcel'])->name('export-excel-clientTypes');
        Route::get('/export-pdf-clientTypes', [ClientTypePDFController::class, 'exportPDF'])->name('export-pdf-clientTypes');
        // Ruta para importar desde Excel
        Route::post('/import-excel-clientTypes', [ClientTypeController::class, 'importExcel'])->name('import-excel-clientTypes');

        #EXPORTACION Y IMPORTACION CLIENTES
        Route::get('/export-excel-customers', [CustomerController::class, 'exportCsv'])->name('export-excel-customers');
        Route::get('/export-pdf-customers', [CustomerPDFController::class, 'exportPDF'])->name('export-pdf-customers');
        // Ruta para importar desde Excel
        Route::post('/import-excel-customers', [CustomerController::class, 'importExcel'])->name('import-excel-customers');
    });
});
// En web.php
        Route::get('/landing-logout', function (Request $request) {
            // Cerrar sesión si el usuario está autenticado
            if (Auth::check()) {
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
            }
            
            // Redirigir al login
            return redirect('/login');
        })->name('landing.logout');
        
            //RUTAS PARA QUE PASEN EL TEST
        Route::get('/register', [RegisteredUserController::class, 'create'])
            ->middleware('guest')
            ->name('register');
        Route::get('/tipo_cliente', [ClientTypeController::class, 'index'])->name('Tipos_Clientes.index');
        Route::post('/register', [RegisteredUserController::class, 'store'])
            ->middleware('guest');
// Archivos de configuración adicionales
require __DIR__ . '/settings.php';
require __DIR__ . '/auth.php';
