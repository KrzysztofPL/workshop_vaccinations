<?php

namespace PublicHealth\Domain;

interface Calendar
{
    public function getCurrentDateTime(): \DateTimeImmutable;
}
