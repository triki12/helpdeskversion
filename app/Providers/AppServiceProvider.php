<?php

namespace App\Providers;

use App\Models\User;
use App\Models\settings;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Illuminate\Pagination\Paginator;



class AppServiceProvider extends ServiceProvider
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
        Paginator::useBootstrap();

        if (Schema::hasTable('notifications') && Schema::hasTable('settings')) {

    
            $this->allnotofadminn = DB::table('notifications')
            ->select(
                'notifications.*',
                'users.id as userid',
                'users.name as username'
            )
            ->where('notifications.markasv','0')
            ->whereNull('notifications.receiver_id')
            ->leftJoin('users','users.id','=','notifications.sender_id')
            ->limit(5)

            ->get(); 

            $this->settings = DB::table('settings')
            ->select(
                'settings.*',
            )
            ->get();

            view()->composer('layouts.adminlayout.master', function($view) {
                $view->with(['allnotofadmin' =>  $this->allnotofadminn,'settings' =>  $this->settings]);
            });




            $this->allnotoftech = DB::table('notifications')
            ->select(
                'notifications.*',
                'users.id as userid',
                'users.name as username'
            )
            ->where('notifications.markasv','0')
            ->whereNull('notifications.sender_id')
            ->leftJoin('users','users.id','=','notifications.receiver_id')
            ->limit(5)

            ->get(); 

            view()->composer('layouts.techlayout.master', function($view) {
                $view->with(['allnotoftech' =>  $this->allnotoftech,'settings' =>  $this->settings]);
            });


            $this->allnotofclient = DB::table('notifications')
            ->select(
                'notifications.*',
                'users.id as userid',
                'users.name as username'
            )
            ->where('notifications.markasv','0')
            ->whereNull('notifications.sender_id')
            ->leftJoin('users','users.id','=','notifications.receiver_id')
            ->limit(5)

            ->get(); 

            view()->composer('layouts.userlayout.master', function($view) {
                $view->with(['allnotofclient' =>  $this->allnotofclient,'settings' =>  $this->settings]);
            });



        }

     
        
       
    }
}
