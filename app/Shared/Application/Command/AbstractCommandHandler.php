<?php

namespace App\Shared\Application\Command;

class AbstractCommandHandler
{
    /**
     * @return static
     */
    public static function make(): static
    {
        return new static();
    }
}
