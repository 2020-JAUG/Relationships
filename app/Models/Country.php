<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\SoftDeletes;

class Country extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'countries';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'continent_id'
    ];


    public function users(): HasMany
    {
        return $this->hasMany(User::class, 'user_country_id', 'id');
    }

    public function posts(): HasManyThrough
    {
        return $this->hasManyThrough(Post::class, User::class, 'user_country_id', 'post_user_id', 'id', 'id');
    }

    public function continent(): BelongsTo
    {
        return $this->belongsTo(Continent::class, 'continent_id', 'id');
    }
}
