<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Visit extends Model
{
    use SoftDeletes;

    /**
     * Гость для визита
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    protected $fillable = [
        'time',
        'guest_id'
    ];

    public function guest()
    {
        return $this->belongsTo(Guest::class);
    }
}
