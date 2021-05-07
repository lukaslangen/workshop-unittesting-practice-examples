<?php

declare(strict_types=1);

namespace LukasLangen\Workshop\UnitTesting\Test;

use DateTimeImmutable;
use Lcobucci\Clock\FrozenClock;
use LukasLangen\Workshop\UnitTesting\FirstExample;
use PHPUnit\Framework\TestCase;

final class FirstExampleTest extends TestCase
{
    /**
     * @test
     * @dataProvider simpleDataProviderWithoutYearChangeAndLeapYear
     * @dataProvider dataProviderForLeapYear
     * @dataProvider dataProviderForYearChange
     */
    public function returnsOrderedArrayWithMonthsFirstAndLastDate(
        string $from,
        string $now,
        array $expected
    ): void {
        $from = new DateTimeImmutable($from);
        $clock = new FrozenClock(new DateTimeImmutable($now));

        $unitUnderTest = new FirstExample($clock);
        $actual = $unitUnderTest->getMonthsFrom($from);

        $this->assertSame($expected, $actual);
    }

    public function simpleDataProviderWithoutYearChangeAndLeapYear(): iterable
    {
        yield 'jan-april' => [
            'from' => '2021-01-01',
            'now' => '2021-04-01',
            'expected' => [
                'April 01 - April 30 2021',
                'March 01 - March 31 2021',
                'February 01 - February 28 2021',
                'January 01 - January 31 2021',
            ],
        ];

        yield 'feb-may' => [
            'from' => '2021-02-01',
            'now' => '2021-05-01',
            'expected' => [
                'May 01 - May 31 2021',
                'April 01 - April 30 2021',
                'March 01 - March 31 2021',
                'February 01 - February 28 2021',
            ],
        ];
    }

    public function dataProviderForLeapYear(): iterable
    {
        yield 'leap-year' => [
            'from' => '2020-02-01',
            'now' => '2020-05-01',
            'expected' => [
                'May 01 - May 31 2020',
                'April 01 - April 30 2020',
                'March 01 - March 31 2020',
                'February 01 - February 29 2020',
            ],
        ];
    }

    public function dataProviderForYearChange(): iterable
    {
        yield 'year-change' => [
            'from' => '2020-12-01',
            'now' => '2021-02-01',
            'expected' => [
                'February 01 - February 28 2021',
                'January 01 - January 31 2021',
                'December 01 - December 31 2020',
            ],
        ];
    }
}
