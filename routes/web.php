<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PrintController;
use App\Models\Kategori;
use App\Models\Payment;
use App\Models\Product;
use App\Models\User;

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

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    $total_kategori    = Kategori::count();
    $total_user        = User::count();
    $total_product     = Product::count();
    $total_payment     = Payment::count();

    return view('admin.index', compact('total_kategori', 'total_user', 'total_product',  'total_payment'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// resouce
Route::resource('Kategori','App\Http\Controllers\KategoriController')->middleware(['auth']);
Route::resource('Product','App\Http\Controllers\ProductController')->middleware(['auth']);
Route::resource('Payment','App\Http\Controllers\PaymentController')->middleware(['auth']);
Route::resource('Print','App\Http\Controllers\PrintController')->middleware(['auth']);

Route::get('/Product_master', function () {
    $allkategori = Kategori::all();
    $allproduk   = Product::simplePaginate(10);
    $allpayment  = Payment::simplePaginate(10);

    // return $episode;
    return view('product.index', compact('allkategori', 'allproduk', 'allpayment'));
})->name('Product_master');



Route::get('cetakPDF/{id}', [PrintController::class, "cetakPDF"])->name('cetakPDF');





// end resouce


require __DIR__.'/auth.php';
