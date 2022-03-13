<?php

namespace Weblynx\LaravelModelAudit\App\Listeners;

use Weblynx\LaravelModelAudit\App\Enums\AuditEvent;
use Weblynx\LaravelModelAudit\App\Events\ModelWasUpdated;
use Weblynx\LaravelModelAudit\Feature;

class AuditUpdatedModel
{
    /**
     * Handle the event.
     *
     * @param object $event
     * @return void
     */
    public function handle(ModelWasUpdated $event)
    {
        Feature::audit($event, AuditEvent::UPDATED);
    }
}
