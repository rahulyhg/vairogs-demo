<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Phpsed\Cache\Annotation\Cache;
use Symfony\Contracts\Translation\TranslatorInterface;
use Vairogs\Utils\Utils\Sort;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="default")
     */
    public function index(TranslatorInterface $tr)
    {
        $sortarr = array(6,1,3,7,5,2,3,4,45,5,4,75,8,6,78,7980890,2,4,2,432,5,34,5634,34,5,8);
        dump(Sort::mergeSort($sortarr));
        dump($tr->trans('This value should be blank.', [], 'validators', 'lv'));
        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController',
            'rand' => \random_int(1, 100)
        ]);
    }
}
