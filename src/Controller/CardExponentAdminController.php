<?php

namespace MMC\FestivalBundle\Controller;

use MMC\FestivalBundle\Entity\CardExponent;
use Sonata\AdminBundle\Controller\CRUDController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CardExponentAdminController extends CRUDController
{
    public function addExponentAction(Request $request)
    {
        $object = $this->admin->getSubject();

        if (!$object) {
            throw new NotFoundHttpException(sprintf('unable to find the object with id : %s', $id));
        }

        $adminExponent = $this->admin->getConfigurationPool()->getAdminByAdminCode('mmc_festival.admin.card_exponent');

        $modelManager = $adminExponent->getModelManager();

        $card = $modelManager->getModelInstance(CardExponent::class);

        $exponent = $card->getDraft();

        $exponent->setName($object->getSocialReason())
            ->setDescriptif($object->getTypeProducts())
            ->setEmail($object->getEmail())
            ->setStatus('c')
            ->setUnivers('')
            ->setEdition('')
        ;

        $adminExponent->create($card);

        $object->setExponent($card);

        $this->admin->getModelManager()->update($object);

        return new RedirectResponse($adminExponent->generateObjectUrl('show', $card));
    }
}
