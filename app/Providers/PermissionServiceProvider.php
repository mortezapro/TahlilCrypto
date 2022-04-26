<?php

namespace App\Providers;

use App\Models\PermissionModel;
use App\Models\User;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class PermissionServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        PermissionModel::all()->map(function ($permission){
            Gate::define($permission->name,function (User $user) use ($permission){
                return $user->userHasPermissions($permission);
            });
        });

        Blade::if('role',function ($role){
            return auth()->check() && auth()->user()->hasRoles($role);
        });
    }
}
