<?php

namespace MMC\FestivalBundle\Controller;

use MMC\CardBundle\Model\Action;
use MMC\CardBundle\Services\CardProcessor\Request as CardProcessorRequest;
use MMC\CardBundle\Services\CardProcessor\Response as CardProcessorResponse;
use Sonata\AdminBundle\Controller\CRUDController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use MMC\FestivalBundle\Entity\Exponent;

class CardExponentAdminController extends CRUDController
{
    public function addExponentAction(Request $request)
    {
        $object = $this->admin->getSubject();

        if (!$object) {
            throw new NotFoundHttpException(sprintf('unable to find the object with id : %s', $id));
        }

        $exponent = new Exponent();

        $exponent->setName($object->getSocialReason())
            ->setDescriptif($object->getTypeProducts())
            ->setEmail($object->getEmail())
        ;

        return new RedirectResponse(\Symfony\Component\Routing\Route()->generate('mmc_admin_card_exponent_create'), 302);
        //dump($object, $exponent);die;

    }
}
