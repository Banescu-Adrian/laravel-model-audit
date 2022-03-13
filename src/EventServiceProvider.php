<?php

namespace Weblynx\LaravelModelAudit;

use Carbon\Laravel\ServiceProvider;
use Illuminate\Support\Facades\Event;
use Weblynx\LaravelModelAudit\App\Events\ModelWasCreated;
use Weblynx\LaravelModelAudit\App\Events\ModelWasDeleted;
use Weblynx\LaravelModelAudit\App\Events\ModelWasForceDeleted;
use Weblynx\LaravelModelAudit\App\Events\ModelWasRestored;
use Weblynx\LaravelModelAudit\App\Events\ModelWasSoftDeleted;
use Weblynx\LaravelModelAudit\App\Events\ModelWasUpdated;
use Weblynx\LaravelModelAudit\App\Listeners\AuditCreatedModel;
use Weblynx\LaravelModelAudit\App\Listeners\AuditDeletedModel;
use Weblynx\LaravelModelAudit\App\Listeners\AuditForceDeleted;
use Weblynx\LaravelModelAudit\App\Listeners\AuditRestoredModel;
use Weblynx\LaravelModelAudit\App\Listeners\AuditSoftDeleted;
use Weblynx\LaravelModelAudit\App\Listeners\AuditUpdatedModel;

class EventServiceProvider extends ServiceProvider
{
    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        Event::listen(ModelWasCreated::class, AuditCreatedModel::class);
        Event::listen(ModelWasUpdated::class, AuditUpdatedModel::class);
        Event::listen(ModelWasDeleted::class, AuditDeletedModel::class);
        Event::listen(ModelWasRestored::class, AuditRestoredModel::class);
        Event::listen(ModelWasSoftDeleted::class, AuditSoftDeleted::class);
        Event::listen(ModelWasForceDeleted::class, AuditForceDeleted::class);
    }
}
