<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RouteController;
use App\Http\Controllers\FormulController;
use App\Http\Controllers\AnnonceController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\AnnonceurController;
use App\Http\Controllers\UtilisateurController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::controller(RouteController::class)->group(function(){
    Route::get('/','welcome')->name('accueil');
    Route::get('/deposer','deposer')->name('deposer');
    Route::get('/articles','articles')->name('articles.list');
    Route::get('articles/article/{id?}','article')->name('article');
    Route::get('/contact', 'contact')->name('contact');
    Route::get('/about','about')->name('about');
    Route::get('/biens-immobilier/{id?}','biens')->name('biens');
    Route::get('/biens-immobilier/bien/{id?}','bien')->name('bien');
    Route::post('/search','search')->name('search');
    Route::post('/contactez','contactezNous')->name('contactezNous');
});



Route::controller(AuthController::class)->group(function(){
    Route::get("/s'inscrire",'show_register')->name('show_register');
    Route::get('/seconnecter','show_login')->name('show_login');
    Route::post('/register','register')->name('register');
    Route::post('/login','login')->name('login');
    Route::get('/verify/{id}','emailVerify')->name('verify');
    Route::get('/forgetpassword','forget')->name('forget');
    Route::post('/recovery','recovery')->name('recovery');
    Route::post('logout','logout')->name('logout');
});


Route::prefix('admin/')->group(function () {
    Route::get('dashboard', [HomeController::class,'dashboard'])->name('dashboard')->middleware(['auth','admin']);
    Route::delete('articles/deleteAll', [ArticleController::class, 'deleteAll'])->name('deleteAll');
    Route::get('articles/trash', [ArticleController::class, 'trash'])->name('trash');
    Route::post('articles/restore', [ArticleController::class, 'do_restore'])->name('restore');
    Route::delete('articles/force/{id}', [ArticleController::class, 'forceDelete'])->name('force');

    Route::post('utilisateurs/restore', [UtilisateurController::class, 'do_restore'])->name('utilisateurs.restore');
    Route::delete('utilisateurs/force/{id}', [UtilisateurController::class, 'forceDelete'])->name('utilisateurs.force');
    Route::delete('utilisateurs/deleteAll', [UtilisateurController::class, 'deleteAll'])->name('utilisateurs.deleteAll');
    Route::get('utilisateurs/trash', [UtilisateurController::class, 'trash'])->name('utilisateurs.trash');
    Route::post('utilisateurs/reseau/{id}', [UtilisateurController::class, 'reseau'])->name('utilisateurs.reseau');
    Route::post('utilisateurs/changermdp/{id}', [UtilisateurController::class, 'changerMDP'])->name('utilisateurs.changermdp');

    Route::post('annonces/restore', [AnnonceController::class, 'do_restore'])->name('annonces.restore');
    Route::delete('annonces/force/{id}', [AnnonceController::class, 'forceDelete'])->name('annonces.force');
    Route::get('annonces/premium', [AnnonceController::class, 'premium'])->name('annonces.premium');
    Route::get('annonces/trash', [AnnonceController::class, 'trash'])->name('annonces.trash');
    Route::delete('annonces/deleteAll', [AnnonceController::class, 'deleteAll'])->name('annonces.deleteAll');

    Route::resource('annonces', AnnonceController::class);
    Route::resource('articles', ArticleController::class);
    Route::resource('utilisateurs', UtilisateurController::class);
    
});






Route::prefix('annonceur/')->group(function(){
    Route::controller(FormulController::class)->group(function(){
        Route::get('dashboard','dashboard')->name('annonceur.dashboard');
        Route::get('messages','index')->name('message.messages');
        Route::get('editer/{id}','edit')->name('profile.edit');
        Route::post('update/{id}','update')->name('annon.update');
        Route::get('messages/trash','trash')->name('message.trash');
        Route::post('messages/restore','do_restore')->name('message.restore');
        Route::delete('messages/{id}','destroy')->name('message.delete');
        Route::delete('messages/deleteAll','deleteAll')->name('message.deleteAll');
        Route::delete('messages/force/{id}','forceDelete')->name('message.forceDelete');
        Route::post('annonceur/reseau/{id}', 'reseau')->name('annonceur.reseau');
        Route::post('annonceur/changermdp/{id}', 'changerMDP')->name('annonceur.changermdp');
    });
    Route::post('message/envoyer',[FormulController::class,'store'])->name('messages.envoyer');
    Route::post('annonceur/restore', [AnnonceurController::class, 'do_restore'])->name('annonceur.restore');
    Route::delete('annonceur/force/{id}', [AnnonceurController::class, 'forceDelete'])->name('annonceur.force');
    Route::get('annonceur/premium', [AnnonceurController::class, 'premium'])->name('annonceur.premium');
    Route::get('annonceur/trash', [AnnonceurController::class, 'trash'])->name('annonceur.trash');
    Route::delete('annonceur/deleteAll', [AnnonceurController::class, 'deleteAll'])->name('annonceur.deleteAll');
    Route::resource('annonceur',AnnonceurController::class)->middleware('auth');
});
Route::fallback(function () {
    return view('404');
});



