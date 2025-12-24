<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class ServiceProvider extends Model
{
    protected $fillable = [
        'uuid',
        'name',
        'category_id',
        'phone',
        'address',
        'description',
        'photo',
    ];

    /**
     * Boot function to generate UUID automatically
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->uuid)) {
                $model->uuid = (string) Str::uuid();
            }
        });
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'uuid';
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
