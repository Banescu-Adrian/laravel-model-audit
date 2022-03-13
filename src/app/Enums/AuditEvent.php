<?php

namespace Weblynx\LaravelModelAudit\App\Enums;

enum AuditEvent: string
{
    case CREATING = 'creating';
    case CREATED = 'created';
    case UPDATING = 'updating';
    case UPDATED = 'updated';
    case DELETING = 'deleting';
    case DELETED = 'deleted';
    case RESTORING = 'restoring';
    case RESTORED = 'restored';
    case SOFT_DELETED = 'soft-deleted';
    case FORCE_DELETED = 'force-deleted';
}
