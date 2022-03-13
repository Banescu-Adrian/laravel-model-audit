<?php

namespace Weblynx\LaravelModelAudit;

use Weblynx\LaravelModelAudit\App\Enums\AuditEvent;

class Feature
{
    public final static function audit($event, AuditEvent $auditEvent)
    {
        $auth = auth()->check();
        $event->model->auditable()->create([
            'created_by_type' => $auth ? auth()->getProvider()->getModel() : null,
            'created_by_id' => $auth ? auth()->id() : null,
            "event" => $auditEvent,
            "model" => $event->model
        ]);
    }

    public final static function enabled(AuditEvent $option): bool
    {
        return in_array($option->value, config('auditor.options', []));
    }

    public final static function enabledByModel(AuditEvent $option, array $excludedAudits): bool
    {
        return !in_array($option->value, $excludedAudits ?? []);
    }

    public static function hasCreated($excludedAudits): bool
    {
        return
            static::enabled(AuditEvent::CREATED) &&
            static::enabledByModel(AuditEvent::CREATED, $excludedAudits);
    }

    public static function hasUpdated($excludedAudits): bool
    {
        return static::enabled(AuditEvent::UPDATED) &&
            static::enabledByModel(AuditEvent::UPDATED, $excludedAudits);
    }

    public static function hasDeleted($excludedAudits): bool
    {
        return static::enabled(AuditEvent::DELETED) &&
            static::enabledByModel(AuditEvent::DELETED, $excludedAudits);
    }

    public static function hasRestored($excludedAudits): bool
    {
        return static::enabled(AuditEvent::RESTORED) &&
            static::enabledByModel(AuditEvent::RESTORED, $excludedAudits);
    }

    public static function hasSoftDelete($excludedAudits): bool
    {
        return static::enabled(AuditEvent::SOFT_DELETED) &&
            static::enabledByModel(AuditEvent::SOFT_DELETED, $excludedAudits);
    }

    public static function hasForceDelete($excludedAudits): bool
    {
        return static::enabled(AuditEvent::FORCE_DELETED) &&
            static::enabledByModel(AuditEvent::FORCE_DELETED, $excludedAudits);
    }
}
