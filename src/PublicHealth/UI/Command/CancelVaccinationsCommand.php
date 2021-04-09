<?php

use PublicHealth\Application\CancelVaccinations;

class CancelVaccinationsCommand
{
    public function __construct(CancelVaccinations $cancelVaccinations)
    {
        $cancelVaccinations->execute();
    }
}
