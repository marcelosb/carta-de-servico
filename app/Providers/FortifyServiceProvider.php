<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use App\Models\Configuration;
use App\Models\User;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Fortify;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);

        /** @route /login  GET */
        Fortify::loginView(function() {
            if (User::all()->isEmpty()) {
                // return view('admin.auth.register');
                return redirect()->route('register');
            }

            $configuration = Configuration::getConfiguration();
            return view('admin.auth.login', [
                'configuration' => $configuration
            ]);
        });

        /** @route /register   GET */
        Fortify::registerView(function() {
            if (User::all()->isEmpty()) {
                // return redirect()->route('register');
                return view('admin.auth.register');
            }

            return redirect()->route('login');
        });

        /** 
         * Mostra a página de redefinição de senha
         * @route /forgot-password  GET 
        */
        Fortify::requestPasswordResetLinkView(function () {
            return view('admin.auth.forgot-password');
        });

        /** 
         * Mostra a página de alterar/criar uma nova senha
         * @route /reset-password/{token}  GET 
         * */
        Fortify::resetPasswordView(function ($request) {
            return view('admin.auth.reset-password', ['request' => $request]);
        });

        Fortify::authenticateUsing(function (Request $request) {
            $user = User::where('email', $request->email)->first();
    
            if ($user && Hash::check($request->password, $user->password)) {
                return $user;
            }
        });

        RateLimiter::for('login', function (Request $request) {
            return Limit::perMinute(5)->by($request->email.$request->ip());
        });

        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });

        $this->app->singleton(
            \Laravel\Fortify\Contracts\LogoutResponse::class,
            \App\Http\Responses\LogoutResponse::class
        );
    }
}
