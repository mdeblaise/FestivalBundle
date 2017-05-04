<?php

namespace ToursEvenements\FestivalBundle\Features\Context;

use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Gherkin\Node\TableNode;
use ToursEvenements\FestivalBundle\Entity\Activity;
use ToursEvenements\FestivalBundle\Services\Activity\FakeLister;
use ToursEvenements\FestivalBundle\Services\Activity\RequestFactory;
use ToursEvenements\FestivalBundle\Services\Lister\ChainLister;

/**
 * Defines application features from the specific context.
 */
class ActivityContext extends CardListerContext implements Context, SnippetAcceptingContext
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
        return 'activity';
    }

    protected function getPlural()
    {
        return 'activities';
    }

    /**
     * @Given there are the following fake activities
     */
    public function thereAreTheFollowingFakeActivities(TableNode $table)
    {
        foreach ($table as $row) {
            $activity = new Activity();
            $activity->setTitle($row['title'])
                ->setDescriptif($row['descriptif'])
                ;
            $this->fakeLister->addItem($activity);
        }
    }

    /**
     * @Then I received a list of fake activity
     */
    public function iReceivedAListOfFakeActivity()
    {
        \PHPUnit_Framework_Assert::assertTrue($this->lastResponse->getIsFake());
    }

    /**
     * @Then I received a list of real activity
     */
    public function iReceivedAListOfRealActivity()
    {
        \PHPUnit_Framework_Assert::assertFalse($this->lastResponse->getIsFake());
    }
}
