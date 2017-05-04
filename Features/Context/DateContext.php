<?php

namespace ToursEvenements\FestivalBundle\Features\Context;

use Behat\Behat\Context\Context;
use ToursEvenements\FestivalBundle\Services\DateReference;

class DateContext implements Context
{
    public $dateReference;

    public function __construct(DateReference $dateReference)
    {
        $this->dateReference = $dateReference;
    }

    /**
     * @Given I set the date to ':arg1'
     */
    public function iSetTheDateTo($arg1)
    {
        $date = date('Y-m-d H:i:s', strtotime($arg1));

        return $this->dateReference->setDate(new \Datetime($date));
    }

    /**
     * @Then the date indicate ':arg1' in format ':arg2'
     */
    public function theDateIndicate($arg1, $arg2)
    {
        \PHPUnit_Framework_Assert::assertEquals($arg1, $this->dateReference->getDate()->format($arg2));
    }
}
