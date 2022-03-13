<?php

namespace Weblynx\LaravelModelAudit;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Weblynx\LaravelModelAudit\App\Models\Auditor;

class AuditLaravelServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__.'/database/migrations');

        $this->publishes([
            __DIR__.'/config/auditor.php' => config_path('auditor.php'),
        ]);

        $providers = config('auth.providers');

        foreach ($providers as $keys => $provider){
            Auditor::resolveRelationUsing(Str::singular($keys), function ($model) use ($provider) {
                return $model->belongsTo($provider['model'],'created_by_id', 'id')->withDefault([
                    'id' => null,
                    'name' => null
                ]);
            });
        }
    }

    public function register()
    {
        $this->app->register(EventServiceProvider::class);

        if (file_exists(config_path('auditor.php'))) {
            $this->mergeConfigFrom(
                __DIR__.'/config/auditor.php', 'options'
            );
        }
    }
}
