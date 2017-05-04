<?php

namespace MMC\FestivalBundle\Controller;

use MMC\FestivalBundle\Entity\ContactPress;
use MMC\FestivalBundle\Form\ContactPressType;
use MMC\FestivalBundle\Services\Press\DoctrineManager;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Templating\EngineInterface;

class PressController
{
    protected $templating;

    protected $router;

    protected $formFactory;

    protected $doctrineManager;

    public function __construct(
        EngineInterface $templating,
        RouterInterface $router,
        FormFactoryInterface $formFactory,
        DoctrineManager $doctrineManager
    ) {
        $this->templating = $templating;
        $this->router = $router;
        $this->formFactory = $formFactory;
        $this->doctrineManager = $doctrineManager;
    }

    public function indexAction()
    {
        return $this->templating->renderResponse('MMCFestivalBundle:Press:index.html.twig');
    }

    public function contactAction(Request $request)
    {
        $contactPress = new ContactPress();

        $form = $this->formFactory->create(ContactPressType::class, $contactPress);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->processForm($request, $form);

            return new RedirectResponse($this->router->generate('mmc_festival_press_confirm'), 302);
        }

        return $this->templating->renderResponse('MMCFestivalBundle:Press:contactPress.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    protected function processForm(Request $request, $form)
    {
        $this->doctrineManager->create($form->getData());
    }

    public function confirmAction(Request $request)
    {
        return $this->templating->renderResponse('MMCFestivalBundle:Press:confirmContact.html.twig');
    }
}
