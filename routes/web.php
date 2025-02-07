<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\NotesController;
use App\Http\Controllers\PlanRequestsController;
use App\Http\Controllers\PlatformLinkController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\TodoListController;
use Illuminate\Support\Facades\Route;

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

Route::get('/dashboard', function () {
    return view('welcome');
})->name('dashboard');

Route::get('/profile', [LoginController::class, 'edit'])->name('profile.edit');
Route::post('/profile', [LoginController::class, 'update'])->name('profile.update');
Route::post('/profile/reset-password', [LoginController::class, 'resetPassword'])->name('profile.reset.password');

Route::get('/', [HomeController::class, 'home'])->name('home');
Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');

Route::middleware('guest')->group(function () {
    Route::get('login', [LoginController::class, 'index'])->name('login');
    Route::get('sign-up', [LoginController::class, 'register'])->name('register');
    Route::post('sign-up', [LoginController::class, 'registerUser'])->name('registerUser');
    Route::get('password/email', [LoginController::class, 'reset_password_email'])->name('forget.password');
    Route::post('reset-password-link', [LoginController::class, 'resetPasswordLink'])->name('reset_password.link');
    Route::get('reset-password/{token}', [LoginController::class, 'resetPasswordView'])->name('reset.password');
    Route::post('change-password/{id}', [LoginController::class, 'changePassword'])->name('change.password');
});

Route::post('login', [LoginController::class, 'authenticate'])->name('loginPost');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

// pages by Arbaz
Route::prefix('/user')->as('user.')->middleware('auth')->group(function () {
    Route::get('/dashboard', [HomeController::class, 'dashboardUser'])->name('dashboard');
    Route::get('/brands', [HomeController::class, 'brands'])->name('brands');
    Route::get('/todo', [TodoListController::class, 'index'])->name('todo.list');
    Route::post('/todos', [TodoListController::class, 'store'])->name('todos.store');
    Route::patch('/todos/{todo}', [TodoListController::class, 'update'])->name('todos.update');
    Route::delete('/todos/{todo}', [TodoListController::class, 'destroy'])->name('todos.destroy');;
    Route::get('support', [FaqController::class, 'list'])->name('support');
    Route::get('/support/category', [FaqController::class, 'category'])->name('support.category');
    Route::get('/support/category/question/{id}', [FaqController::class, 'category_question'])->name('category.question');
    Route::get('/notes', [NotesController::class, 'index'])->name('notes.list');
    Route::post('/notes', [NotesController::class, 'store'])->name('notes.store');
    Route::get('/notes/{note_id}', [NotesController::class, 'show'])->name('notes.show');
    Route::patch('/notes/{note_id}', [NotesController::class, 'update'])->name('notes.update');
    Route::get('/invoices', [HomeController::class, 'invoices'])->name('invoices');
    Route::get('/invoice/create', [HomeController::class, 'invoice_create'])->name('invoice.create');
    Route::get('/invoice/list', [InvoiceController::class, 'index'])->name('invoice.list');
    Route::post('/invoice/store', [InvoiceController::class, 'store'])->name('invoice.store');
    Route::post('/invoice/edit', [InvoiceController::class, 'edit'])->name('invoice.edit');
    Route::get('/managers', [ManagerController::class, 'index'])->name('manager.index');
    Route::get('/managers/create', [ManagerController::class, 'create'])->name('manager.create');
    Route::post('/managers', [ManagerController::class, 'store'])->name('manager.store');
    Route::get('/platform-links', [PlatformLinkController::class, 'index'])->name('platformlink.list');
    Route::post('/platforms', [PlatformLinkController::class, 'store'])->name('store.platform');
    Route::post('/user/update/platform', [PlatformLinkController::class, 'update'])->name('update.platform');
    Route::get('/video-editor', [HomeController::class, 'videoEditor'])->name('video.editor');
    Route::get('/short/generator', [HomeController::class, 'shortGenerator'])->name('short.generator');
    Route::get('/settings', [HomeController::class, 'settings'])->name('settings');
    Route::get('/subscription', [HomeController::class, 'subscription'])->name('subscription');
    Route::get('/support/ticket', [HomeController::class, 'ticket'])->name('ticket');
    Route::post('/support/ticket/create', [TicketController::class, 'insert'])->name('ticket.create');
    Route::get('/support/ticket/list', [TicketController::class, 'list'])->name('ticket.list');
    Route::delete('/support/delete/{id}', [TicketController::class, 'delete'])->name('ticket.delete');
    Route::get('/support/edit/{id}', [TicketController::class, 'edit'])->name('ticket.edit');
    Route::post('/support/update/{id}', [TicketController::class, 'update'])->name('ticket.update');
    //subscription of plan
    Route::get('/subscription/{plan}', [PlanRequestsController::class, 'planSubscribe'])->name('subscription.plan');
    Route::post('/subscription/complete', [SubscriptionController::class, 'subscribe'])->name('subscription.complete');
    // Route to show the content scheduler
    Route::get('/content-scheduler', [ContentController::class, 'showContentScheduler'])->name('content.scheduler');
    Route::get('/content-scheduler/create', [ContentController::class, 'create'])->name('content.create');
    Route::post('/content-scheduler/store', [ContentController::class, 'store'])->name('content.store');
    Route::get('/content-scheduler/edit/{id}', [ContentController::class, 'edit'])->name('content.edit');
    Route::put('/content-scheduler/update/{id}', [ContentController::class, 'update'])->name('content.update');
    Route::delete('/content-scheduler/destroy/{id}', [ContentController::class, 'destroy'])->name('content.destroy');
    Route::get('/content-events', [HomeController::class, 'contentEvents'])->name('scheduledEvents.show');
    Route::get('/reminders', [HomeController::class, 'showReminders'])->name('reminders');
    Route::get('/calendar', [HomeController::class, 'showCalendar'])->name('calendar');
    Route::get('/backup-calendar', [HomeController::class, 'backupCalendar'])->name('backup-calendar');
});

Route::prefix('/admin')->as('admin.')->middleware('auth')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('creators/active', [AdminController::class, 'creatorsActive'])->name('creators.active');
    Route::get('creators/inactive', [AdminController::class, 'creatorsInActive'])->name('creators.inactive');
    Route::post('creators/disable/{id}', [AdminController::class, 'disableCreator'])->name('creators.disable');
    Route::post('creators/enable/{id}', [AdminController::class, 'enableCreator'])->name('creators.enable');
    Route::post('creators/delete/{id}', [AdminController::class, 'deleteCreator'])->name('creators.delete');
    Route::get('creators/view/{id}', [AdminController::class, 'viewCreator'])->name('creators.view');

    Route::get('/subscription', [PlanRequestsController::class, 'manage'])->name('subscription.manage');
    Route::put('/subscription/{plan}', [PlanRequestsController::class, 'update'])->name('subscription.update');

    Route::get('transactions', [PlanRequestsController::class, 'adminindex'])->name('transactions.index');
    Route::get('transactions/{id}/edit', [PlanRequestsController::class, 'adminedit'])->name('transactions.edit');
    Route::put('transactions/{id}', [PlanRequestsController::class, 'adminupdate'])->name('transactions.update');
    Route::get('transactions/{id}', [PlanRequestsController::class, 'adminshow'])->name('transactions.show');
    Route::delete('transactions/{id}', [PlanRequestsController::class, 'admindestroy'])->name('transactions.destroy');

    Route::get('tickets', [AdminController::class, 'tickets'])->name('tickets.list');
    Route::get('tickets/{ticketId}', [AdminController::class, 'ticketsRespond'])->name('tickets.respond');
    Route::post('tickets/respond/{ticketId}', [AdminController::class, 'saveResponse'])->name('tickets.saveResponse');

    Route::get('categories', [AdminController::class, 'categories'])->name('categories');
    Route::post('categories', [CategoryController::class, 'storeCategory'])->name('categories.store');

    // faq done
    Route::get('faqs', [FaqController::class, 'index'])->name('faqs.index');
    Route::get('faqs/create/{id?}', [FaqController::class, 'create'])->name('faqs.create');
    Route::post('faqs/store', [FaqController::class, 'store'])->name('faqs.store');
    Route::get('faqs/edit/{faq}', [FaqController::class, 'edit'])->name('faqs.edit');
    Route::put('faqs/update/{faq}', [FaqController::class, 'update'])->name('faqs.update');
    Route::delete('faqs/destroy/{faq}', [FaqController::class, 'destroy'])->name('faqs.destroy');
});


use App\Http\Controllers\AuthController;
Route::get('auth/google', [AuthController::class, 'redirectToGoogle'])->name('auth.redirect');
Route::get('auth/google/callback', [AuthController::class, 'handleGoogleCallback'])->name('auth.callback');

Route::get('auth/login/google', [AuthController::class, 'redirectToGoogleLogin'])->name('auth.redirect.login');
Route::get('auth/login/google/callback', [AuthController::class, 'handleGoogleCallbackLogin'])->name('auth.callback.login');

use Illuminate\Support\Facades\Artisan;

Route::get('/clear-cache', function () {
    // Run the optimize:clear command
    Artisan::call('optimize:clear');

    // Return a response to indicate success
    return 'Cache cleared successfully!';
});
