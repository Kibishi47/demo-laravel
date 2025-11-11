<?php

namespace App\Models;

use App\Observers\ProjectObserver;
use App\Policies\ProjectPolicy;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Attributes\UsePolicy;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

#[ObservedBy(ProjectObserver::class)]
#[UsePolicy(ProjectPolicy::class)]
class Project extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'keywords',
        'is_active',
    ];

    protected $casts = [
        'keywords' => 'array',
        'is_active' => 'boolean',
    ];

    public function keywords(): Attribute
    {
        return Attribute::make(
            set: function ($value) {
                return json_encode($value);
            }
        );
    }

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    #[Scope]
    protected function own(Builder $query): void
    {
        $query->where('owner_id', auth()->id());
    }

    #[Scope]
    protected function active(Builder $query): void
    {
        $query->where('is_active', true);
    }
}
