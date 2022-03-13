<?php

namespace Weblynx\LaravelModelAudit\App\Traits;

use Weblynx\LaravelModelAudit\App\Models\Auditor;

trait HasManyAudits
{
    public function audits()
    {
        return $this->hasMany(Auditor::class,'created_by_id', 'id');
    }
}
