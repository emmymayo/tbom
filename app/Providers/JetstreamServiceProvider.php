<?php

namespace App\Providers;

use App\Actions\Jetstream\DeleteUser;
use App\Models\Nationality;
use App\Models\Qualification;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;
use Laravel\Jetstream\Jetstream;

class JetstreamServiceProvider extends ServiceProvider
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
        $this->configurePermissions();
        
        Jetstream::deleteUsersUsing(DeleteUser::class);
        Jetstream::inertia()->whenRendering('Profile/Show', function(Request $request, array $data){
            
            return array_merge($data, [
                'nationalities' => Nationality::all(['id', 'country']),
                'qualifications' => Qualification::all(['id','name']),
                'mentee' => User::find(auth()->id())->isMentee()? User::find(auth()->id())->mentee: null,
                'mentor' => User::find(auth()->id())->isMentor()? User::find(auth()->id())->mentor: null,
             
            ]);
        });

    }

    /**
     * Configure the permissions that are available within the application.
     *
     * @return void
     */
    protected function configurePermissions()
    {
        Jetstream::defaultApiTokenPermissions(['read']);

        Jetstream::permissions([
            'create',
            'read',
            'update',
            'delete',
        ]);
    }
}
