<?php

namespace MMC\FestivalBundle\Controller;

use MMC\FestivalBundle\Entity\ActivityViews;
use MMC\FestivalBundle\Services\Activity\RequestFactory;
use MMC\FestivalBundle\Services\Lister\ChainLister;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\OptionsResolver\Exception\InvalidOptionsException;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\Templating\EngineInterface;

class ActivityController
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

    public function indexAction(Request $request, $univers = null, $day = null)
    {
        try {
            $nextRequest = $this->requestFactory->create([
                'admin' => $this->authorizationChecker->isGranted('ROLE_ADMIN'),
                'univers' => $univers,
                'day' => $day,
                'type' => $request->get('type'),
                'page' => $request->get('page', 1),
            ]);
        } catch (InvalidOptionsException $e) {
            throw new NotFoundHttpException(null, $e);
        }

        $activitiesResponse = $this->chainLister->execute($nextRequest);

        return $this->templating->renderResponse('MMCFestivalBundle:Activity:index.html.twig', [
            'response' => $activitiesResponse,
        ]);
    }

    /**
     * @Security("is_granted('view', activity)")
     *
     * @ParamConverter("activity", class="MMC\FestivalBundle\Entity\CardActivity")
     */
    public function viewAction(ActivityViews $activity)
    {
        return $this->templating->renderResponse('MMCFestivalBundle:Activity:view.html.twig', compact(['activity']));
    }
}
