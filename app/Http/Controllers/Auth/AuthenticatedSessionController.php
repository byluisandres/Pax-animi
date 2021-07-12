<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Inertia\Inertia;
use App\Models\SocialLogin;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use App\Providers\RouteServiceProvider;
use App\Http\Requests\Auth\LoginRequest;
use Laravel\Socialite\Facades\Socialite;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Inertia\Response
     */
    public function create()
    {
        return Inertia::render('Auth/Login', [
            'canResetPassword' => Route::has('password.request'),
            'status' => session('status'),
        ]);
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request)
    {
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended(RouteServiceProvider::HOME);
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    //
    public function redirectToProvider($provider)
    {

        //verificar
        if (!config("services.$provider")) abort('404');

        return Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallback($provider)
    {
        $userSocialite = Socialite::driver($provider)->user();

        $user = User::where('email', $userSocialite->email)->first();

        if (!$user) {
            //crear el usuario
            $user = User::create([
                'name' => $userSocialite->name,
                'email' => $userSocialite->email ? $userSocialite->email : $userSocialite->nickname,
                'password' => Hash::make(Str::random(10)),
            ]);
        }
        $user_social = SocialLogin::where('social_id', $userSocialite->id)->orWhere('provider', $provider)->first();
        if (!$user_social) {
            SocialLogin::create([
                'provider' => $provider,
                'nick_email' => $userSocialite->email ? $userSocialite->email : $userSocialite->nickname,
                'social_id' => $userSocialite->id,
                'user_id' => $user->id
            ]);
        }

        return $this->loginAndRedirect($user);
    }

    public function loginAndRedirect($user)
    {
        Auth::login($user);

        return redirect()->to('/dashboard');
    }
}
