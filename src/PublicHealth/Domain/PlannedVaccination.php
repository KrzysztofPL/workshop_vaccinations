<?php

namespace PublicHealth\Domain;

use PublicHealth\Domain\Exception\NotAllowedByJarekException;

class PlannedVaccination
{
    private const MINIMUM_AGE_IN_YEARS = 60;
    private const MINIMUM_DAYS_TO_CANCEL = 4;

    private Citizen $citizen;
    private \DateTimeImmutable $vaccinationDate;
    private Calendar $calendar;

    public function __construct(Citizen $citizen, \DateTimeImmutable $vaccinationDate, Calendar $calendar)
    {
        if ($citizen->getAgeInYears() < self::MINIMUM_AGE_IN_YEARS) {
            throw new NotAllowedByJarekException('Gościu, jesteś za młody!');
        }

        $this->citizen = $citizen;
        $this->vaccinationDate = $vaccinationDate;
        $this->calendar = $calendar;
    }

    public function cancel(): bool
    {
        return $this->canBeCanceled();
    }

    private function canBeCanceled(): bool
    {
        $now = $this->calendar->getCurrentDateTime();
        $dateDiff = $now->diff($this->vaccinationDate);

        return $dateDiff->invert === 0
            && $dateDiff->days > self::MINIMUM_DAYS_TO_CANCEL;
    }

    public function getCitizen(): Citizen
    {
        return $this->citizen;
    }
}
