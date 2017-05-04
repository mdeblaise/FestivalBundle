<?php

namespace ToursEvenements\FestivalBundle\Features\Context;

use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Behat\Tester\Exception\PendingException;
use Symfony\Component\PropertyAccess\PropertyAccess;

abstract class CardListerContext implements Context, SnippetAcceptingContext
{
    protected $lastResponse;
    protected $nextRequest;
    protected $lastException;
    protected $isAdmin = false;

    abstract protected function getRequestFactory();

    abstract protected function getLister();

    abstract protected function getSingular();

    abstract protected function getPlural();

    /**
     * @Given I have no :name
     */
    public function iHaveNoCard($name)
    {
        $this->checkSingular($name);

        $this->getLister()->reset();
    }

    /**
     * @Given I prepare the request
     */
    public function iPrepareTheRequest()
    {
        $this->nextRequest = $this->requestFactory->create(['admin' => $this->isAdmin]);
    }

    /**
     * @When I ask for :name list
     */
    public function iAskForCardList($name)
    {
        $this->checkPlural($name);

        if (!$this->nextRequest) {
            $this->iPrepareTheRequest();
        }

        $this->lastException = null;
        try {
            $this->lastResponse = $this->getLister()->execute($this->nextRequest);
        } catch (\Exception $e) {
            $this->lastException = $e;
        }
    }

    /**
     * @Then /^I should see (?<count>\d+) (?<name>\w+)$/
     */
    public function iShouldSeeCountCards($count, $name)
    {
        $this->checkName($name);

        \PHPUnit_Framework_Assert::assertCount(
            intval($count),
            $this->lastResponse->getList()
        );
    }

    /**
     * @Then I should see the :field of :name :index is equals to ':value'
     */
    public function iShouldSeeThe($field, $name, int $index, $value)
    {
        $this->checkSingular($name);

        $list = $this->lastResponse->getList();

        \PHPUnit_Framework_Assert::assertInternalType('int', $index);
        \PHPUnit_Framework_Assert::assertArrayHasKey($index - 1, $list);

        $card = $list[$index - 1];

        $accessor = PropertyAccess::createPropertyAccessor();

        \PHPUnit_Framework_Assert::assertEquals($value, $accessor->getValue($card, $field));
    }

    /**
     * @Then /^I have got an exception$/
     */
    public function iHaveGotAnException()
    {
        \PHPUnit_Framework_Assert::assertTrue($this->lastException !== null);
    }

    /**
     * @Then /^I have got an exception of type '(.*)'$/
     */
    public function iHaveGotAnExceptionOfType($exceptionType)
    {
        \PHPUnit_Framework_Assert::assertInstanceOf(
            $exceptionType,
            $this->lastException
        );
    }

    /**
     * @Given /^I am (admin|visitor)$/
     */
    public function iAm($user)
    {
        $this->isAdmin = $user == 'admin';
        $this->nextRequest = null;
    }

    protected function checkSingular($name)
    {
        if ($name != $this->getSingular()) {
            throw new PendingException('Bad Card name, \''.$this->getSingular().'\' expected.');
        }
    }

    protected function checkPlural($name)
    {
        if ($name != $this->getPlural()) {
            throw new PendingException('Bad Card name, \''.$this->getPlural().'\' expected.');
        }
    }

    protected function checkName($name)
    {
        if ($name != $this->getSingular() && $name != $this->getPlural()) {
            throw new PendingException('Bad Card name, \''.$this->getSingular().'\' or \''.$this->getPlural().'\' expected.');
        }
    }
}
