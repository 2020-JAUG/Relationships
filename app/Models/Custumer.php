<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Custumer extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'custumers';

    public function claims(): HasMany
    {
        return $this->hasMany(Claim::class, 'custumer_id', 'id');
    }

    public function refunds(): HasManyThrough
    {
        return $this->hasManyThrough(Refund::class, Claim::class);
    }
}
