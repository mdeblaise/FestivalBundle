<?php

namespace MMC\FestivalBundle\Controller;

use MMC\FestivalBundle\Entity\Play;
use MMC\FestivalBundle\Form\PlayType;
use MMC\FestivalBundle\Services\Play\DoctrineManager;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Templating\EngineInterface;
use Symfony\Component\Translation\TranslatorInterface;

class PlayController
{
    protected $templating;

    protected $router;

    protected $formFactory;

    protected $doctrineManager;

    protected $translator;

    public function __construct(
        EngineInterface $templating,
        RouterInterface $router,
        FormFactoryInterface $formFactory,
        DoctrineManager $doctrineManager,
        TranslatorInterface $translator
    ) {
        $this->templating = $templating;
        $this->router = $router;
        $this->formFactory = $formFactory;
        $this->doctrineManager = $doctrineManager;
        $this->translator = $translator;
    }

    public function indexAction(Request $request)
    {
        $play = new Play();

        $form = $this->formFactory->create(PlayType::class, $play);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->processForm($request, $form);

            $request->getSession()->getFlashBag()->add(
                'play',
                $this->translator->trans('registration.success', [], 'play')
            );

            return new RedirectResponse($this->router->generate('mmc_festival_play'), 302);
        }

        return $this->templating->renderResponse('MMCFestivalBundle:Play:index.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    protected function processForm(Request $request, $form)
    {
        $this->doctrineManager->create($form->getData());
    }
}
