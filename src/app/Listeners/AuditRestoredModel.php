<?php

namespace Weblynx\LaravelModelAudit\App\Listeners;

use Weblynx\LaravelModelAudit\App\Enums\AuditEvent;
use Weblynx\LaravelModelAudit\App\Events\ModelWasRestored;
use Weblynx\LaravelModelAudit\Feature;

class AuditRestoredModel
{
    /**
     * Handle the event.
     *
     * @param object $event
     * @return void
     */
    public function handle(ModelWasRestored $event)
    {
        Feature::audit($event, AuditEvent::RESTORED);
    }
}
