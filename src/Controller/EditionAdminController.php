<?php

namespace MMC\FestivalBundle\Controller;

use Sonata\AdminBundle\Controller\CRUDController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class EditionAdminController extends CRUDController
{
    public function currentEditionAction(Request $request)
    {
        $object = $this->admin->getSubject();

        $editionProvider = $this->container->get('mmc_festival.provider.edition');

        if (!$object) {
            throw new NotFoundHttpException(sprintf('unable to find the object with id : %s', $id));
        }

        if ($this->getRestMethod() == 'POST') {
            $object->setCurrent(true);

            $this->admin->getModelManager()->update($object);

            return new RedirectResponse($this->admin->generateObjectUrl('list', $object));
        }

        return $this->render($this->admin->getTemplate('validate'), [
            'object' => $object,
            'action' => 'validate',
            'csrf_token' => $this->getCsrfToken('sonata.validate'),
        ], null);
    }
}
