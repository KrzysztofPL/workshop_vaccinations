<?php

namespace PublicHealth\Domain;

class CitizenAge
{
    private int $ageInYears;

    public function __construct(int $ageInYears)
    {
        $this->ageInYears = $ageInYears;
    }

    public function getAgeInYears(): int
    {
        return $this->ageInYears;
    }
}
