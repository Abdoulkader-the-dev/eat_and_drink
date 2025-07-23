<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProduitController;

use App\Http\Controllers\UserController;
use App\Http\Controllers\PublicStandController;
use App\Http\Controllers\CartController;
use App\Models\Utilisateur;
use Illuminate\Support\Facades\Mail;
use App\Mail\DemandeApprouvee;


Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::get('/register', function () {
    return view('inscr');
})->name('register');



//Retournez vers le home page
Route::get('/stand', function () {
    return redirect('/');
});

Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);
Route::post('/logout', [UserController::class, 'logout']);
Route::post('/stand', [UserController::class, 'stand']);

//génère un ensemble de routes pour les opérations CRUD sur une ressource donnée
Route::resource('produits', ProduitController::class);

Route::get('/stands', [PublicStandController::class, 'index'])->name('public.stands.index');
Route::get('/stands/{stand}/produits', [PublicStandController::class, 'productsByStand'])->name('public.stands.products');
//formulaire de stand
Route::get('/addStand', function () {
    return view('public.stands.addStand');
})->name('addStand');

Route::post('/addStand', [PublicStandController::class, 'store'])->name('addStand.store'); // Ajout du stand

// Routes pour le Panier
Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
Route::get('/cart', [CartController::class, 'viewCart'])->name('cart.view');
Route::post('/cart/remove', [CartController::class, 'removeFromCart'])->name('cart.remove');

//ROUTE POUR LE PROCESSUS DE COMMANDE
Route::get('/checkout', [CartController::class, 'showCheckoutForm'])->name('checkout.show'); // Pour afficher le formulaire de commande
Route::post('/checkout', [CartController::class, 'placeOrder'])->name('checkout.place'); // Pour soumettre la commande

//Admin
//Aller vers les pages de boards
Route::get('/stand', [AdminController::class, 'liste_stand'])->name('stand');
Route::get('/dashboard', [AdminController::class, 'liste_demande_stand'])->name('dashboard');
Route::post('/approuved', [AdminController::class, 'approuved'])->name('approuved');
Route::post('/reject', [AdminController::class, 'reject'])->name('reject');


