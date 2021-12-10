<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use App\Models\Nationality;
use App\Models\Qualification;
use App\Models\User;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Fortify;
use Inertia\Inertia;

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
        /* Customize Auth Views */
        Fortify::registerView(function(){
            if(request()->role=='mentor'){
                return Inertia::render('Auth/RegisterMentor',[
                    'nationalities' => Nationality::all(['id','country']),
                    'qualifications' => Qualification::all(['id','name']),
                ]);
            }
            elseif(request()->role=='mentee')
            {
               return Inertia::render('Auth/RegisterMentee', [
                'nationalities' => Nationality::all(['id','country'])
               ]);
            }
            else{
                return Inertia::render('Auth/RegisterMentee', [
                    'nationalities' => Nationality::all(['id','country']),
                   ]);
            }
            
        });

        /* Customize Authentication (Login) */

        Fortify::authenticateUsing(function(Request $request){
            $request->validate([
                'username' => ['required','string'],
                'password' => ['required'],
            ]);
            
            $user = User::where('username',$request->username)
                            ->orWhere('email',$request->username)
                            ->where('status', User::STATUS_ACTIVE)
                            ->first();
       
            if($user){
               return Hash::check($request->password,$user->password) ? $user : null;
            }
        });
        
        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);

        RateLimiter::for('login', function (Request $request) {
            return Limit::perMinute(5)->by($request->email.$request->ip());
        });

        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });
    }
}
