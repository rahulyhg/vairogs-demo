<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Phpsed\Cache\Annotation\Cache;
use Symfony\Contracts\Translation\TranslatorInterface;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="default")
     */
    public function index(TranslatorInterface $tr)
    {
        dump($tr->trans('This value should be blank.', [], 'validators', 'lv'));
        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController',
            'rand' => \random_int(1, 100)
        ]);
    }
}
