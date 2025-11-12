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

    // Useful when you want to store price using integer in the db,
    // but you want to manipulate data with float like euro
    public function price(): Attribute
    {
        return Attribute::make(
            // parameter value is the value in the db (use this syntax if you have price column)
            get: fn ($value) => $value / 100,
            // parameter value is the value set for the db
            set: fn ($value) => (int) ($value * 100),
        );
    }

    // You can make custom attribute
    // You can call it like $project->long_description
    public function longDescription(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->name . ':' . $this->description,
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
