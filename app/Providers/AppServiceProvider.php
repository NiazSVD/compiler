<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\HomeSettings;
use Illuminate\Support\Facades\Schema;
use App\Models\MultiLang;
use Illuminate\Support\Facades\Config;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Model::automaticallyEagerLoadRelationships();
        Paginator::useBootstrapFive();

        View::share('homeSettings', HomeSettings::first());


        if (Schema::hasTable('multi_langs')) {


            $dbLangs = MultiLang::where('active', 1)->get();

            if ($dbLangs->count() > 0) {
                $locales = [];

                foreach ($dbLangs as $lang) {

                    $locales[$lang->code] = [
                        'name'   => $lang->name,
                        'native' => $lang->name,
                    ];
                }

                Config::set('laravellocalization.supportedLocales', $locales);
            }
        }
    }
}
