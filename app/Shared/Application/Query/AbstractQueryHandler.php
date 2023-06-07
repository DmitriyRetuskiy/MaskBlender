<?php

namespace App\Shared\Application\Query;

class AbstractQueryHandler
{
    /**
     * @return static
     */
    public static function make(): static
    {
        return new static();
    }

}
