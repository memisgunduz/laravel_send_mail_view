<?php

use App\Http\Controllers\CampaignController;
use App\Http\Controllers\MailListController;
use App\Http\Controllers\MailTemplateController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MailController;
use App\Models\Campaign;
use \Illuminate\Support\Facades\Mail;
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
    return view('welcome');
});

Route::get('/test', function () {
    $campaign = Campaign::with('mailLists')->find(1);

    $campaign->mailLists()->attach(4);

    dd($campaign);
});

Auth::routes();

Route::group(['middleware' => ['auth']], function () {

    // PROGRESS
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    Route::post('campaign-update/{campaign_id?}', [CampaignController::class, 'store'])->name('campaign_update');
    Route::get('campaign-delete/{campaign?}', [CampaignController::class, 'campaign_delete']);

    Route::post('template-update/{template_id?}', [MailTemplateController::class, 'store'])->name('template_update');
    Route::get('template-delete/{mailTemplate?}', [MailTemplateController::class, 'template_delete']);

    Route::post('mail-list-update/{mail_list_id?}', [MailListController::class, 'store'])->name('mail_list_update');
    Route::get('mail-list-delete/{mail_list?}', [MailListController::class, 'mail_list_delete']);

    // VIEWS
    Route::get('/campaign-view/{campaign?}', [CampaignController::class, 'campaign_view'])->name('campaign_view');
    Route::get('/campaign-start/{campaign?}', [CampaignController::class, 'campaign_start'])->name('campaign_start');
    Route::get('/campaign', [CampaignController::class, 'campaign'])->name('campaign');

    Route::get('/template-view/{mailTemplate?}', [MailTemplateController::class, 'template_view'])->name('template_view');
    Route::get('/template-list', [MailTemplateController::class, 'template_list']);

    Route::get('/mail-list-view/{mailList?}', [MailListController::class, 'mail_view'])->name('mail_view');
    Route::get('/mail-list', [MailListController::class, 'mail_list'])->name('mail_list');

});
