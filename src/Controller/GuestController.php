<?php

namespace MMC\FestivalBundle\Controller;

use MMC\FestivalBundle\Entity\GuestViews;
use MMC\FestivalBundle\Services\Guest\RequestFactory;
use MMC\FestivalBundle\Services\Lister\ChainLister;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\OptionsResolver\Exception\InvalidOptionsException;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\Templating\EngineInterface;

class GuestController
{
    protected $templating;

    protected $chainLister;

    protected $requestFactory;

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

    public function indexAction(Request $request, $univers = null, $day = null, $honor = false)
    {
        try {
            $nextRequest = $this->requestFactory->create([
                'admin' => $this->authorizationChecker->isGranted('ROLE_ADMIN'),
                'univers' => $univers,
                'day' => $day,
                'honor' => $honor,
                'page' => $request->get('page', 1),
            ]);
        } catch (InvalidOptionsException $e) {
            throw new NotFoundHttpException(null, $e);
        }

        $guestsResponse = $this->chainLister->execute($nextRequest);

        return $this->templating->renderResponse('MMCFestivalBundle:Guest:index.html.twig', [
            'response' => $guestsResponse,
        ]);
    }

    /**
     * @Security("is_granted('view', guest)")
     *
     * @ParamConverter("guest", class="MMC\FestivalBundle\Entity\CardGuest")
     */
    public function viewAction(GuestViews $guest)
    {
        return $this->templating->renderResponse('MMCFestivalBundle:Guest:view.html.twig', compact(['guest']));
    }
}
