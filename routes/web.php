<?php

use App\Http\Controllers\ParametrosController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ReportesController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ActividadsController;
use App\Http\Controllers\CentrotrabajosController;
use App\Http\Controllers\DisponibilidadsController;
use App\Http\Controllers\MaterialsController;
use App\Http\Controllers\OrdentrabajosController;
use App\Http\Controllers\PiezasController;
use App\Http\Controllers\ReprocesosController;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Inertia\Inertia;


// Route::get('/', function () {
//     return Inertia::render('Welcome', [
//         'canLogin' => Route::has('login'),
//         'canRegister' => Route::has('register'),
//         'laravelVersion' => Application::VERSION,
//         'phpVersion' => PHP_VERSION,
//     ]);
// });
Route::get('/', function () { return redirect('/login'); });


Route::get('/dashboard', function () {
    return Inertia::render('Dashboard', [
        'users'         => (int) User::count(),
        'roles'         => (int) Role::count(),
        'permissions'   => (int) Permission::count(),
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/setLang/{locale}', function ($locale) {
    Session::put('locale', $locale);
    return back();
})->name('setlang');

Route::middleware('auth', 'verified')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //# user
    Route::resource('/user', UserController::class)->except('create', 'show', 'edit');
    Route::post('/user/destroy-bulk', [UserController::class, 'destroyBulk'])->name('user.destroy-bulk');
    // Route::get('/subirexceles', [UserController::class, 'subirexceles'])->name('subirexceles');


    Route::resource('/role', RoleController::class)->except('create', 'show', 'edit');
    Route::post('/role/destroy-bulk', [RoleController::class, 'destroyBulk'])->name('role.destroy-bulk');
    
    Route::resource('/permission', PermissionController::class)->except('create', 'show', 'edit');
    Route::post('/permission/destroy-bulk', [PermissionController::class, 'destroyBulk'])->name('permission.destroy-bulk');

    
    Route::resource('/parametro', ParametrosController::class);
    
    //# SIDEBARMENU
    Route::resource('/reporte', ReportesController::class);
    Route::resource('/ordentrabajo', OrdentrabajosController::class);
    Route::resource('/actividad', ActividadsController::class);

    Route::resource('/centrotrabajo', CentrotrabajosController::class);
    Route::resource('/disponibilidad', DisponibilidadsController::class);
    Route::resource('/material', MaterialsController::class);
    Route::resource('/pieza', PiezasController::class);
    Route::resource('/reproceso', ReprocesosController::class);


});

require __DIR__ . '/auth.php';

// <editor-fold desc="Artisan">
Route::get('/exception', function () {
    throw new Exception('Probando excepciones y enrutamiento. La prueba ha concluido exitosamente.');
});

Route::get('/foo', function () {
    if (file_exists(public_path('storage'))) {
        return 'Ya existe';
    }
    App('files')->link(
        storage_path('App/public'),
        public_path('storage')
    );
    return 'Listo';
});

Route::get('/clear-c', function () {
    Artisan::call('optimize');
    Artisan::call('optimize:clear');
    return "Optimizacion finalizada";
    // throw new Exception('Optimizacion finalizada!');
});

Route::get('/tmantenimiento', function () {
    echo Artisan::call('down --secret="token-it"');
    return "Aplicación abajo: token-it";
});
Route::get('/Arriba', function () {
    echo Artisan::call('up');
    return "Aplicación funcionando";
});

//</editor-fold>
