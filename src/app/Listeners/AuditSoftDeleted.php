<?php

namespace Weblynx\LaravelModelAudit\App\Listeners;

use Weblynx\LaravelModelAudit\App\Enums\AuditEvent;
use Weblynx\LaravelModelAudit\App\Events\ModelWasSoftDeleted;
use Weblynx\LaravelModelAudit\Feature;

class AuditSoftDeleted
{
    /**
     * Handle the event.
     *
     * @param object $event
     * @return void
     */
    public function handle(ModelWasSoftDeleted $event)
    {
        Feature::audit($event, AuditEvent::SOFT_DELETED);
    }
}
