<?php

namespace MMC\FestivalBundle\Controller;

use MMC\FestivalBundle\Entity\ContactStaff;
use MMC\FestivalBundle\Form\ContactStaffType;
use MMC\FestivalBundle\Services\Staff\DoctrineManager;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Templating\EngineInterface;

class StaffController
{
    protected $templating;

    protected $router;

    protected $formFactory;

    protected $registerProcessor;

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

    public function indexAction(Request $request)
    {
        $contactStaff = new ContactStaff();

        $form = $this->formFactory->create(ContactStaffType::class, $contactStaff);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->processForm($request, $form);

            return new RedirectResponse($this->router->generate('mmc_festival_staff_confirm'), 302);
        }

        return $this->templating->renderResponse('MMCFestivalBundle:Staff:index.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    protected function processForm(Request $request, $form)
    {
        $this->doctrineManager->create($form->getData());
    }

    public function confirmAction(Request $request)
    {
        return $this->templating->renderResponse('MMCFestivalBundle:Staff:confirmContact.html.twig');
    }
}
