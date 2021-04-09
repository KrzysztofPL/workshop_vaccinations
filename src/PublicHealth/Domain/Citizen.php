<?php

namespace PublicHealth\Domain;

class Citizen
{
    private CitizenAge $age;

    public function __construct(CitizenAge $age)
    {
        $this->age = $age;
    }

    public function getAgeInYears(): int
    {
        return $this->age->getAgeInYears();
    }
}
