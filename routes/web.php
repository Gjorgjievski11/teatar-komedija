<?php

use App\Http\Controllers\CalendarController;
use App\Http\Controllers\User\CalendarController as UserCalendarController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\User\AboutController;
use App\Http\Controllers\User\RepertoireController;
use App\Http\Controllers\ContributionController;
use App\Http\Controllers\CrewController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\ActivityImageController;
use App\Http\Controllers\DateController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\JobPositionController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\User\PlayController as UserPlayController;
use App\Http\Controllers\PlayController;
use App\Http\Controllers\User\ActivitiesController;
use App\Http\Controllers\User\ArchiveController;
use App\Http\Controllers\User\ContactController;
use App\Http\Controllers\User\SearchController;
use Google\Service\CloudSearch\SessionContext;
use Illuminate\Support\Facades\Route;

Route::get('login', [SessionController::class, 'index'])->name('login');
Route::post('login', [SessionController::class, 'store'])->name('sign-in');

Route::name('admin.')->prefix('admin')->middleware("auth")->group(function () {

    Route::redirect('/', '/admin/calendar');

    Route::delete('logout', [SessionController::class, 'destroy'])->name('logout');

    Route::resource('job-position', JobPositionController::class)->except('show')->names('job-position');
    Route::resource('contribution', ContributionController::class)->except('show')->names('contribution');
    Route::resource('employee', EmployeeController::class)->except('show')->names('employee');
    Route::resource('play', PlayController::class)->except('show')->names('play');
    Route::resource('category', CategoryController::class)->except('show')->names('category');
    Route::resource('document', DocumentController::class)->except('show')->names('document');
    Route::resource('activity', ActivityController::class)->except('show')->names('activity');


    Route::get('activity/image/{activity}', [ActivityImageController::class, 'create'])->name('activity.image.create');
    Route::post('activity/image/{activity}', [ActivityImageController::class, 'store'])->name('activity.image.store');
    Route::delete('activity/image/{image}', [ActivityImageController::class, 'destroy'])->name('activity.image.destroy');

    Route::get('play/crew/{play}', [CrewController::class, 'create'])->name('crew.create');
    Route::post('play/crew/{play}', [CrewController::class, 'store'])->name('crew.store');
    Route::get('play/crew/{play}/edit', [CrewController::class, 'edit'])->name('crew.edit');
    Route::patch('play/crew/{play}', [CrewController::class, 'update'])->name('crew.update');
    Route::delete('play/crew/{playEmployee}', [CrewController::class, 'destroy'])->name('crew.destroy');

    Route::get('play/dates/{play}', [DateController::class, 'create'])->name('date.create');
    Route::post('play/dates/{play}', [DateController::class, 'store'])->name('date.store');
    Route::get('play/dates/{date}/edit', [DateController::class, 'edit'])->name('date.edit');
    Route::patch('play/dates/{date}', [DateController::class, 'update'])->name('date.update');
    Route::delete('play/dates/{date}', [DateController::class, 'destroy'])->name('date.destroy');

    Route::get('play/images/{play}', [ImageController::class, 'create'])->name('image.create');
    Route::post('play/images/{play}', [ImageController::class, 'store'])->name('image.store');
    Route::delete('play/images/{image}', [ImageController::class, 'destroy'])->name('image.destroy');

    Route::get('/calendar', CalendarController::class)->name('calendar.index');

    Route::get('/newsletter', NewsletterController::class)->name('newsletter.index');
});

Route::name('user.')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home.index');
    Route::get('/search', [SearchController::class, 'index'])->name('search');

    Route::get('/repertoire', [RepertoireController::class, 'index'])->name('repertoire.index');
    Route::get('/archive/plays', [ArchiveController::class, 'plays'])->name('archive.plays');
    Route::get('/archive/repertoires', [ArchiveController::class, 'repertoires'])->name('archive.repertoires');

    Route::get('/play/{id}', [UserPlayController::class, 'show'])->name('play');

    Route::get('/about',  [AboutController::class, 'index'])->name('about.index');
    Route::get('/about/collective', [AboutController::class, 'collective'])->name('about.collective');
    Route::get('/about/documents', [AboutController::class, 'documents'])->name('about.documents');

    Route::get('/activities', [ActivitiesController::class, 'index'])->name('activities.index');
    Route::get('/activity/{category}/{id}', [ActivitiesController::class, 'show'])->name('activity');

    Route::get('/contact',  [ContactController::class, 'index'])->name('contact.index');
    
    Route::get('/calendar/data', [UserCalendarController::class, 'getCalendarData'])
        ->name('calendar.data');
});
