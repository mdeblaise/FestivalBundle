<?php

namespace MMC\FestivalBundle\Controller;

use MMC\CardBundle\Controller\CardAdminController as BaseCardAdminController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CardAdminController extends BaseCardAdminController
{
    public function duplicateYearAction(Request $request)
    {
        $object = $this->admin->getSubject();

        if (!$object) {
            throw new NotFoundHttpException(sprintf('unable to find the object with id : %s', $id));
        }

        $globalCode = $object->getGlobalCode();
        $class = get_class($object);

        $editionProvider = $this->container->get('mmc_festival.provider.edition');

        $currentEdition = $editionProvider->getCurrentEdition();

        $cardProvider = $this->container->get('mmc_festival.provider.card');

        if ($cardProvider->getExist($class, $currentEdition, $globalCode)) {
            throw new AccessDeniedHttpException(
                sprintf('You can\'t duplicate this card because this card already exists !')
            );
        }

        if ($this->getRestMethod() == 'POST') {
            $modelManager = $this->admin->getModelManager();

            $card = $modelManager->getModelInstance($class);

            $item = $card->getDraft();

            $card->setGlobalCode($object->getGlobalCode())
                ->setEdition($currentEdition)
            ;

            $sourceItem = $object->getMainItem();
            if ($sourceItem) {
                $item->copy($sourceItem);
            }

            $modelManager->create($card);

            return new RedirectResponse($this->admin->generateObjectUrl('show', $card));
        }

        return $this->render($this->admin->getTemplate('validate_duplicate'), [
            'object' => $object,
            'currentEdition' => $currentEdition,
            'action' => 'validate_duplicate',
            'csrf_token' => $this->getCsrfToken('sonata.validate'),
        ], null);
    }
}
