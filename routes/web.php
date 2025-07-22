<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProduitController;

use App\Http\Controllers\UserController;
use App\Http\Controllers\PublicStandController;
use App\Http\Controllers\CartController;



Route::get('/', function () {
    return view('home');
});//->middleware('auth');

Route::get('/login', function () {
    return view('login'); // create this view
})->name('login');

Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);
Route::post('/logout', [UserController::class, 'logout']);

//génère un ensemble de routes pour les opérations CRUD sur une ressource donnée
Route::resource('produits', ProduitController::class);

Route::get('/stands', [PublicStandController::class, 'index'])->name('public.stands.index');
Route::get('/stands/{stand}/produits', [PublicStandController::class, 'productsByStand'])->name('public.stands.products');

// Routes pour le Panier
Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
Route::get('/cart', [CartController::class, 'viewCart'])->name('cart.view');
Route::post('/cart/remove', [CartController::class, 'removeFromCart'])->name('cart.remove');

//ROUTE POUR LE PROCESSUS DE COMMANDE
Route::get('/checkout', [CartController::class, 'showCheckoutForm'])->name('checkout.show'); // Pour afficher le formulaire de commande
Route::post('/checkout', [CartController::class, 'placeOrder'])->name('checkout.place'); // Pour soumettre la commande