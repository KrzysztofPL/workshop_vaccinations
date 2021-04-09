<?php

namespace PublicHealth\Application;

use PublicHealth\Domain\PlannedVaccinationRepository;

class CancelVaccinations
{
    private PlannedVaccinationRepository $plannedVaccinationRepository;
    private CancelledVaccinationNotifier $notifier;

    public function __construct(PlannedVaccinationRepository $plannedVaccinationRepository, CancelledVaccinationNotifier $notifier)
    {
        $this->plannedVaccinationRepository = $plannedVaccinationRepository;
        $this->notifier = $notifier;
    }

    public function execute(): void
    {
        $plannedVaccinations = $this->plannedVaccinationRepository->getForCitizensBetween40And59();

        foreach ($plannedVaccinations as $plannedVaccination) {
            if ($plannedVaccination->cancel()) {
                $this->notifier->notify($plannedVaccination->getCitizen());
            }
        }
    }
}
