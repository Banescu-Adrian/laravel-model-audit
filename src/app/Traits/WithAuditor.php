<?php

namespace Weblynx\LaravelModelAudit\App\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Weblynx\LaravelModelAudit\App\Events\ModelWasCreated;
use Weblynx\LaravelModelAudit\App\Events\ModelWasDeleted;
use Weblynx\LaravelModelAudit\App\Events\ModelWasForceDeleted;
use Weblynx\LaravelModelAudit\App\Events\ModelWasRestored;
use Weblynx\LaravelModelAudit\App\Events\ModelWasSoftDeleted;
use Weblynx\LaravelModelAudit\App\Events\ModelWasUpdated;
use Weblynx\LaravelModelAudit\App\Models\Auditor;
use Weblynx\LaravelModelAudit\Feature;

trait WithAuditor
{
    /**
     * Get all the model's audits.
     */
    public function auditable(): MorphMany
    {
        return $this->morphMany(Auditor::class, 'auditable');
    }

    /**
     * Get the model's most recent audit.
     */
    public function latestAudit(): MorphOne
    {
        return $this->morphOne(Auditor::class, 'auditable')->latestOfMany();
    }

    /**
     * Get the model's oldest audit.
     */
    public function oldestAudit(): MorphOne
    {
        return $this->morphOne(Auditor::class, 'auditable')->oldestOfMany();
    }

    /**
     * Get the model's most recurrent audits.
     */
    public function mostRecurrentAudit(): MorphOne
    {
        return $this->morphOne(Auditor::class, 'auditable')->ofMany('examinable_id', 'max');
    }

    /**
     * Get the model's least recurrent audits.
     */
    public function leastRecurrentAudit(): MorphOne
    {
        return $this->morphOne(Auditor::class, 'auditable')->ofMany('examinable_id', 'max');
    }

    /**
     * Get the auditable attributes for the model.
     *
     * @return array
     */
    public function getAuditable(): array|null
    {
        return $this->excludedAudits;
    }

    public static function boot()
    {
        parent::boot();

        self::created(function (Model $model) {
            if (Feature::hasCreated(collect($model->getAuditable())->toArray())) {
                event(new ModelWasCreated($model));
            }
        });

        self::updated(function (Model $model) {
            if (Feature::hasUpdated(collect($model->getAuditable())->toArray())) {
                event(new ModelWasUpdated($model));
            }
        });

        if (in_array('Illuminate\Database\Eloquent\SoftDeletes', class_uses(self::class))) {
            self::restored(function (Model $model) {
                if (Feature::hasRestored(collect($model->getAuditable())->toArray())) {
                    event(new ModelWasRestored($model));
                }
            });

            self::softDeleted(function (Model $model) {
                if (Feature::hasSoftDelete(collect($model->getAuditable())->toArray())) {
                    event(new ModelWasSoftDeleted($model));
                }
            });

            static::forceDeleted(function (Model $model) {
                if (Feature::hasForceDelete(collect($model->getAuditable())->toArray())) {
                    event(new ModelWasForceDeleted($model));
                }
            });
        } else {
            self::deleted(function (Model $model) {
                if (Feature::hasDeleted(collect($model->getAuditable())->toArray())) {
                    event(new ModelWasDeleted($model));
                }
            });
        };
    }
}
