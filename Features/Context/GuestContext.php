<?php

namespace ToursEvenements\FestivalBundle\Features\Context;

use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Gherkin\Node\TableNode;
use ToursEvenements\FestivalBundle\Entity\Guest;
use ToursEvenements\FestivalBundle\Services\Guest\FakeLister;
use ToursEvenements\FestivalBundle\Services\Guest\RequestFactory;
use ToursEvenements\FestivalBundle\Services\Lister\ChainLister;

/**
 * Defines application features from the specific context.
 */
class GuestContext extends CardListerContext implements Context, SnippetAcceptingContext
{
    protected $chainLister;
    protected $fakeLister;
    protected $requestFactory;
    protected $isAdmin = false;

    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct(
        ChainLister $chainLister,
        FakeLister $fakeLister,
        RequestFactory $requestFactory
    ) {
        $this->chainLister = $chainLister;
        $this->fakeLister = $fakeLister;
        $this->requestFactory = $requestFactory;
    }

    protected function getRequestFactory()
    {
        return $this->requestFactory;
    }

    protected function getLister()
    {
        return $this->chainLister;
    }

    protected function getSingular()
    {
        return 'guest';
    }

    protected function getPlural()
    {
        return 'guests';
    }

    /**
     * @Given there are the following fake guests
     */
    public function thereAreTheFollowingFakeGuests(TableNode $table)
    {
        foreach ($table as $row) {
            $guest = new Guest();
            $guest->setName($row['name'])
                ->setGuestOfHonor($row['guestOfHonor'])
                ;
            $this->fakeLister->addItem($guest);
        }
    }

    /**
     * @Then I received a list of fake guest
     */
    public function iReceivedAListOfFakeGuest()
    {
        \PHPUnit_Framework_Assert::assertTrue($this->lastResponse->getIsFake());
    }

    /**
     * @Then I received a list of real guest
     */
    public function iReceivedAListOfRealGuest()
    {
        \PHPUnit_Framework_Assert::assertFalse($this->lastResponse->getIsFake());
    }

    /**
     * @Then I want to see just honor guest
     */
    public function iWantToSeeJustHonorGuest()
    {
        $this->nextRequest->setGuestOfHonor(true);
    }

    /**
     * @Then I want to see guests who are present on Friday
     */
    public function iWantToSeeGuestsWhoArePresentOnFriday()
    {
        $this->nextRequest->setThisFriday(true);
    }

    /**
     * @Then I want to see guests who are present on Saturday
     */
    public function iWantToSeeGuestsWhoArePresentOnSaturday()
    {
        $this->nextRequest->setThisSaturday(true);
    }

    /**
     * @Then I want to see guests who are present on Sunday
     */
    public function iWantToSeeGuestsWhoArePresentOnSunday()
    {
        $this->nextRequest->setThisSunday(true);
    }

    /**
     * @Then /^I should count (\d+) pages?$/
     */
    public function iShouldCountPage($arg1)
    {
        \PHPUnit_Framework_Assert::assertEquals($arg1, $this->lastResponse->getNbPages());
    }

    /**
     * @Then /^I should count (\d+) guests?$/
     */
    public function iShouldCountGuest($arg1)
    {
        \PHPUnit_Framework_Assert::assertEquals($arg1, $this->lastResponse->getNbResults());
    }

    /**
     * @When /^I want to see max (\d+) guests? per page$/
     */
    public function iWantToSeeMaxGuestsPerPage($arg1)
    {
        $this->nextRequest->setMaxPerPage($arg1);
    }

    /**
     * @When /^I want to see the page number (\d+)$/
     */
    public function iWantToSeeThePageNumber($arg1)
    {
        $this->nextRequest->setCurrentPage($arg1);
    }

    /**
     * @Given I want to see guests on the :arg1 univers
     */
    public function iWantToSeeGuestsOnTheUnivers($arg1)
    {
        $this->nextRequest->setUnivers($arg1);
    }
}
