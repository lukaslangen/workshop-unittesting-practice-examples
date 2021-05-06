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
     *         'April 1 - April 30',
     *         'March 1 - March 31',
     *         'February 1 - February 28',
     *         'January 1 - January 31'
     *     ]
     */
    public function getMonthsFrom(\DateTimeImmutable $from): array
    {
        // Write your code here

        return [];
    }
}
