<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\{
    WebsiteController,
    AuthController,
    EmailVerificationController,
};

Route::name('website.')->controller(WebsiteController::class)->group(function () {
    Route::get('/',         'index'     )->name('index'     );
});

Route::controller(AuthController::class)->group(function () {
    Route::get('/login',    'login'     )->name('login'     );
    Route::get('/signup',   'signup'    )->name('register'  );
    Route::post('/logout',  'logout'    )->name('logout'    );

    Route::post('/login',   'loginUser' );
    Route::post('/signup',  'signupUser');

    // Forgot Password
    Route::get('/forgot-password',          'showForgotPasswordForm'    )->name('password.request'  );
    Route::post('/forgot-password',         'sendResetLinkEmail'        )->name('password.email'    );
    // Reset Password
    Route::get('/reset-password/{token}',   'showResetForm'             )->name('password.reset'    );
    Route::post('/reset-password',          'resetPassword'             )->name('password.update'   );
});

Route::middleware('auth', 'active_user')->group(function () {
    Route::prefix('email')->name('verification.')->controller(EmailVerificationController::class)->group(function () {
        Route::get('/verify',                       'verify'            )->name('notice');
        Route::get('/verify/{id}/{hash}',           'verified'          )->name('verify');
        Route::post('/verification-notification',   'sendVerification'  )->name('send'  );
    });
});


require __DIR__ . '/admin.php';
