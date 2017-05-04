<?php

namespace MMC\FestivalBundle\Controller;

use MMC\FestivalBundle\Services\Actuality\RequestFactory;
use MMC\FestivalBundle\Services\Lister\ChainLister;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\Templating\EngineInterface;

class DefaultController
{
    protected $templating;

    protected $chainLister;

    protected $requestFactory;

    protected $authorizationChecker;

    public function __construct(
        EngineInterface $templating,
        ChainLister $chainLister,
        RequestFactory $requestFactory,
        AuthorizationCheckerInterface $authorizationChecker
    ) {
        $this->templating = $templating;
        $this->chainLister = $chainLister;
        $this->requestFactory = $requestFactory;
        $this->authorizationChecker = $authorizationChecker;
    }

    public function indexAction()
    {
        $nextRequest = $this->requestFactory->create(['admin' => $this->authorizationChecker->isGranted('ROLE_ADMIN')]);

        $actualitiesResponse = $this->chainLister->execute($nextRequest);

        return $this->templating->renderResponse('MMCFestivalBundle:Default:index.html.twig', compact(['actualitiesResponse']));
    }

    public function pressAction()
    {
        return $this->templating->renderResponse('MMCFestivalBundle:Default:press.html.twig');
    }

    public function ticketingAction()
    {
        return $this->templating->renderResponse('MMCFestivalBundle:Default:ticketing.html.twig');
    }

    public function infosAction()
    {
        return $this->templating->renderResponse('MMCFestivalBundle:Default:infos.html.twig');
    }

    public function legalNoticeAction()
    {
        return $this->templating->renderResponse('MMCFestivalBundle:Default:legalNotice.html.twig');
    }

    public function securityRulesAction()
    {
        return $this->templating->renderResponse('MMCFestivalBundle:Default:securityRules.html.twig');
    }
}
