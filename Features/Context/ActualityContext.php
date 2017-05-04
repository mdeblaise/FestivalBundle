<?php

namespace ToursEvenements\FestivalBundle\Features\Context;

use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Gherkin\Node\TableNode;
use ToursEvenements\FestivalBundle\Entity\Actuality;
use ToursEvenements\FestivalBundle\Services\Actuality\FakeLister;
use ToursEvenements\FestivalBundle\Services\Actuality\RequestFactory;
use ToursEvenements\FestivalBundle\Services\Lister\ChainLister;

/**
 * Defines application features from the specific context.
 */
class ActualityContext extends CardListerContext implements Context, SnippetAcceptingContext
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
        return 'actuality';
    }

    protected function getPlural()
    {
        return 'actualities';
    }

    /**
     * @Given I prepare the request (date = :arg1, limit = :arg2)
     */
    public function iPrepareTheRequestDateLimit($arg1, $arg2)
    {
        $this->iPrepareTheRequest();
        $this->nextRequest->setDateReference(new \Datetime(date('Y-m-d H:i:s', strtotime($arg1))));
        $this->nextRequest->setMaxPerPage($arg2);
    }

    /**
     * @Given there are the following fake actualities
     */
    public function thereAreTheFollowingFakeActualities(TableNode $table)
    {
        foreach ($table as $row) {
            $actuality = new Actuality();
            $actuality->setTitle($row['title'])
                ->setContents($row['contents'])
                ->setPublishedAt(new \Datetime($row['date']))
                ;
            $this->fakeLister->addItem($actuality);
        }
    }

    /**
     * @Then I received a list of fake actuality
     */
    public function iReceivedAListOfFakeActuality()
    {
        \PHPUnit_Framework_Assert::assertTrue($this->lastResponse->getIsFake());
    }

    /**
     * @Then I received a list of real actuality
     */
    public function iReceivedAListOfRealActuality()
    {
        \PHPUnit_Framework_Assert::assertFalse($this->lastResponse->getIsFake());
    }
}
