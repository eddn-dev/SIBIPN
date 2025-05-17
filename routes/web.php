<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\ValidationController;
use App\Http\Controllers\SiteController;

// --- Controladores del Panel de Administración ---
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\LibraryController;
use App\Http\Controllers\Admin\CirculationPolicyController;
use App\Http\Controllers\Admin\LocationController;
use App\Http\Controllers\Admin\ParameterController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CatalogController;
use App\Http\Controllers\Admin\ItemController;
use App\Http\Controllers\Admin\AuthorityController;
use App\Http\Controllers\Admin\InventoryController;
use App\Http\Controllers\Admin\CirculationController;
use App\Http\Controllers\Admin\HoldController;
use App\Http\Controllers\Admin\InterlibraryLoanController;
use App\Http\Controllers\Admin\FineController;
use App\Http\Controllers\Admin\VendorController; // Controlador para Adquisiciones/Proveedores
use App\Http\Controllers\Admin\PurchaseOrderController;
use App\Http\Controllers\Admin\BudgetController;
use App\Http\Controllers\Admin\ReceivingController;
use App\Http\Controllers\Admin\DonationController;
use App\Http\Controllers\Admin\CmsContentController;
use App\Http\Controllers\Admin\CmsCategoryController;
use App\Http\Controllers\Admin\CmsEventController;
use App\Http\Controllers\Admin\CmsRegistrationController;
use App\Http\Controllers\Admin\CmsProgressController;
use App\Http\Controllers\Admin\CmsCertificateController;
use App\Http\Controllers\Admin\CmsQuizController;
use App\Http\Controllers\Admin\ForumCategoryController;
use App\Http\Controllers\Admin\ModerationController;
use App\Http\Controllers\Admin\CommunityGroupController;
use App\Http\Controllers\Admin\CommunityGroupMemberController;
use App\Http\Controllers\Admin\CommunityReportController;
use App\Http\Controllers\Admin\ReportController;
// Asegúrate de crear estos controladores o ajustar los namespaces si es necesario

/*
|--------------------------------------------------------------------------
| Rutas Web
|--------------------------------------------------------------------------
*/

// --- Rutas Públicas y de Usuario General ---

Route::get('/', function () {
    return view('welcome');
});

Route::get('/mi-sibipn', [SiteController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('sibipn');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::post('/auth/check-field', [ValidationController::class, 'checkField'])
     ->middleware('web')
     ->name('auth.checkField');


/*
|--------------------------------------------------------------------------
| Rutas del Panel de Administración (SIBIPN)
|--------------------------------------------------------------------------
| NOTA: Si encuentras errores "Route [...] not defined", intenta ejecutar:
|       php artisan route:clear
|       en tu terminal para limpiar la caché de rutas.
*/

// --- Grupo Principal de Rutas del Panel de Administración ---
Route::middleware(['auth', 'verified', 'can:acceder-panel-admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

    // --- Dashboard ---
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // --- Gestión General ---
    Route::resource('users', UserController::class)->middleware('can:gestionar-usuarios');
    Route::resource('roles', RoleController::class)->only(['index', 'edit', 'update'])->middleware('can:gestionar-roles');

    // --- Módulos Biblioteca ---

    // --- Gestión de Catálogo (GES-CAT) ---
    Route::resource('catalog', CatalogController::class)->middleware('can:gestionar-registros-bib');
    Route::get('catalog/import', [CatalogController::class, 'showImportForm'])->name('catalog.import.form')->middleware('can:importar-exportar-registros-bib');
    Route::post('catalog/import', [CatalogController::class, 'processImport'])->name('catalog.import.process')->middleware('can:importar-exportar-registros-bib');
    Route::get('catalog/export', [CatalogController::class, 'exportSelection'])->name('catalog.export')->middleware('can:importar-exportar-registros-bib');
    Route::resource('catalog.items', ItemController::class)
        ->shallow()
        ->except(['show'])
        ->middleware('can:gestionar-items');
    Route::resource('items', ItemController::class)
        ->except(['show'])
        ->middleware('can:gestionar-items');
    Route::resource('authorities', AuthorityController::class)->middleware('can:gestionar-autoridades');
    Route::get('inventory', [InventoryController::class, 'index'])->name('inventory.index')->middleware('can:participar-inventario');
    Route::post('inventory/scan', [InventoryController::class, 'scanItem'])->name('inventory.scan')->middleware('can:participar-inventario');

    // --- Gestión de Circulación (GES-CIR) ---
    Route::get('circulation', [CirculationController::class, 'index'])->name('circulation.index')->middleware('canany:realizar-prestamo,registrar-devolucion');
    Route::get('circulation/checkout', [CirculationController::class, 'showCheckoutForm'])->name('circulation.checkout.form')->middleware('can:realizar-prestamo');
    Route::post('circulation/checkout', [CirculationController::class, 'processCheckout'])->name('circulation.checkout.process')->middleware('can:realizar-prestamo');
    Route::get('circulation/checkin', [CirculationController::class, 'showCheckinForm'])->name('circulation.checkin.form')->middleware('can:registrar-devolucion');
    Route::post('circulation/checkin', [CirculationController::class, 'processCheckin'])->name('circulation.checkin.process')->middleware('can:registrar-devolucion');
    Route::post('circulation/renew/{loan}', [CirculationController::class, 'renewLoan'])->name('circulation.renew')->middleware('can:realizar-renovacion');
    Route::get('circulation/special-loan', [CirculationController::class, 'showSpecialLoanForm'])->name('circulation.special-loan.form')->middleware('can:registrar-prestamo-especial');
    Route::post('circulation/special-loan', [CirculationController::class, 'processSpecialLoan'])->name('circulation.special-loan.process')->middleware('can:registrar-prestamo-especial');
    Route::resource('holds', HoldController::class)->middleware('can:gestionar-reservas');
    Route::resource('interlibrary-loans', InterlibraryLoanController::class)->middleware('can:gestionar-prestamo-interbib');

    // --- Gestión de Multas y Tarifas (GES-FIN) ---
    Route::get('fines', [FineController::class, 'index'])->name('fines.index')->middleware('can:ver-multas-usuario');
    Route::get('fines/user/{user}', [FineController::class, 'showUserFines'])->name('fines.user')->middleware('can:ver-multas-usuario');
    Route::post('fines/user/{user}/pay', [FineController::class, 'registerPayment'])->name('fines.pay')->middleware('can:registrar-pago-multa');
    Route::post('fines/{fine}/waive', [FineController::class, 'waiveFine'])->name('fines.waive')->middleware('can:condonar-multa');
    Route::post('fines/user/{user}/manual', [FineController::class, 'addManualFine'])->name('fines.manual.add')->middleware('can:registrar-multa-manual');

    // --- Gestión de Adquisiciones (GES-ADQ) ---
    // *** VERIFICAR ESTA LÍNEA ***
    Route::resource('acquisitions/vendors', VendorController::class)->middleware('can:gestionar-proveedores'); 
    Route::resource('acquisitions/orders', PurchaseOrderController::class)->middleware('can:gestionar-ordenes-compra');
    Route::resource('acquisitions/budgets', BudgetController::class)->middleware('can:gestionar-presupuestos');
    Route::get('acquisitions/receiving', [ReceivingController::class, 'index'])->name('acquisitions.receiving.index')->middleware('can:registrar-recepcion-adq');
    Route::post('acquisitions/receiving', [ReceivingController::class, 'processReceiving'])->name('acquisitions.receiving.process')->middleware('can:registrar-recepcion-adq');

    // --- Gestión de Donaciones (GES-DON) ---
    Route::resource('donations', DonationController::class)->middleware('can:gestionar-donaciones');

    // --- Plataforma ---

    // --- Módulo Formación CMS (FOR-GCO) ---
    Route::prefix('cms')->name('cms.')->group(function () {
        Route::resource('contents', CmsContentController::class)->middleware('can:gestionar-contenido-formativo');
        Route::resource('categories', CmsCategoryController::class)->middleware('can:gestionar-categorias-formativas');
        Route::resource('events', CmsEventController::class)->middleware('can:gestionar-eventos-formativos');
        Route::get('events/{event}/registrations', [CmsRegistrationController::class, 'index'])->name('events.registrations.index')->middleware('can:gestionar-inscripciones-formacion');
        Route::get('courses/{course}/progress', [CmsProgressController::class, 'show'])->name('courses.progress.show')->middleware('can:ver-progreso-formacion');
        Route::post('courses/{completion}/certificate', [CmsCertificateController::class, 'issue'])->name('courses.certificate.issue')->middleware('can:emitir-certificados-formacion');
        Route::resource('quizzes', CmsQuizController::class)->middleware('can:gestionar-evaluaciones-formacion');
    });

    // --- Módulo Comunidad (COM-GFG) ---
    Route::prefix('community')->name('community.')->group(function () {
        Route::resource('forums', ForumCategoryController::class)->except(['show'])->middleware('can:gestionar-foros');
        Route::get('moderation/queue', [ModerationController::class, 'queue'])->name('moderation.queue')->middleware('can:moderar-posts-comunidad');
        Route::put('posts/{post}/approve', [ModerationController::class, 'approve'])->name('posts.approve')->middleware('can:moderar-posts-comunidad');
        Route::delete('posts/{post}', [ModerationController::class, 'delete'])->name('posts.delete')->middleware('can:moderar-posts-comunidad');
        Route::resource('groups', CommunityGroupController::class)->middleware('can:gestionar-grupos-comunidad');
        Route::post('groups/{group}/members', [CommunityGroupMemberController::class, 'store'])->name('groups.members.store')->middleware('can:gestionar-miembros-grupo-comunidad');
        Route::delete('groups/{group}/members/{user}', [CommunityGroupMemberController::class, 'destroy'])->name('groups.members.destroy')->middleware('can:gestionar-miembros-grupo-comunidad');
        Route::get('reports', [CommunityReportController::class, 'index'])->name('reports.index')->middleware('can:atender-reportes-comunidad');
    });

    // --- Reportes (GES-REP) ---
    Route::get('reports', [ReportController::class, 'index'])->name('reports.index')->middleware('can:ver-reportes');
    Route::get('reports/generate/{type}', [ReportController::class, 'generate'])->name('reports.generate')->middleware('can:ver-reportes');

    // --- Configuración del Sistema (GES-CFG) ---
    Route::prefix('settings')->name('settings.')->group(function () {
        Route::get('/', [SettingController::class, 'index'])->name('index')->middleware('can:gestionar-configuracion-general');
        Route::get('/edit', [SettingController::class, 'edit'])->name('edit')->middleware('can:gestionar-configuracion-general');
        Route::put('/', [SettingController::class, 'update'])->name('update')->middleware('can:gestionar-configuracion-general');
        Route::resource('libraries', LibraryController::class)->middleware('can:gestionar-bibliotecas');
        Route::resource('circulation-policies', CirculationPolicyController::class)->middleware('can:gestionar-politicas-circulacion');
        Route::resource('locations', LocationController::class)->middleware('can:gestionar-ubicaciones');
        Route::get('parameters', [ParameterController::class, 'edit'])->name('parameters.edit')->middleware('can:gestionar-parametros');
        Route::put('parameters', [ParameterController::class, 'update'])->name('parameters.update')->middleware('can:gestionar-parametros');
    });

}); // Fin del grupo de rutas admin

// --- Fin Rutas del Panel de Administración ---
//dd(Route::getRoutes()->getRoutesByName()); // Para depurar y ver las rutas cargadas
// Rutas de autenticación
require __DIR__.'/auth.php'; // Asegúrate que este archivo exista
