<?php

declare(strict_types=1);

namespace LukasLangen\Workshop\UnitTesting;

use DateInterval;
use DateTimeImmutable;
use Lcobucci\Clock\Clock;

final class FirstExample
{
    /**
     * @var Clock
     */
    private $clock;

    public function __construct(Clock $clock)
    {
        $this->clock = $clock;
    }

    /**
     * This method should return an array containing all months
     * in the format '{MonthName} {first-of-month} - {MonthName} {last-of-month}'
     * ordered by the month's occurence in a decending order.
     *
     * For "now" use \Lcobucci\Clock::class
     *
     * Example:
     *     Input:
     *
     *     $from = new \DateTimeImmutable('2021-01-01')
     *     $now = new \DateTimeImmutable('2021-01-04')
     *
     *     Output:
     *     [
     *         'April 01 - April 30 2021',
     *         'March 01 - March 31 2021',
     *         'February 01 - February 28 2021',
     *         'January 01 - January 31 2021'
     *     ]
     */
    public function getMonthsFrom(\DateTimeImmutable $from): array
    {
        $now = $this->clock->now()->modify('first day of');
        $from = $from->modify('first day of');

        $interval = new DateInterval('P1M');
        $result = [];

        do {
            $result[] = $this->getStringForMonth($now);

            $now = $now->sub($interval);
        } while ($from <= $now);

        return $result;
    }

    private function getStringForMonth(DateTimeImmutable $now): string
    {
        $firstOfMonth = $now->modify('first day of');
        $lastOfMonth = $now->modify('last day of');

        $current = $firstOfMonth->format('F d') . ' - ';
        $current .= $lastOfMonth->format('F d') . ' ';
        $current .= $now->format('Y');

        return $current;
    }
}
