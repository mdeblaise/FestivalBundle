<?php

namespace MMC\FestivalBundle\Controller;

use MMC\FestivalBundle\Entity\ContactExponent;
use MMC\FestivalBundle\Form\ContactExponentType;
use MMC\FestivalBundle\Services\Exponent\DoctrineManager;
use MMC\FestivalBundle\Services\Exponent\RequestFactory;
use MMC\FestivalBundle\Services\Lister\ChainLister;
use MMC\FestivalBundle\Services\RegisterProcessor;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\OptionsResolver\Exception\InvalidOptionsException;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\Templating\EngineInterface;

class ExponentController
{
    protected $templating;

    protected $router;

    protected $formFactory;

    protected $doctrineManager;

    protected $chainLister;

    protected $requestFactory;

    public function __construct(
        EngineInterface $templating,
        RouterInterface $router,
        FormFactoryInterface $formFactory,
        DoctrineManager $doctrineManager,
        ChainLister $chainLister,
        RequestFactory $requestFactory,
        AuthorizationCheckerInterface $authorizationChecker
    ) {
        $this->templating = $templating;
        $this->router = $router;
        $this->formFactory = $formFactory;
        $this->doctrineManager = $doctrineManager;
        $this->chainLister = $chainLister;
        $this->requestFactory = $requestFactory;
        $this->authorizationChecker = $authorizationChecker;
    }

    public function indexAction($univers = null)
    {
        try {
            $nextRequest = $this->requestFactory->create([
                'admin' => $this->authorizationChecker->isGranted('ROLE_ADMIN'),
                'univers' => $univers,
            ]);
        } catch (InvalidOptionsException $e) {
            throw new NotFoundHttpException(null, $e);
        }

        $exponentsResponse = $this->chainLister->execute($nextRequest);

        return $this->templating->renderResponse('MMCFestivalBundle:Exponent:index.html.twig', [
            'response' => $exponentsResponse,
        ]);
    }

    public function becomeAction(Request $request)
    {
        $contactExponent = new ContactExponent();

        $form = $this->formFactory->create(ContactExponentType::class, $contactExponent);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->processForm($request, $form);

            return new RedirectResponse($this->router->generate('mmc_festival_exponent_become_confirm'), 302);
        }

        return $this->templating->renderResponse('MMCFestivalBundle:Exponent:become.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    protected function processForm(Request $request, $form)
    {
        $this->doctrineManager->create($form->getData());
    }

    public function confirmAction(Request $request)
    {
        return $this->templating->renderResponse('MMCFestivalBundle:Exponent:confirmContact.html.twig');
    }
}
