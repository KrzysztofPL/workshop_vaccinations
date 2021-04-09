<?php

namespace test\PublicHealth\util;

use PublicHealth\Domain\Calendar;

class FixedCalendar implements Calendar
{
    private \DateTimeImmutable $now;

    public function __construct(string $now)
    {
        $this->now = new \DateTimeImmutable($now);
    }

    public function getCurrentDateTime(): \DateTimeImmutable
    {
        return $this->now;
    }
}
