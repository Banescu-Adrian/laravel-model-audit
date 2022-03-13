<?php

namespace Weblynx\LaravelModelAudit\App\Listeners;

use Weblynx\LaravelModelAudit\App\Enums\AuditEvent;
use Weblynx\LaravelModelAudit\App\Events\ModelWasDeleted;
use Weblynx\LaravelModelAudit\Feature;

class AuditDeletedModel
{
    /**
     * Handle the event.
     *
     * @param object $event
     * @return void
     */
    public function handle(ModelWasDeleted $event)
    {
        Feature::audit($event, AuditEvent::DELETED);
    }
}
