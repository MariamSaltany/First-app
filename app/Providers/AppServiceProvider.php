<?php

namespace App\Providers;

use App\Models\User;
use App\Services\Newsletter;
use App\Services\MailchimpNewsletter;
use Illuminate\Support\Facades\Blade;
use MailchimpMarketing\ApiClient;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        app()->bind(Newsletter::class, function(){
           $client = (new ApiClient())->setConfig([
            'apiKey' => config('services.mailchimp.Key'),
            'server' => 'us13'
        ]);
         return new MailchimpNewsletter($client);
    });
      
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Model::unguard();

        Gate::define('admin', function(User $user){
            return $user->username == 'Mariammar';
        });
        Blade::if('admin', function(){
            return request()->user()?->can('admin');
        });
    }
}
