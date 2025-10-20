<?php

namespace App\Http\Controllers\Web;

use Exception;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RedirectsUsers;

class AuthController extends Controller
{
    use RedirectsUsers;

    protected $redirectTo = '/admin/dashboard';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login()
    {
        return view('web.auth.signin');
    }

    // Process login
    public function loginUser()
    {
        request()->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required'
        ]);

        $data = request()->only('email', 'password');

        if (Auth::attempt($data, request()->filled('remember'))) {
            request()->session()->regenerate();
            return redirect()->intended($this->redirectPath());
        }

        return back()->withErrors([
            'password' => 'Wrong password!',
        ])->onlyInput('email');
    }

    public function signup()
    {
        return view('web.auth.signup');
    }

    // Process registration
    public function signupUser()
    {
        $data = request()->all();

        $validator = Validator::make($data, [
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed']
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        return DB::transaction(function () use ($data) {
            // try {
                $data['password'] = Hash::make($data['password']);
                if (isset($data['image'])) {
                    $data['image'] = file_upload($data['image'], 'users', 'public', 300, 300);
                }

                // Create user
                $user = User::create($data);

                // Assign role
                $user->assignRole('user');

                // 🔔 Fire registered event to send email verification
                event(new Registered($user));

                Auth::login($user);

                return redirect($this->redirectPath());
            // } catch (Exception $e) {
            //     Log::error('User registration failed', ['error' => $e->getMessage()]);
            //     return back()->with('error', 'Registration failed. Please try again.');
            // }
        });
    }

    // Logout
    public function logout()
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect('/');
    }


    public function showForgotPasswordForm()
    {
        return view('web.auth.forgot-password');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        try {
            $status = Password::sendResetLink(
                $request->only('email')
            );
            return $status === Password::RESET_LINK_SENT
                ? back()->with(['status' => __($status)])
                : back()->withErrors(['email' => __($status)]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong')->withErrors(['email' => 'Something went wrong, try again later.'])->withInput();
        }
    }

    public function showResetForm(Request $request, $token)
    {
        return view('web.auth.reset-password', ['token' => $token, 'email' => $request->email]);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        try {
            $status = Password::reset(
                $request->only('email', 'password', 'password_confirmation', 'token'),
                function ($user, $password) {
                    $user->forceFill([
                        'password' => Hash::make($password),
                        'remember_token' => Str::random(60),
                        ])->save();

                        event(new PasswordReset($user));
                    }
                );

            return $status === Password::PASSWORD_RESET
                ? redirect()->route('login')->with('status', __($status))
                : back()->withErrors(['email' => [__($status)]]);
        } catch (\Exception $e) {
            return redirect('/')->with('error', 'Something went wrong');
        }
    }
}
