<?php

namespace App\Shared\Application;

use App\Shared\Infrastructure\ValueObject\UuidValueObject;

class AbstractCreator
{
    /**
     * @param string|null $uuid
     *
     * @return UuidValueObject
     */
    protected static function createUuid(
        ?string $uuid = null
    ): UuidValueObject
    {
        return isset($uuid) ? UuidValueObject::create($uuid) : UuidValueObject::create();
    }

}
