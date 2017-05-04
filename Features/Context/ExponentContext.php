<?php

namespace ToursEvenements\FestivalBundle\Features\Context;

use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Gherkin\Node\TableNode;
use ToursEvenements\FestivalBundle\Entity\Exponent;
use ToursEvenements\FestivalBundle\Services\Exponent\FakeLister;
use ToursEvenements\FestivalBundle\Services\Exponent\RequestFactory;
use ToursEvenements\FestivalBundle\Services\Lister\ChainLister;

/**
 * Defines application features from the specific context.
 */
class ExponentContext extends CardListerContext implements Context, SnippetAcceptingContext
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
        return 'exponent';
    }

    protected function getPlural()
    {
        return 'exponents';
    }

    /**
     * @Given there are the following fake exponents
     */
    public function thereAreTheFollowingFakeExponents(TableNode $table)
    {
        foreach ($table as $row) {
            $Exponent = new Exponent();
            $Exponent->setName($row['name'])
                ->setDescriptif($row['descriptif'])
                ;
            $this->fakeLister->addItem($Exponent);
        }
    }

    /**
     * @Then I received a list of fake Exponent
     */
    public function iReceivedAListOfFakeExponent()
    {
        \PHPUnit_Framework_Assert::assertTrue($this->lastResponse->getIsFake());
    }

    /**
     * @Then I received a list of real Exponent
     */
    public function iReceivedAListOfRealExponent()
    {
        \PHPUnit_Framework_Assert::assertFalse($this->lastResponse->getIsFake());
    }
}
