<?php

namespace Weblynx\LaravelModelAudit\App\Listeners;

use Weblynx\LaravelModelAudit\App\Enums\AuditEvent;
use Weblynx\LaravelModelAudit\App\Events\ModelWasForceDeleted;
use Weblynx\LaravelModelAudit\Feature;

class AuditForceDeleted
{
    /**
     * Handle the event.
     *
     * @param object $event
     * @return void
     */
    public function handle(ModelWasForceDeleted $event)
    {
        Feature::audit($event, AuditEvent::FORCE_DELETED);
    }
}
