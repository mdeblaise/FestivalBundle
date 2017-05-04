<?php

namespace ToursEvenements\FestivalBundle\Services\Schedule;

use Symfony\Component\Translation\TranslatorInterface;

class ScheduleProviderTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->translator = $this->getMockBuilder(TranslatorInterface::class)->getMock();
    }

    public function testGetDays()
    {
        $provider = new ScheduleProvider('2017-02-10', 3, 2, $this->translator);

        $days = $provider->getDays();
        $this->assertCount(3, $days);
        $this->assertArrayHasKey('Fri_10', $days);
        $this->assertArrayHasKey('Sat_11', $days);
        $this->assertArrayHasKey('Sun_12', $days);

        $provider = new ScheduleProvider('2017-02-10', 2, 2, $this->translator);

        $days = $provider->getDays();
        $this->assertCount(2, $days);
        $this->assertArrayHasKey('Sat_11', $days);
        $this->assertArrayHasKey('Fri_10', $days);
    }

    public function testGetStaffDays()
    {
        $provider = new ScheduleProvider('2017-02-10', 3, 2, $this->translator);

        $days = $provider->getStaffDays();
        $this->assertCount(5, $days);
        $this->assertArrayHasKey('Wed_08', $days);
        $this->assertArrayHasKey('Thu_09', $days);
        $this->assertArrayHasKey('Fri_10', $days);
        $this->assertArrayHasKey('Sat_11', $days);
        $this->assertArrayHasKey('Sun_12', $days);
    }

    public function testGetStaffTimeSlots()
    {
        $provider = new ScheduleProvider('2017-02-10', 3, 2, $this->translator);

        $timeSlots = $provider->getStaffTimeSlots();
        $this->assertCount(10, $timeSlots);
        $this->assertArrayHasKey('Wed_08_am', $timeSlots);
        $this->assertArrayHasKey('Wed_08_pm', $timeSlots);
        $this->assertArrayHasKey('Thu_09_am', $timeSlots);
        $this->assertArrayHasKey('Thu_09_pm', $timeSlots);
        $this->assertArrayHasKey('Fri_10_am', $timeSlots);
        $this->assertArrayHasKey('Fri_10_pm', $timeSlots);
        $this->assertArrayHasKey('Sat_11_am', $timeSlots);
        $this->assertArrayHasKey('Sat_11_pm', $timeSlots);
        $this->assertArrayHasKey('Sun_12_am', $timeSlots);
        $this->assertArrayHasKey('Sun_12_pm', $timeSlots);
    }
}
