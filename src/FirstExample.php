<?php

declare(strict_types=1);

namespace LukasLangen\Workshop\UnitTesting;

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
        // Write your code here

        return [];
    }
}
