<?php

namespace PublicHealth\Application;

use PublicHealth\Domain\Citizen;

interface CancelledVaccinationNotifier
{
    public function notify(Citizen $citizen);
}
