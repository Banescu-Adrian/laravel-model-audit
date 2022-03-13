<?php

namespace Weblynx\LaravelModelAudit\App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Queue\InteractsWithQueue;
use Weblynx\LaravelModelAudit\App\Enums\AuditEvent;
use Weblynx\LaravelModelAudit\App\Events\ModelWasCreated;
use Weblynx\LaravelModelAudit\Feature;

class AuditCreatedModel
{
    /**
     * Handle the event.
     *
     * @param object $event
     * @return void
     */
    public function handle(ModelWasCreated $event)
    {
        Feature::audit($event, AuditEvent::CREATED);
    }
}
