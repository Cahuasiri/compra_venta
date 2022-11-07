<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{

    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    public function boot()
    {
        $this->registerPolicies();
        Gate::define('admin', function () {
            if(Auth::user()->hasRole('Administrador')){
               return true;
           }
           return false;
       });
       
       Gate::define('inven', function () {
        if(Auth::user()->hasRole('Inventario')){
           return true;
       }
       return false;
   });
    }
}
