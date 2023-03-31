<?php

use App\Http\Controllers\SettingsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommonController;
use App\Http\Controllers\MembersController;
use App\Http\Controllers\SuggestedWorksController;
use App\Http\Controllers\FundRaisingController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\NoticeBoardController;
use App\Http\Controllers\FamilyMembersController;
use App\Http\Controllers\PaymentController\CashfreePaymentController;

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

/*
|---------------------------------------------------------------------------
| Auth Routes
|---------------------------------------------------------------------------
*/
Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('login/post', [AuthController::class, 'login_post'])->name('login.post');
Route::get('signup', [AuthController::class, 'signup'])->name('admin.signup');
Route::post('signup/post', [AuthController::class, 'signup_post'])->name('admin.signup.post');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');
/*
|---------------------------------------------------------------------------
| Payment Routes
|---------------------------------------------------------------------------
*/
Route::name('payment')->prefix('payment')->group(function () {
    // Cashfree Payment Route
    Route::name('.cashfree')->prefix('cashfree')->group(function () {
        Route::post('vindicate', [CashfreePaymentController::class, 'vindicate'])->name('.vindicate');
        Route::post('store/{amount}', [CashfreePaymentController::class, 'store'])->name('.store');
        Route::any('success', [CashfreePaymentController::class, 'success'])->name('.success');
        Route::any('success', [CashfreePaymentController::class, 'success'])->name('.success');
    });
});
/*
|---------------------------------------------------------------------------
| Common Routes
|---------------------------------------------------------------------------
*/
Route::get('/', [CommonController::class, 'index'])->name('index');
Route::post('message-us', [CommonController::class, 'message_us'])->name('message.us');
Route::middleware(['session.expired'])->group(function () {
    Route::get('dashboard', [CommonController::class, 'dashboard'])->name('dashboard');
    // Account Routes
    Route::name('account')->prefix('account')->group(
        function () {
            Route::get('/', [AccountController::class, 'index']);
            Route::post('set-maintenance', [AccountController::class, 'set_maintenance'])->name('.set.maintenance');
            Route::post('withdraw', [AccountController::class, 'withdraw'])->name('.withdraw');
            Route::get('history', [AccountController::class, 'history'])->name('.history');
        }
    );
    // Members Routes
    Route::name('members')->prefix('members')->middleware('auth.admin')->group(
        function () {
            Route::get('/', [MembersController::class, 'index']);
            Route::post('add', [MembersController::class, 'add'])->name('.add');
            Route::post('move', [MembersController::class, 'move'])->name('.move');
            Route::post('restore', [MembersController::class, 'restore'])->name('.restore');
            Route::get('profile/{id}', [MembersController::class, 'profile'])->name('.profile');
            Route::get('history', [MembersController::class, 'history'])->name('.history');
        }
    );
    // Suggested Works Routes
    Route::name('suggested.works')->prefix('suggested-works')->group(
        function () {
            Route::get('/', [SuggestedWorksController::class, 'index']);
            Route::post('add', [SuggestedWorksController::class, 'add'])->name('.add');
            Route::post('upvote', [SuggestedWorksController::class, 'upvote'])->name('.upvote');
            Route::post('comment', [SuggestedWorksController::class, 'comment'])->name('.comment');
            Route::get('history', [SuggestedWorksController::class, 'history'])->name('.history');
        }
    );
    // Fund Raising Routes
    Route::name('fund.raising')->prefix('fund-raising')->group(
        function () {
            Route::get('/', [FundRaisingController::class, 'index']);
            Route::post('add', [FundRaisingController::class, 'add'])->name('.add');
            Route::post('move', [FundRaisingController::class, 'move'])->name('.move');
            Route::post('comment', [FundRaisingController::class, 'comment'])->name('.comment');
            Route::get('history', [FundRaisingController::class, 'history'])->name('.history');
        }
    );
    // Notice Board Routes
    Route::name('notice.board')->prefix('notice-board')->group(
        function () {
            Route::get('/', [NoticeBoardController::class, 'index']);
            Route::post('add', [NoticeBoardController::class, 'add'])->name('.add');
            Route::post('move', [NoticeBoardController::class, 'move'])->name('.move');
            Route::get('history', [NoticeBoardController::class, 'history'])->name('.history');
        }
    );
    // Settings Route
    Route::name('settings')->prefix('settings')->group(
        function () {
            Route::get('my-profile', [SettingsController::class, 'my_profile'])->name('.my.profile');
            Route::get('society-profile', [SettingsController::class, 'society_profile'])->name('.society.profile');
            Route::get('credentials', [SettingsController::class, 'credentials'])->name('.credentials');
            Route::post('update-email', [SettingsController::class, 'update_email'])->name('.update.email');
            Route::post('update-password', [SettingsController::class, 'update_password'])->name('.update.password');
            Route::post('update-society', [SettingsController::class, 'update_society'])->name('.update.society');
        } 
    );
});