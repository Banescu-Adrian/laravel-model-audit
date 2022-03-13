<?php

namespace Weblynx\LaravelModelAudit\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Auditor extends Model
{
    protected $table = "audits";
    protected $primaryKey = "id";

    protected $fillable = [
        "status",
        "model"
    ];

    protected $casts = [
        'model' => 'object'
    ];

    /**
     * Get the parent examinable model.
     */
    public function examinable(): MorphTo
    {
        return $this->morphTo();
    }
}
