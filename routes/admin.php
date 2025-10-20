<?php

use App\Http\Controllers\Admin\{
    DashboardController,
    CountryController,
    StateController,
    CityController,
    UserController,
    RoleController,
    MediaController,
    SettingController,
};
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified', 'active_user'])->prefix('admin')->name('admin.')->group(function () {

    /**
     * Dashboard Routes
     */
    Route::prefix('dashboard')->name('dashboard.')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('index');
    });

    /**
     * Country Routes
     */
    Route::prefix('countries')->name('countries.')->controller(CountryController::class)->group(function () {
        Route::post('/force-delete/{id}',       'forceDelete'   )->name('forceDelete');
        Route::post('/restore/{id}',            'restore'       )->name('restore');
    });
    Route::resource('countries', CountryController::class);

    /**
     * State Routes
     */
    Route::prefix('states')->name('states.')->controller(StateController::class)->group(function () {
        Route::post('/force-delete/{id}',           'forceDelete'   )->name('forceDelete');
        Route::post('/restore/{id}',                'restore'       )->name('restore');
        Route::get('/states-by-country/{country}',  'getByCountry'  )->name('byCountry');
    });
    Route::resource('states', StateController::class);

    /**
     * City Routes
     */
    Route::prefix('cities')->name('cities.')->controller(CityController::class)->group(function () {
        Route::post('/force-delete/{id}',       'forceDelete'   )->name('forceDelete');
        Route::post('/restore/{id}',            'restore'       )->name('restore');
    });
    Route::resource('cities', CityController::class);

    /**
     * User Routes
     */
    Route::prefix('users')->name('users.')->controller(UserController::class)->group(function () {
        Route::post('/force-delete/{id}',       'forceDelete'   )->name('forceDelete');
        Route::post('/restore/{id}',            'restore'       )->name('restore');
        Route::get('/verify/{id}',              'verify'        )->name('verify');
    });
    Route::resource('users', UserController::class);

    /**
     * Roles Routes
     */
    Route::resource('roles', RoleController::class);

    /**
     * Media Routes
     */
    Route::prefix('media')->name('media.')->controller(MediaController::class)->group(function () {
        Route::get('/',                     'index'         )->name('index');
        Route::post('/delete',              'destroy'       )->name('destroy');
        Route::post('/delete-folder',       'deleteFolder'  )->name('deleteFolder');
    });

    /**
     * Setting Routes
     */
    Route::prefix('settings')->name('settings.')->controller(SettingController::class)->group(function () {
        Route::post('/store',       'store')->name('store');
        Route::get('/{section}',    'index')->name('index');
    });
















});
