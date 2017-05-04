<?php

namespace MMC\FestivalBundle\Controller;

use MMC\FestivalBundle\Entity\GetProgram;
use MMC\FestivalBundle\Form\GetProgramType;
use MMC\FestivalBundle\Services\GetProgram\DoctrineManager;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Templating\EngineInterface;

class GetProgramController
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

    public function indexAction(Request $request)
    {
        $getProgram = new GetProgram();

        $form = $this->formFactory->create(GetProgramType::class, $getProgram);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->processForm($request, $form);

            return new RedirectResponse($this->router->generate('mmc_festival_get_program_confirm'), 302);
        }

        return $this->templating->renderResponse('MMCFestivalBundle:GetProgram:index.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    protected function processForm(Request $request, $form)
    {
        $this->doctrineManager->create($form->getData());
    }

    public function confirmAction(Request $request)
    {
        return $this->templating->renderResponse('MMCFestivalBundle:GetProgram:confirm.html.twig');
    }
}
