<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\HeroController;
use App\Http\Controllers\WebPageController;
use App\Http\Controllers\admin\ClientController;
use App\Http\Controllers\admin\AboutController;
use App\Http\Controllers\admin\WhyController;
use App\Http\Controllers\admin\WhyUsAccordionController;
use App\Http\Controllers\admin\SkillController;
use App\Http\Controllers\admin\SkillProgressController;
use App\Http\Controllers\admin\ServiceController;
use App\Http\Controllers\admin\ServiceBoxController;
use App\Http\Controllers\admin\IconController;
use App\Http\Controllers\admin\CTAController;
use App\Http\Controllers\admin\PortfolioController;
use App\Http\Controllers\admin\PortfolioDetailController;
use App\Http\Controllers\admin\TeamController;
use App\Http\Controllers\admin\TeamDetailController;
use App\Http\Controllers\admin\PricingController;
use App\Http\Controllers\admin\PricingDetailController;
use App\Http\Controllers\admin\FAQController;
use App\Http\Controllers\admin\FaqAccordionController;
use App\Http\Controllers\admin\ContactController;

use App\Http\Controllers\HomeController;

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


Route::group(['prefix'=>'admin'], function(){
    Auth::routes();
    Route::match(['get', 'post'], 'register', function(){
        return redirect('/admin/login');
    });
});

Route::group(['prefix'=>'admin', 'middleware' => 'auth'], function(){
    Route::get('/', [DashboardController::class, 'index'])->name('admin');
    Route::resource('/hero', HeroController::class);
    Route::resource('/client', ClientController::class);
    Route::resource('/about', AboutController::class);
    Route::resource('/why', WhyController::class);
    Route::resource('/whyusaccordion', WhyUsAccordionController::class);
    Route::resource('/skill', SkillController::class);
    Route::resource('/skillprogress', SkillProgressController::class);
    Route::resource('/service', ServiceController::class);
    Route::resource('/servicebox', ServiceBoxController::class);
    Route::resource('/cta', CTAController::class);
    Route::resource('/portfolio', PortfolioController::class);
    Route::resource('/portfoliodetail', PortfolioDetailController::class);
    Route::resource('/team', TeamController::class);
    Route::resource('/teamdetail', TeamDetailController::class);
    Route::resource('/pricing', PricingController::class);
    Route::resource('/pricingdetail', PricingDetailController::class);
    Route::resource('/faq', FAQController::class);
    Route::resource('/faqaccordion', FaqAccordionController::class);
    Route::resource('/contact', ContactController::class);
    Route::get('/icon', [IconController::class, 'index'])->name('icon');
});


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('/', [HomeController::class, 'index']);
