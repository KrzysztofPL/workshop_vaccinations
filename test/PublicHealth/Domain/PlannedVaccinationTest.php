<?php

use PHPUnit\Framework\TestCase;
use PublicHealth\Domain\Citizen;
use PublicHealth\Domain\CitizenAge;
use PublicHealth\Domain\Exception\NotAllowedByJarekException;
use PublicHealth\Domain\PlannedVaccination;
use test\PublicHealth\util\FixedCalendar;

final class PlannedVaccinationTest extends TestCase
{
    public function testPlannedVaccinationCannotBeCanceled4DaysAhead()
    {
        $age = new CitizenAge(69);
        $citizen = new Citizen($age);
        $plannedVaccination = new PlannedVaccination($citizen, new DateTimeImmutable('2020-04-30'), new FixedCalendar('2020-04-28'));

        $this->assertFalse($plannedVaccination->cancel(), 'This shouldnt be cancelled');
    }

    public function testCitizensBelow60CannotBeRegisteredForVaccination()
    {
        $this->expectException(NotAllowedByJarekException::class);

        $age = new CitizenAge(59);
        $citizen = new Citizen($age);
        new PlannedVaccination($citizen, new DateTimeImmutable('2020-04-30'), new FixedCalendar('2020-04-28'));
    }

    public function testCitizensOver60CanBeRegisteredForVaccination()
    {
        $age = new CitizenAge(61);
        $citizen = new Citizen($age);
        $plannedVaccination = new PlannedVaccination($citizen, new DateTimeImmutable('2020-04-30'), new FixedCalendar('2020-04-28'));

        $this->assertInstanceOf(
            PlannedVaccination::class,
            $plannedVaccination
        );
    }
}
