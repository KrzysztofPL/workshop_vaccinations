<?php

use PHPUnit\Framework\TestCase;
use PublicHealth\Application\CancelledVaccinationNotifier;
use PublicHealth\Application\CancelVaccinations;
use PublicHealth\Domain\Citizen;
use PublicHealth\Domain\CitizenAge;
use PublicHealth\Domain\PlannedVaccination;
use PublicHealth\Domain\PlannedVaccinationRepository;
use test\PublicHealth\util\FixedCalendar;

class CancelVaccinationsTest extends TestCase
{
    public function testCitizensAreNotifiedThatTheirVaccinationsWereCancelled()
    {
        $citizen = $this->getCitizenForVaccination();
        $vaccination = $this->getVaccinationOneWeekAhead($citizen);

        $repositoryStub = $this->createMock(PlannedVaccinationRepository::class);
        $repositoryStub->method('getForCitizensBetween40And59')
            ->willReturn([$vaccination]);

        $notifierMock = $this->createMock(CancelledVaccinationNotifier::class);
        $notifierMock->expects($this->once())
            ->method('notify')
            ->with($citizen);

        $cancel = new CancelVaccinations($repositoryStub, $notifierMock);
        $cancel->execute();
    }

    private function getVaccinationOneWeekAhead(Citizen $citizen): PlannedVaccination
    {
        return new PlannedVaccination(
            $citizen,
            new \DateTimeImmutable('2021-04-17'),
            new FixedCalendar('2021-04-10')
        );
    }

    private function getCitizenForVaccination(): Citizen
    {
        $age = new CitizenAge(70);

        return new Citizen($age);
    }
}
