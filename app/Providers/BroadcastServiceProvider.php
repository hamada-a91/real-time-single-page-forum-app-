<?php

namespace App\Providers;

use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\ServiceProvider;

class BroadcastServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        Broadcast::channel('App.User.{id}', function ($user, $id) {
            return (int) $user->id === (int) $id;
        });

        Broadcast::routes();
        // Broadcast::routes(['prefix' => 'api', 'middleware' => ['auth:api']]);


        require base_path('routes/channels.php');
    }
}
