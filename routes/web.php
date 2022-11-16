<?php

use Illuminate\Support\Facades\Route;
// use App\Http\controllers\UsersController;
// use App\Http\controllers\ProfileController;
// use App\Http\controllers\CongesController;
// use App\Http\controllers\AnnoncesController;
// use App\Http\controllers\RepertoirePublicController;
// use App\Http\controllers\RepertoireEmployesController;
// use App\Http\controllers\SuggestionsController;
// use App\Http\controllers\AbsencesController;
// use App\Http\controllers\AvertissementsController;
// use App\Http\controllers\DepensesController;
// use App\Http\controllers\PresencesController;
// use App\Http\controllers\ActivitesController;
// use App\Http\controllers\OffreEmploisController;
// use App\Http\controllers\ApplicationsController;
// use App\Http\controllers\RoleController;
// use App\Http\controllers\PermissionController;
// use App\Http\controllers\HomeController;
// use App\Http\controllers\StockagesController;
// use App\Http\controllers\DivisionsController;
// use App\Http\controllers\DepartementsController;
// use App\Http\controllers\ServicesController;
// use App\Http\controllers\PaysController;
// use App\Http\controllers\RapportsController;
// use App\Http\controllers\NotificationsController;
// use App\Http\controllers\ContratsController;
// use App\Http\controllers\ReunionsController;



use App\Models\OffreEmplois;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

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



Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('config:clear');
    $exitCode = Artisan::call('config:cache');
    
    // dd('Done');
    $exitCode = Artisan::call('view:clear');
    
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('config:clear');
    
    
    // $exitCode = Artisan::call('debugbar:clear');
    return 'DONE'; //Return anything
});


Route::get('/', function () {
    return view('auth.login');
});

// Dont forget to group all routes under auth for the auth middleware

// Route::get('/confirm-password', function () {
//     return view('auth.confirm-password');
// })->middleware('auth')->name('password.confirm');

Route::post('/confirm-password', function (Request $request) {
    if (! Hash::check($request->password, $request->user()->password)) {
        return back()->withErrors([
            'password' => ['Le mot de passe fourni ne correspond pas à nos enregistrements.']
        ]);
    }
    $request->session()->passwordConfirmed();
 
    return redirect()->intended();
})->middleware(['auth', 'throttle:6,1']);


Auth::routes();

// Route::get('/home', [HomeController::class, 'index'])->name('home')->middleware("auth");
Route::get('/home', 'HomeController@index')->name('home')->middleware("auth");

// Route::resource('profile', ProfileController::class)->middleware("auth");
Route::resource('profile', 'ProfileController')->middleware("auth");

// Route::resource('pays', PaysController::class);
Route::resource('pays', 'PaysController');

// Route::resource('users', UsersController::class)->middleware("auth");
Route::resource('users', 'UsersController')->middleware("auth");

// Route::post('/reset_password', 'UsersController@resetPassword')->name("reset_password")->middleware("auth");
Route::post('/reset_password', 'UsersController@resetPassword')->name("reset_password")->middleware("auth");

// Route::post('/users/{user}/roles', [UsersController::class, 'assignRole'])->name("users.roles")->middleware("auth");
Route::post('/users/{user}/roles', 'UsersController@assignRole')->name("users.roles")->middleware("auth");

// Route::delete('/users/{user}/roles/{role}', [UsersController::class, 'removeRole'])->name("users.roles.remove")->middleware("auth");
Route::delete('/users/{user}/roles/{role}', 'UsersController@removeRole')->name("users.roles.remove")->middleware("auth");

// Route::post('/users/{user}/permissions', [UsersController::class, 'givePermission'])->name("users.permissions")->middleware("auth");
Route::post('/users/{user}/permissions', 'UsersController@givePermission')->name("users.permissions")->middleware("auth");

// Route::delete('/users/{user}/permissions/{permission}', [UsersController::class, 'revokePermission'])->name("users.permissions.remove")->middleware("auth");
Route::delete('/users/{user}/permissions/{permission}', 'UsersController@revokePermission')->name("users.permissions.remove")->middleware("auth");

// Route::post('/activer_desactiver_utilisateur', [UsersController::class, 'activer_desactiver_utilisateur'])->name("activer_desactiver_utilisateur")->middleware("auth");
Route::post('/activer_desactiver_utilisateur', 'UsersController@activer_desactiver_utilisateur')->name("activer_desactiver_utilisateur")->middleware("auth");

// Route::resource('divisions', DivisionsController::class)->middleware("auth");
Route::resource('divisions', 'DivisionsController')->middleware("auth");

// Route::resource('departements', DepartementsController::class)->middleware("auth");
Route::resource('departements', 'DepartementsController')->middleware("auth");

// Route::resource('services', ServicesController::class)->middleware("auth");
Route::resource('services', 'ServicesController')->middleware("auth");


// Route::get("service_responsable", [ServicesController::class, 'service_responsable'])->name("service_responsable")->middleware("auth");
Route::get("service_responsable", 'ServicesController@service_responsable')->name("service_responsable")->middleware("auth");

// Route::get('/supprimer_photo/{id}', [ProfileController::class, 'supprimer_photo'])->name("supprimer_photo")->middleware("auth");
Route::get('/supprimer_photo/{id}', 'ProfileController@supprimer_photo')->name("supprimer_photo")->middleware("auth");


// Route::post('/changer_mdp', [ProfileController::class, 'changer_mdp'])->name("changer_mdp")->middleware("auth");
Route::post('/changer_mdp', 'ProfileController@changer_mdp')->name("changer_mdp")->middleware("auth");


// Route::resource('conges', CongesController::class)->middleware("auth");
Route::resource('conges', 'CongesController')->middleware("auth");

// Route::post('/changer_conge_status', [CongesController::class, 'changer_conge_status'])->name("changer_conge_status")->middleware
// ("auth");
Route::post('/changer_conge_status', 'CongesController@changer_conge_status')->name("changer_conge_status")->middleware
("auth");

// Route::resource('annonces', AnnoncesController::class)->middleware("auth");
Route::resource('annonces', 'AnnoncesController')->middleware("auth");

// Route::get('/telecharger_fichier_annonce/{fichier}', [AnnoncesController::class, 'telecharger_fichier_annonce'])->name("telecharger_fichier_annonce")->middleware("auth");
Route::get('/telecharger_fichier_annonce/{fichier}', 'AnnoncesController@telecharger_fichier_annonce')->name("telecharger_fichier_annonce")->middleware("auth");


// Route::resource('reunions', ReunionsController::class)->middleware("auth");
Route::resource('reunions', 'ReunionsController')->middleware("auth");

Route::post("attach_reunion_user", 'ReunionsController@attach_reunion_user')->name("attach_reunion_user")->middleware("auth");

Route::get("detach_reunion_user/{user_id}/{reunion_id}", 'ReunionsController@detach_reunion_user')->name("detach_reunion_user")->middleware("auth");

// Route::get('/telecharger_fichier_reunion/{fichier}', [ReunionsController::class, 'telecharger_fichier_reunion'])->name("telecharger_fichier_reunion")->middleware("auth");
Route::get('/telecharger_fichier_reunion/{fichier}', 'ReunionsController@telecharger_fichier_reunion')->name("telecharger_fichier_reunion")->middleware("auth");


// Route::resource('repertoire_public', RepertoirePublicController::class)->middleware("auth");
Route::resource('repertoire_public', 'RepertoirePublicController')->middleware("auth");

// Route::resource('repertoire_employes', RepertoireEmployesController::class)->middleware("auth");
Route::resource('repertoire_employes', 'RepertoireEmployesController')->middleware("auth");

// Route::get('/telecharger_fichier_public/{fichier}', [RepertoirePublicController::class, 'telecharger_fichier_public'])->name("telecharger_fichier_public")->middleware("auth");
Route::get('/telecharger_fichier_public/{fichier}', 'RepertoirePublicController@telecharger_fichier_public')->name("telecharger_fichier_public")->middleware("auth");

// Route::resource('suggestions', SuggestionsController::class)->middleware("auth");
Route::resource('suggestions', 'SuggestionsController')->middleware("auth");

// Route::resource('absences', AbsencesController::class)->middleware("auth");
Route::resource('absences', 'AbsencesController')->middleware("auth");

// Route::post('/changer_absence_status', [AbsencesController::class, 'changer_absence_status'])->name("changer_absence_status")->middleware("auth");
Route::post('/changer_absence_status', 'AbsencesController@changer_absence_status')->name("changer_absence_status")->middleware("auth");

// Route::resource('avertissements', AvertissementsController::class)->middleware("auth");
Route::resource('avertissements', 'AvertissementsController')->middleware("auth");

// Route::resource('depenses', DepensesController::class)->middleware("auth");
Route::resource('depenses', 'DepensesController')->middleware("auth");

// Route::get('/telecharger_fichier_depense/{fichier}', [DepensesController::class, 'telecharger_fichier_depense'])->name("telecharger_fichier_depense")->middleware("auth");
Route::get('/telecharger_fichier_depense/{fichier}', 'DepensesController@telecharger_fichier_depense')->name("telecharger_fichier_depense")->middleware("auth");

// Route::resource('présences', PresencesController::class)->middleware("auth");
Route::resource('présences', 'PresencesController')->middleware("auth");

// Route::post('/presences_import', [PresencesController::class, 'import'])->name("presences_import")->middleware("auth");
Route::post('/presences_import', 'PresencesController@import')->name("presences_import")->middleware("auth");

// Route::resource('activités', ActivitesController::class)->middleware("auth");
Route::resource('activités', 'ActivitesController')->middleware("auth");

// Route::get('activité_à_faire/{id}', [ActivitesController::class, 'activité_a_faire'])->name('activité_à_faire')->middleware("auth");
Route::get('activité_à_faire/{id}', 'ActivitesController::class@activité_a_faire')->name('activité_à_faire')->middleware("auth");

// Route::get('activité_en_progres/{id}', [ActivitesController::class, 'activité_en_progres'])->name('activité_en_progrès')->middleware("auth");
Route::get('activité_en_progres/{id}', 'ActivitesController::class@activité_en_progres')->name('activité_en_progrès')->middleware("auth");

// Route::get('activité_fini/{id}', [ActivitesController::class, 'activité_fini'])->name('activité_fini')->middleware("auth");
Route::get('activité_fini/{id}', 'ActivitesController@activité_fini')->name('activité_fini')->middleware("auth");

// Route::get('delete/{id}', [ActivitesController::class, 'delete'])->name('delete')->middleware("auth");
Route::get('delete/{id}', 'ActivitesController@delete')->name('delete')->middleware("auth");

// Route::resource('offres_emplois', OffreEmploisController::class)->middleware("auth");
Route::resource('offres_emplois', 'OffreEmploisController')->middleware("auth");

Route::get('/offres_public', function () {
    $offres = OffreEmplois::all();
    return view("offres_public.index")->with("offres", $offres);
})->name("offres_public");

// Route::resource('applications', ApplicationsController::class);
Route::resource('applications', 'ApplicationsController');

// Route::get('/application/{id}', [ApplicationsController::class, 'application'])->name("application");
Route::get('/application/{id}', 'ApplicationsController@application')->name("application");

// Route::get("/offre_applications/{id}", [ApplicationsController::class, "offre_applications"])->name("offre_applications");
Route::get("/offre_applications/{id}", 'ApplicationsController@offre_applications')->name("offre_applications");

// Route::resource('roles', RoleController::class);
Route::resource('roles', 'RoleController');

// Route::resource('permissions', PermissionController::class);
Route::resource('permissions', 'PermissionController');

// Route::post('/roles/{role}/permissions', [RoleController::class, 'givePermission'])->name("role.permissions");
Route::post('/roles/{role}/permissions', 'RoleController@givePermission')->name("role.permissions");

// Route::delete('/roles/{role}/permissions/{permission}', [RoleController::class, 'revokePermission'])->name("role.permissions.revoke");
Route::delete('/roles/{role}/permissions/{permission}', 'RoleController@revokePermission')->name("role.permissions.revoke");

// Route::post('/permissions/{permission}/roles', [PermissionController::class, 'assignRole'])->name("permission.roles");
Route::post('/permissions/{permission}/roles', 'PermissionController@assignRole')->name("permission.roles");

// Route::delete('/permissions/{permission}/roles/{role}', [PermissionController::class, 'removeRole'])->name("permission.roles.remove");
Route::delete('/permissions/{permission}/roles/{role}', 'PermissionController@removeRole')->name("permission.roles.remove");

// Route::resource('rapports', RapportsController::class)->middleware(["auth"]);
Route::resource('rapports', 'RapportsController')->middleware(["auth"]);

Route::get('generateRepportPdf/{id}', [RapportsController::class, 'generateRepportPdf'])->name("generateRepportPdf")->middleware("auth");
Route::get('generateRepportPdf/{id}', 'RapportsController@generateRepportPdf')->name("generateRepportPdf")->middleware("auth");

// Route::get('/telecharger_fichier_rapport/{fichier}', [RapportsController::class, 'telecharger_fichier_rapport'])->name("telecharger_fichier_rapport")->middleware("auth");
Route::get('/telecharger_fichier_rapport/{fichier}', 'RapportsController@telecharger_fichier_rapport')->name("telecharger_fichier_rapport")->middleware("auth");

// Route::resource('stockage', StockagesController::class)->middleware(["auth"]);
Route::resource('stockage', 'StockagesController')->middleware(["auth"]);

// Route::resource('stockage', StockagesController::class)->middleware(["auth"]);
Route::resource('fiches_de_paie', 'FichesDePaieController')->middleware(["auth"]);
Route::get('/telecharger_fichier_paie/{fichier}', 'FichesDePaieController@telecharger_fichier_paie')->name("telecharger_fichier_paie")->middleware("auth");
Route::get('/employee_confirmation/{fiche_id}', 'FichesDePaieController@employee_confirmation')->name("employee_confirmation")->middleware("auth");

Route::resource('accounts', 'AccountsController')->middleware(["auth"]);
Route::resource('transactions', 'TransactionsController')->middleware(["auth"]);

// Route::resource('contrats', ContratsController::class)->middleware(["auth"]);
Route::resource('contrats', 'ContratsController')->middleware(["auth"]);

// Route::get('generate_contrat/{id}', [ContratsController::class, 'generate_contrat'])->middleware(["auth"])->name("generate_contrat");
Route::get('generate_contrat/{id}', 'ContratsController@generate_contrat')->middleware(["auth"])->name("generate_contrat");

// Route::get('generate_stage/{id}', [ContratsController::class, 'generate_stage'])->middleware(["auth"])->name("generate_stage");
Route::get('generate_stage/{id}', 'ContratsController@generate_stage')->middleware(["auth"])->name("generate_stage");


Route::get('/telecharger_fichier_stockage/{fichier}', 'StockagesController@telecharger_fichier_stockage')->name("telecharger_fichier_stockage")->middleware("auth");

// Route::get('/mark_all_as_read', [NotificationsController::class, 'markAllAsRead'])->name("mark_all_as_read")->middleware("auth");
Route::get('/mark_all_as_read', 'NotificationsController@markAllAsRead')->name("mark_all_as_read")->middleware("auth");

// Route::get('/mark_notification_as_read/{id}', [NotificationsController::class, 'markNotificationAsRead'])->name("mark_notification_as_read")->middleware("auth");
Route::get('/mark_notification_as_read/{id}', 'NotificationsController@markNotificationAsRead')->name("mark_notification_as_read")->middleware("auth");
