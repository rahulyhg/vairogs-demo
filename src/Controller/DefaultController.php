<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Phpsed\Cache\Annotation\Cache;
use Vairogs\Utils\Core\Util\StreamResponse;
use App\Service\Guzzle;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="default")
     */
    public function index(Guzzle $guzzle)
    {
        $guzzle->get('http://worldclockapi.com/api/json/est/now');
        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController',
            'rand' => \random_int(1, 100)
        ]);
    }
}
