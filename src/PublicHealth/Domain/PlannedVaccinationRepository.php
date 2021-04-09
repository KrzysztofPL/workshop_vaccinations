<?php

namespace PublicHealth\Domain;

interface PlannedVaccinationRepository
{
    /**
     * @return PlannedVaccination[]
     */
    public function getForCitizensBetween40And59(): array;
}
