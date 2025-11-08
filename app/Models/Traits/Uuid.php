<?php

namespace App\Models\Traits;

use Ramsey\Uuid\Uuid as RamseyUuid;

/**
 * Trait UuidTrait
 * @package App\Models\Traits
 */
trait Uuid
{
    /**
     *
     */
    public static function boot()
    {
        parent::boot();
        static::creating(function ($obj) {
            $obj->id = RamseyUuid::uuid4()->toString();
        });
    }
}
