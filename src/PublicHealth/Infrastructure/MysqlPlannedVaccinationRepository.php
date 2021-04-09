<?php

use PublicHealth\Domain\PlannedVaccinationRepository;

class MysqlPlannedVaccinationRepository implements PlannedVaccinationRepository
{
    public function __construct($databaseDriver)
    {
    }

    public function getForCitizensBetween40And59(): array
    {
        // TODO
    }
}
